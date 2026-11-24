<?php

namespace App\Livewire;

use Livewire\Component;

class AboutSection extends Component
{
    public array $pillars = [];

    public function mount(): void
    {
        $this->pillars = config('sertao.pillars', []);
    }

    public function render()
    {
        return view('livewire.about-section');
    }
}
