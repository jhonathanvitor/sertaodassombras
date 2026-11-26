<div class="flex min-h-[70vh] items-center justify-center">
    <div class="w-full max-w-sm">
        <div class="mb-8 text-center">
            <p class="mb-3 text-[11px] uppercase tracking-[.4em] text-amber">Área restrita</p>
            <h1>
                <picture>
                    <source srcset="{{ asset('img/logo-sertao-360.webp') }}" type="image/webp" />
                    <img src="{{ asset('img/logo-sertao-900.png') }}" alt="Sertão das Sombras" width="360" height="156" class="mx-auto h-16 w-auto" />
                </picture>
            </h1>
        </div>

        <form wire:submit="login" class="frame-rustic space-y-5 bg-coal p-7">
            <span class="corner tl"></span><span class="corner tr"></span><span class="corner bl"></span><span class="corner br"></span>

            <div>
                <label for="email" class="admin-label">E-mail</label>
                <input id="email" type="email" wire:model="email" autocomplete="username" autofocus required class="admin-input" />
                @error('email') <p class="admin-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="admin-label">Senha</label>
                <input id="password" type="password" wire:model="password" autocomplete="current-password" required class="admin-input" />
                @error('password') <p class="admin-error">{{ $message }}</p> @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-mist">
                <input type="checkbox" wire:model="remember" class="accent-amber" />
                Manter conectado
            </label>

            <button type="submit" class="btn-blood w-full rounded-sm px-6 py-3 text-sm font-semibold tracking-wide" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="login">Entrar</span>
                <span wire:loading wire:target="login">Entrando…</span>
            </button>
        </form>

        <p class="mt-6 text-center text-sm">
            <a href="{{ route('home') }}" class="text-mist transition-colors hover:text-amber">← Voltar ao site</a>
        </p>
    </div>
</div>
