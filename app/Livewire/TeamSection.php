<?php

namespace App\Livewire;

use App\Models\TeamMember;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Throwable;

class TeamSection extends Component
{
    public array $team = [];

    public function mount(): void
    {
        $this->team = $this->loadTeam();
    }

    protected function loadTeam(): array
    {
        try {
            if (Schema::hasTable('team_members')) {
                $records = TeamMember::orderBy('sort_order')->get();
                if ($records->isNotEmpty()) {
                    return $records->map(fn (TeamMember $m) => [
                        'name' => $m->name,
                        'role' => $m->role,
                        'note' => $m->note ?? '',
                        'icon' => $m->icon ?: 'user',
                        'photo' => $m->photo ?? '',
                    ])->all();
                }
            }
        } catch (Throwable) {
            // Fallback to config
        }

        return config('sertao.team', []);
    }

    public function render()
    {
        return view('livewire.team-section');
    }
}
