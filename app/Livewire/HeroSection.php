<?php

namespace App\Livewire;

use Livewire\Component;

class HeroSection extends Component
{
    public string $downloadWindows;
    public string $downloadLinux;
    public string $version;
    public string $engine;

    public function mount(): void
    {
        $this->downloadWindows = config('sertao.links.download_windows');
        $this->downloadLinux = config('sertao.links.download_linux');
        $this->version = config('sertao.version');
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
