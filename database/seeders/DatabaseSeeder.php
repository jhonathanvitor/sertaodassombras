<?php

namespace Database\Seeders;

use App\Models\LoreArchive;
use App\Models\Screenshot;
use App\Models\SiteSetting;
use App\Models\Sponsor;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Runs on every container boot. Default content is seeded once (tracked by a
 * marker row) and only into empty tables, so admin panel edits survive restarts.
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    protected const CONTENT_SEEDED_KEY = 'content_seeded_at';

    public function run(): void
    {
        $this->seedAdminUser();

        if (SiteSetting::where('key', self::CONTENT_SEEDED_KEY)->exists()) {
            return;
        }

        if (LoreArchive::query()->doesntExist()) {
            foreach (config('sertao.lore', []) as $index => $item) {
                LoreArchive::create([
                    'code' => $item['code'],
                    'icon' => $item['icon'],
                    'title' => $item['title'],
                    'summary' => $item['summary'],
                    'fragment' => $item['fragment'],
                    'offset' => $item['offset'] ?? false,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        if (Screenshot::query()->doesntExist()) {
            foreach (config('sertao.screenshots', []) as $index => $shot) {
                Screenshot::create([
                    'src' => $shot['src'] ?: null,
                    'caption' => $shot['caption'],
                    'hue' => $shot['hue'] ?? 'amber',
                    'sort_order' => $index + 1,
                ]);
            }
        }

        if (TeamMember::query()->doesntExist()) {
            foreach (config('sertao.team', []) as $index => $member) {
                TeamMember::create([
                    'name' => $member['name'],
                    'role' => $member['role'],
                    'note' => $member['note'] ?: null,
                    'icon' => $member['icon'] ?? 'user',
                    'photo' => $member['photo'] ?: null,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        if (Sponsor::query()->doesntExist()) {
            foreach (config('sertao.sponsors', []) as $index => $sponsor) {
                Sponsor::create([
                    'name' => $sponsor['name'],
                    'logo' => $sponsor['logo'] ?: null,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        SiteSetting::create(['key' => self::CONTENT_SEEDED_KEY, 'value' => now()->toIso8601String()]);
    }

    /**
     * Creates the admin from ADMIN_EMAIL / ADMIN_PASSWORD without ever
     * overwriting an existing account's password.
     */
    protected function seedAdminUser(): void
    {
        $email = config('sertao.admin.email');
        $password = config('sertao.admin.password');

        if (blank($email) || blank($password)) {
            return;
        }

        User::firstOrCreate(
            ['email' => $email],
            ['name' => config('sertao.admin.name'), 'password' => $password],
        );
    }
}
