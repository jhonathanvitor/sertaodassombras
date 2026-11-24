<?php

namespace App\Livewire;

use Livewire\Component;

class FooterSection extends Component
{
    public array $sponsors = [];
    public array $links = [];
    public string $email;
    public string $copyright;

    public function mount(): void
    {
        $this->sponsors = config('sertao.sponsors', []);
        $this->links = config('sertao.links', []);
        $this->email = config('sertao.email', 'majonescode@gmail.com');
        $this->copyright = config('sertao.copyright');
    }

    public function render()
    {
        return view('livewire.footer-section');
    }
}
