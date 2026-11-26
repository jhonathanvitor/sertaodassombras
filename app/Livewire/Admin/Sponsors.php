<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Concerns\ManagesOrderedRows;
use App\Models\Sponsor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Patrocinadores · Painel')]
class Sponsors extends Component
{
    use ManagesOrderedRows;

    protected function modelClass(): string
    {
        return Sponsor::class;
    }

    protected function blankRow(): array
    {
        return ['name' => '', 'logo' => ''];
    }

    protected function rowRules(): array
    {
        return [
            'rows.*.name' => 'required|string|max:255',
            'rows.*.logo' => 'nullable|url:http,https|max:2048',
        ];
    }

    public function render()
    {
        return view('livewire.admin.sponsors');
    }
}
