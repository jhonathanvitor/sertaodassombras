<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Administradores · Painel')]
class Users extends Component
{
    public bool $formOpen = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public ?string $status = null;

    public function create(): void
    {
        $this->resetForm();
        $this->formOpen = true;
    }

    public function edit(int $userId): void
    {
        $user = User::findOrFail($userId);

        $this->resetForm();
        $this->editingId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->formOpen = true;
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function save(): void
    {
        $validated = $this->validate(
            [
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->editingId)],
                'password' => [$this->editingId ? 'nullable' : 'required', 'confirmed', Password::min(8)],
            ],
            [
                'required' => 'Campo obrigatório.',
                'email' => 'Informe um e-mail válido.',
                'email.unique' => 'Já existe um administrador com este e-mail.',
                'max' => 'Texto muito longo.',
                'password.confirmed' => 'A confirmação não confere com a senha.',
                'password.min' => 'A senha precisa ter pelo menos 8 caracteres.',
            ],
        );

        $attributes = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (filled($validated['password'])) {
            $attributes['password'] = $validated['password'];
        }

        if ($this->editingId) {
            User::findOrFail($this->editingId)->update($attributes);
            $this->status = 'Administrador atualizado.';
        } else {
            User::create($attributes);
            $this->status = 'Administrador criado.';
        }

        $this->resetForm();
    }

    public function delete(int $userId): void
    {
        if ($userId === Auth::id()) {
            $this->status = 'Você não pode excluir a própria conta.';

            return;
        }

        User::findOrFail($userId)->delete();

        if ($this->editingId === $userId) {
            $this->resetForm();
        }

        $this->status = 'Administrador excluído.';
    }

    protected function resetForm(): void
    {
        $this->reset('formOpen', 'editingId', 'name', 'email', 'password', 'password_confirmation');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::orderBy('name')->get(),
        ]);
    }
}
