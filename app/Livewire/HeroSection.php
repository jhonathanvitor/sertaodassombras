<?php

namespace App\Livewire;

use App\Models\SiteSetting;
use Livewire\Component;

class HeroSection extends Component
{
    public string $downloadWindows;

    public string $downloadLinux;

    public string $version;

    public string $engine;

    public function mount(): void
    {
        $settings = SiteSetting::values();
        $this->downloadWindows = $settings['download_windows'];
        $this->downloadLinux = $settings['download_linux'];
        $this->version = $settings['version'];
        $this->engine = config('sertao.engine');
    }

    public function openTrailer(): void
    {
        $this->dispatch('open-trailer-modal');
    }

    public function render()
    {
        return view('livewire.hero-section');
    }
}
