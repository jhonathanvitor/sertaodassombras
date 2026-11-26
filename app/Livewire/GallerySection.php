<?php

namespace App\Livewire;

use App\Models\Screenshot;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\On;
use Livewire\Component;
use Throwable;

class GallerySection extends Component
{
    public array $shots = [];

    public string $youtubeId;

    public bool $inlineTrailerPlaying = false;

    public bool $trailerModalOpen = false;

    public bool $lightboxOpen = false;

    public int $currentShot = 0;

    public function mount(): void
    {
        $this->youtubeId = SiteSetting::value('youtube_id');
        $this->shots = $this->loadShots();
    }

    public function playInlineTrailer(): void
    {
        $this->inlineTrailerPlaying = true;
    }

    #[On('open-trailer-modal')]
    public function openTrailerModal(): void
    {
        $this->trailerModalOpen = true;
    }

    public function closeTrailerModal(): void
    {
        $this->trailerModalOpen = false;
    }

    public function openLightbox(int $index): void
    {
        $count = count($this->shots);
        if ($count === 0) {
            return;
        }
        $this->currentShot = (($index % $count) + $count) % $count;
        $this->lightboxOpen = true;
    }

    public function closeLightbox(): void
    {
        $this->lightboxOpen = false;
    }

    public function nextShot(): void
    {
        $count = count($this->shots);
        if ($count > 0) {
            $this->currentShot = ($this->currentShot + 1) % $count;
        }
    }

    public function prevShot(): void
    {
        $count = count($this->shots);
        if ($count > 0) {
            $this->currentShot = ($this->currentShot - 1 + $count) % $count;
        }
    }

    protected function loadShots(): array
    {
        try {
            if (Schema::hasTable('screenshots')) {
                $records = Screenshot::orderBy('sort_order')->get();
                if ($records->isNotEmpty()) {
                    return $records->map(fn (Screenshot $s) => [
                        'src' => $s->src ?? '',
                        'caption' => $s->caption,
                        'hue' => $s->hue ?: 'amber',
                    ])->all();
                }
            }
        } catch (Throwable) {
            // Fallback to config
        }

        return config('sertao.screenshots', []);
    }

    public function render()
    {
        return view('livewire.gallery-section');
    }
}
