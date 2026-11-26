<?php

namespace Tests\Feature;

use App\Livewire\Auth\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{string}>
     */
    public static function adminRoutes(): array
    {
        return [
            'links' => ['admin.links'],
            'gallery' => ['admin.gallery'],
            'team' => ['admin.team'],
            'sponsors' => ['admin.sponsors'],
            'users' => ['admin.users'],
        ];
    }

    #[DataProvider('adminRoutes')]
    public function test_guests_are_redirected_from_admin_pages_to_login(string $routeName): void
    {
        $this->get(route($routeName))->assertRedirect(route('login'));
    }

    #[DataProvider('adminRoutes')]
    public function test_authenticated_users_can_open_admin_pages(string $routeName): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route($routeName))
            ->assertOk();
    }

    public function test_user_logs_in_with_valid_credentials(): void
    {
        $user = User::factory()->create();

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login')
            ->assertHasNoErrors()
            ->assertRedirect(route('admin.links'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create();

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'wrong-password')
            ->call('login')
            ->assertHasErrors('email')
            ->assertNoRedirect();

        $this->assertGuest();
    }

    public function test_login_is_throttled_after_five_failed_attempts(): void
    {
        $user = User::factory()->create();
        $component = Livewire::test(Login::class)->set('email', $user->email);

        foreach (range(1, 5) as $attempt) {
            $component->set('password', 'wrong-password')->call('login');
        }

        $component->set('password', 'password')
            ->call('login')
            ->assertHasErrors('email')
            ->assertSee('Muitas tentativas');

        $this->assertGuest();
    }

    public function test_authenticated_users_visiting_login_are_sent_to_the_panel(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('login'))
            ->assertRedirect(route('admin.links'));
    }

    public function test_user_logs_out(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
