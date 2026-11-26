<?php

namespace Tests\Feature;

use App\Livewire\Admin\Users;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class AdminUsersTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
        $this->actingAs($this->admin);
    }

    public function test_admin_creates_another_admin_who_can_log_in(): void
    {
        Livewire::test(Users::class)
            ->call('create')
            ->set('name', 'Kellen Nascimento')
            ->set('email', 'kellen@example.com')
            ->set('password', 'senha-segura-123')
            ->set('password_confirmation', 'senha-segura-123')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('formOpen', false)
            ->assertSee('kellen@example.com');

        $created = User::firstWhere('email', 'kellen@example.com');
        $this->assertSame('Kellen Nascimento', $created->name);
        $this->assertTrue(Hash::check('senha-segura-123', $created->password));
    }

    public function test_creating_requires_valid_unique_email_and_confirmed_password(): void
    {
        Livewire::test(Users::class)
            ->call('create')
            ->set('name', 'Duplicado')
            ->set('email', $this->admin->email)
            ->set('password', 'curta')
            ->set('password_confirmation', 'diferente')
            ->call('save')
            ->assertHasErrors(['email' => 'unique', 'password']);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_editing_without_password_keeps_the_current_one(): void
    {
        $other = User::factory()->create(['password' => 'senha-antiga-123']);

        Livewire::test(Users::class)
            ->call('edit', $other->id)
            ->assertSet('email', $other->email)
            ->set('name', 'Nome Novo')
            ->call('save')
            ->assertHasNoErrors();

        $other->refresh();
        $this->assertSame('Nome Novo', $other->name);
        $this->assertTrue(Hash::check('senha-antiga-123', $other->password));
    }

    public function test_editing_with_password_changes_it_and_allows_keeping_own_email(): void
    {
        Livewire::test(Users::class)
            ->call('edit', $this->admin->id)
            ->set('password', 'nova-senha-456')
            ->set('password_confirmation', 'nova-senha-456')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertTrue(Hash::check('nova-senha-456', $this->admin->fresh()->password));
    }

    public function test_admin_deletes_another_admin(): void
    {
        $other = User::factory()->create();

        Livewire::test(Users::class)->call('delete', $other->id);

        $this->assertModelMissing($other);
    }

    public function test_admin_cannot_delete_own_account(): void
    {
        Livewire::test(Users::class)
            ->call('delete', $this->admin->id)
            ->assertSee('Você não pode excluir a própria conta.');

        $this->assertModelExists($this->admin);
    }
}
