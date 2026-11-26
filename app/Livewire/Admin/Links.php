<?php

namespace App\Livewire\Admin;

use App\Models\SiteSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Links · Painel')]
class Links extends Component
{
    /** @var array<string, string> */
    public array $settings = [];

    public ?string $status = null;

    public function mount(): void
    {
        $this->settings = array_map(
            fn (string $value): string => $value === '#' ? '' : $value,
            SiteSetting::values(),
        );
    }

    public function save(): void
    {
        $this->settings['youtube_id'] = $this->extractYoutubeId($this->settings['youtube_id'] ?? '');

        $this->validate(
            [
                'settings.version' => 'required|string|max:100',
                'settings.download_windows' => 'required|url:http,https|max:2048',
                'settings.download_linux' => 'required|url:http,https|max:2048',
                'settings.youtube_id' => ['required', 'regex:/^[A-Za-z0-9_-]{11}$/'],
                'settings.itch' => 'nullable|url:http,https|max:2048',
                'settings.github' => 'nullable|url:http,https|max:2048',
                'settings.instagram' => 'nullable|url:http,https|max:2048',
                'settings.youtube' => 'nullable|url:http,https|max:2048',
                'settings.twitter' => 'nullable|url:http,https|max:2048',
            ],
            [
                'required' => 'Campo obrigatório.',
                'url' => 'Informe uma URL válida, começando com http:// ou https://.',
                'max' => 'Texto muito longo.',
                'settings.youtube_id.regex' => 'Cole o link do vídeo no YouTube ou o ID de 11 caracteres.',
            ],
        );

        SiteSetting::saveMany($this->settings);

        $this->status = 'Links salvos.';
    }

    /**
     * Accepts a full YouTube URL (watch, youtu.be, embed, shorts) or a bare ID.
     */
    protected function extractYoutubeId(string $input): string
    {
        $input = trim($input);

        if (preg_match('~(?:youtu\.be/|[?&]v=|/embed/|/shorts/|/live/)([A-Za-z0-9_-]{11})~', $input, $matches)) {
            return $matches[1];
        }

        return $input;
    }

    public function render()
    {
        return view('livewire.admin.links');
    }
}
