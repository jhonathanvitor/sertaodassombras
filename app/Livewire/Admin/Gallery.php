<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Concerns\ManagesOrderedRows;
use App\Models\Screenshot;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Galeria · Painel')]
class Gallery extends Component
{
    use ManagesOrderedRows;

    /** @var array<string, string> */
    public const HUES = [
        'amber' => 'Âmbar',
        'blood' => 'Sangue',
        'mist' => 'Névoa',
    ];

    protected function modelClass(): string
    {
        return Screenshot::class;
    }

    protected function blankRow(): array
    {
        return ['src' => '', 'caption' => '', 'hue' => 'amber'];
    }

    protected function rowRules(): array
    {
        return [
            'rows.*.src' => 'nullable|url:http,https|max:2048',
            'rows.*.caption' => 'required|string|max:255',
            'rows.*.hue' => 'required|in:'.implode(',', array_keys(self::HUES)),
        ];
    }

    public function render()
    {
        return view('livewire.admin.gallery');
    }
}
