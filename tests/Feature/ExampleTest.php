<?php

namespace Tests\Feature;

use App\Livewire\FolkloreSection;
use App\Livewire\GallerySection;
use App\Livewire\HeroSection;
use App\Livewire\Navbar;
use Livewire\Livewire;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_landing_page_renders_all_livewire_sections(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SERTÃO DAS SOMBRAS');
        $response->assertSee('Edital nº 23/2024/SECEL/MT');
        $response->assertSee('Jhonathan Vitor');
        $response->assertSee('O Vilarejo Abandonado');
    }

    public function test_folklore_section_toggles_archive_fragment(): void
    {
        Livewire::test(FolkloreSection::class)
            ->assertSet('openCards', [])
            ->call('toggleCard', 0)
            ->assertSet('openCards', [0])
            ->assertSee('Fechar fragmento')
            ->call('toggleCard', 0)
            ->assertSet('openCards', []);
    }

    public function test_gallery_section_handles_trailer_modal_and_lightbox(): void
    {
        Livewire::test(GallerySection::class)
            ->assertSet('trailerModalOpen', false)
            ->call('openTrailerModal')
            ->assertSet('trailerModalOpen', true)
            ->call('closeTrailerModal')
            ->assertSet('trailerModalOpen', false)
            ->call('openLightbox', 1)
            ->assertSet('lightboxOpen', true)
            ->assertSet('currentShot', 1)
            ->call('nextShot')
            ->assertSet('currentShot', 2)
            ->call('prevShot')
            ->assertSet('currentShot', 1)
            ->call('closeLightbox')
            ->assertSet('lightboxOpen', false);
    }

    public function test_hero_section_dispatches_open_trailer_event(): void
    {
        Livewire::test(HeroSection::class)
            ->call('openTrailer')
            ->assertDispatched('open-trailer-modal');
    }

    public function test_navbar_toggles_mobile_menu(): void
    {
        Livewire::test(Navbar::class)
            ->assertSet('mobileMenuOpen', false)
            ->call('toggleMobileMenu')
            ->assertSet('mobileMenuOpen', true)
            ->call('closeMobileMenu')
            ->assertSet('mobileMenuOpen', false);
    }
}
