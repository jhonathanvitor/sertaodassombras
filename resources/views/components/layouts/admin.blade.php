<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>{{ $title ?? 'Painel · Sertão das Sombras' }}</title>
    <meta name="theme-color" content="#0A0A0C" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body class="min-h-screen bg-abyss text-bone antialiased">
    @auth
        <header class="sticky top-0 z-40 border-b border-bone/10 bg-abyss/90 backdrop-blur">
            <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-x-6 gap-y-3 px-4 py-4 sm:px-6">
                <a href="{{ route('admin.links') }}" class="font-display text-sm font-bold tracking-[.18em] text-bone">
                    SERTÃO <span class="text-amber">·</span> PAINEL
                </a>

                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="text-mist transition-colors hover:text-amber">Ver site ↗</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-mist transition-colors hover:text-amber">Sair</button>
                    </form>
                </div>

                <nav class="-mx-1 flex w-full gap-1 overflow-x-auto text-sm" aria-label="Seções do painel">
                    @foreach ([
                        'admin.links' => 'Links e vídeo',
                        'admin.gallery' => 'Galeria',
                        'admin.team' => 'Equipe',
                        'admin.sponsors' => 'Patrocinadores',
                        'admin.users' => 'Administradores',
                    ] as $routeName => $label)
                        <a
                            href="{{ route($routeName) }}"
                            @class([
                                'shrink-0 rounded-sm px-3 py-1.5 transition-colors',
                                'bg-blood/30 text-bone' => request()->routeIs($routeName),
                                'text-mist hover:bg-bone/5 hover:text-bone' => ! request()->routeIs($routeName),
                            ])
                            @if (request()->routeIs($routeName)) aria-current="page" @endif
                        >{{ $label }}</a>
                    @endforeach
                </nav>
            </div>
        </header>
    @endauth

    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
