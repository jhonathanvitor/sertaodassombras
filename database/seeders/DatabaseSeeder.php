<?php

namespace Database\Seeders;

use App\Models\LoreArchive;
use App\Models\Screenshot;
use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        foreach (config('sertao.lore', []) as $index => $item) {
            LoreArchive::updateOrCreate(
                ['code' => $item['code']],
                [
                    'icon' => $item['icon'],
                    'title' => $item['title'],
                    'summary' => $item['summary'],
                    'fragment' => $item['fragment'],
                    'offset' => $item['offset'] ?? false,
                    'sort_order' => $index + 1,
                ]
            );
        }

        foreach (config('sertao.screenshots', []) as $index => $shot) {
            Screenshot::updateOrCreate(
                ['caption' => $shot['caption']],
                [
                    'src' => $shot['src'] ?: null,
                    'hue' => $shot['hue'] ?? 'amber',
                    'sort_order' => $index + 1,
                ]
            );
        }

        foreach (config('sertao.team', []) as $index => $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                [
                    'role' => $member['role'],
                    'note' => $member['note'] ?: null,
                    'icon' => $member['icon'] ?? 'user',
                    'photo' => $member['photo'] ?: null,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
