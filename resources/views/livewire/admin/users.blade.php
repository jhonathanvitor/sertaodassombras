<div>
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="font-display text-2xl font-bold text-bone">Administradores</h1>
            <p class="mt-2 text-sm text-mist">Quem pode entrar no painel e editar o site.</p>
        </div>
        @unless ($formOpen)
            <button type="button" wire:click="create" class="btn-blood rounded-sm px-5 py-2.5 text-sm font-semibold tracking-wide">+ Novo administrador</button>
        @endunless
    </div>

    @if ($status)
        <p class="mt-6 rounded-sm border border-bone/10 bg-coal px-4 py-3 text-sm text-emerald-400" role="status">{{ $status }}</p>
    @endif

    @if ($formOpen)
        <form wire:submit="save" class="admin-card mt-6">
            <h2 class="mb-5 text-xs uppercase tracking-[.3em] text-amber">
                {{ $editingId ? 'Editar administrador' : 'Novo administrador' }}
            </h2>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="user-name" class="admin-label">Nome</label>
                    <input id="user-name" type="text" wire:model="name" autocomplete="off" class="admin-input" />
                    @error('name') <p class="admin-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="user-email" class="admin-label">E-mail</label>
                    <input id="user-email" type="email" wire:model="email" autocomplete="off" class="admin-input" />
                    @error('email') <p class="admin-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="user-password" class="admin-label">{{ $editingId ? 'Nova senha (opcional)' : 'Senha' }}</label>
                    <input id="user-password" type="password" wire:model="password" autocomplete="new-password" class="admin-input" />
                    @error('password') <p class="admin-error">{{ $message }}</p> @enderror
                    @if ($editingId)
                        <p class="mt-1 text-xs text-mist/70">Deixe em branco para manter a senha atual.</p>
                    @endif
                </div>
                <div>
                    <label for="user-password-confirmation" class="admin-label">Confirmar senha</label>
                    <input id="user-password-confirmation" type="password" wire:model="password_confirmation" autocomplete="new-password" class="admin-input" />
                </div>
            </div>

            <div class="mt-6 flex flex-wrap justify-end gap-3">
                <button type="button" wire:click="cancel" class="btn-ghost rounded-sm px-5 py-2.5 text-sm text-amber">Cancelar</button>
                <button type="submit" class="btn-blood rounded-sm px-6 py-2.5 text-sm font-semibold tracking-wide" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Salvar alterações' : 'Criar administrador' }}</span>
                    <span wire:loading wire:target="save">Salvando…</span>
                </button>
            </div>
        </form>
    @endif

    <ul class="mt-6 divide-y divide-bone/10 rounded-sm border border-bone/10 bg-coal">
        @foreach ($users as $user)
            <li wire:key="user-{{ $user->id }}" class="flex flex-wrap items-center gap-4 px-5 py-4">
                <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-amber/30 font-display text-sm text-amber">
                    {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-bone">
                        {{ $user->name }}
                        @if ($user->id === auth()->id())
                            <span class="ml-2 rounded-sm bg-amber/15 px-2 py-0.5 text-[10px] uppercase tracking-widest text-amber">Você</span>
                        @endif
                    </p>
                    <p class="truncate text-sm text-mist">{{ $user->email }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" wire:click="edit({{ $user->id }})" class="rounded-sm border border-bone/10 px-3 py-1.5 text-sm text-mist transition-colors hover:border-amber/50 hover:text-bone">Editar</button>
                    @unless ($user->id === auth()->id())
                        <button
                            type="button"
                            wire:click="delete({{ $user->id }})"
                            wire:confirm="Excluir {{ $user->name }}? Essa pessoa perderá o acesso ao painel."
                            class="rounded-sm border border-bone/10 px-3 py-1.5 text-sm text-mist transition-colors hover:border-red-400/60 hover:text-red-400"
                        >Excluir</button>
                    @endunless
                </div>
            </li>
        @endforeach
    </ul>
</div>
