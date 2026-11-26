<?php

namespace Tests\Feature;

use App\Livewire\Admin\Gallery;
use App\Livewire\Admin\Links;
use App\Livewire\Admin\Sponsors;
use App\Livewire\GallerySection;
use App\Models\Screenshot;
use App\Models\SiteSetting;
use App\Models\Sponsor;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_saved_links_are_stored_and_shown_on_the_landing_page(): void
    {
        Livewire::test(Links::class)
            ->set('settings.download_windows', 'https://cdn.example.com/sertao-windows.exe')
            ->set('settings.youtube_id', 'https://www.youtube.com/watch?v=abcdefghijk&t=10')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('settings.youtube_id', 'abcdefghijk');

        $this->assertDatabaseHas('site_settings', ['key' => 'download_windows', 'value' => 'https://cdn.example.com/sertao-windows.exe']);
        $this->assertDatabaseHas('site_settings', ['key' => 'youtube_id', 'value' => 'abcdefghijk']);

        $this->get('/')->assertSee('https://cdn.example.com/sertao-windows.exe');

        Livewire::test(GallerySection::class)
            ->call('playInlineTrailer')
            ->assertSee('youtube-nocookie.com/embed/abcdefghijk', false);
    }

    public function test_links_reject_invalid_urls_and_video_ids(): void
    {
        Livewire::test(Links::class)
            ->set('settings.download_linux', 'javascript:alert(1)')
            ->set('settings.instagram', 'not a url')
            ->set('settings.youtube_id', 'curto')
            ->call('save')
            ->assertHasErrors(['settings.download_linux', 'settings.instagram', 'settings.youtube_id']);

        $this->assertDatabaseCount('site_settings', 0);
    }

    public function test_gallery_save_creates_updates_reorders_and_deletes_screenshots(): void
    {
        $kept = Screenshot::create(['caption' => 'Mantida', 'hue' => 'amber', 'sort_order' => 1]);
        $removed = Screenshot::create(['caption' => 'Removida', 'hue' => 'mist', 'sort_order' => 2]);

        Livewire::test(Gallery::class)
            ->call('removeRow', 1)
            ->set('rows.0.src', 'https://cdn.example.com/vila.jpg')
            ->call('addRow')
            ->set('rows.1.caption', 'Nova captura')
            ->call('moveRow', 1, -1)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertModelMissing($removed);
        $this->assertSame(
            [['Nova captura', 1], ['Mantida', 2]],
            Screenshot::orderBy('sort_order')->get()->map(fn (Screenshot $s) => [$s->caption, $s->sort_order])->all(),
        );
        $this->assertSame('https://cdn.example.com/vila.jpg', $kept->fresh()->src);

        $this->get('/')->assertSee('https://cdn.example.com/vila.jpg');
    }

    public function test_gallery_requires_caption_and_valid_image_url(): void
    {
        Livewire::test(Gallery::class)
            ->call('addRow')
            ->set('rows.0.src', 'ftp://example.com/a.jpg')
            ->call('save')
            ->assertHasErrors(['rows.0.caption', 'rows.0.src']);

        $this->assertDatabaseCount('screenshots', 0);
    }

    public function test_sponsor_logos_are_shown_in_the_footer(): void
    {
        Livewire::test(Sponsors::class)
            ->call('addRow')
            ->set('rows.0.name', 'SECEL-MT')
            ->set('rows.0.logo', 'https://cdn.example.com/secel.png')
            ->call('save')
            ->assertHasNoErrors();

        $this->get('/')->assertSee('https://cdn.example.com/secel.png');
    }

    public function test_seeder_keeps_admin_edits_and_existing_admin_password(): void
    {
        config([
            'sertao.admin.email' => 'admin@example.com',
            'sertao.admin.password' => 'first-password',
        ]);

        $this->seed(DatabaseSeeder::class);
        Screenshot::query()->first()->update(['caption' => 'Legenda editada']);
        Sponsor::query()->delete();
        SiteSetting::saveMany(['version' => 'v2.0']);

        config(['sertao.admin.password' => 'second-password']);
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('screenshots', ['caption' => 'Legenda editada']);
        $this->assertSame(count(config('sertao.screenshots')), Screenshot::count());
        $this->assertSame(0, Sponsor::count());
        $this->assertSame('v2.0', SiteSetting::value('version'));
        $this->assertTrue(Hash::check('first-password', User::firstWhere('email', 'admin@example.com')->password));
    }
}
