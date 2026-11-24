<?php

namespace App\Livewire;

use App\Models\LoreArchive;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Throwable;

class FolkloreSection extends Component
{
    public array $archives = [];
    public array $openCards = [];

    public function mount(): void
    {
        $this->archives = $this->loadArchives();
    }

    public function toggleCard(int $index): void
    {
        if (in_array($index, $this->openCards, true)) {
            $this->openCards = array_values(array_diff($this->openCards, [$index]));
        } else {
            $this->openCards[] = $index;
        }
    }

    protected function loadArchives(): array
    {
        try {
            if (Schema::hasTable('lore_archives')) {
                $records = LoreArchive::orderBy('sort_order')->get();
                if ($records->isNotEmpty()) {
                    return $records->map(fn (LoreArchive $r) => [
                        'id' => $r->id,
                        'code' => $r->code,
                        'icon' => $r->icon,
                        'title' => $r->title,
                        'summary' => $r->summary,
                        'fragment' => $r->fragment,
                        'offset' => (bool) $r->offset,
                    ])->all();
                }
            }
        } catch (Throwable) {
            // Fallback to config when DB driver or connection is not active
        }

        return config('sertao.lore', []);
    }

    public function render()
    {
        return view('livewire.folklore-section');
    }
}
