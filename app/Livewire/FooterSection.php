<?php

namespace App\Livewire;

use App\Models\SiteSetting;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Throwable;

class FooterSection extends Component
{
    public array $sponsors = [];

    public array $links = [];

    public string $email;

    public string $copyright;

    public function mount(): void
    {
        $this->sponsors = $this->loadSponsors();
        $this->links = SiteSetting::values();
        $this->email = config('sertao.email', 'majonescode@gmail.com');
        $this->copyright = config('sertao.copyright');
    }

    protected function loadSponsors(): array
    {
        try {
            if (Schema::hasTable('sponsors')) {
                $records = Sponsor::orderBy('sort_order')->get();
                if ($records->isNotEmpty()) {
                    return $records->map(fn (Sponsor $s) => [
                        'name' => $s->name,
                        'logo' => $s->logo ?? '',
                    ])->all();
                }
            }
        } catch (Throwable) {
            // Fallback to config
        }

        return config('sertao.sponsors', []);
    }

    public function render()
    {
        return view('livewire.footer-section');
    }
}
