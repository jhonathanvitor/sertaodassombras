<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Concerns\ManagesOrderedRows;
use App\Models\TeamMember;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Equipe · Painel')]
class Team extends Component
{
    use ManagesOrderedRows;

    protected function modelClass(): string
    {
        return TeamMember::class;
    }

    protected function blankRow(): array
    {
        return ['name' => '', 'role' => '', 'note' => '', 'icon' => 'user', 'photo' => ''];
    }

    protected function rowRules(): array
    {
        return [
            'rows.*.name' => 'required|string|max:255',
            'rows.*.role' => 'required|string|max:255',
            'rows.*.note' => 'nullable|string|max:255',
            'rows.*.icon' => 'required|string|max:64',
            'rows.*.photo' => 'nullable|url:http,https|max:2048',
        ];
    }

    public function render()
    {
        return view('livewire.admin.team');
    }
}
