@php
    $tints = ['amber' => '#C88A36', 'blood' => '#8B1E1E', 'mist' => '#9A958E'];
@endphp

<div
    x-data
    @keydown.window.escape="
        if ($wire.trailerModalOpen) $wire.closeTrailerModal();
        if ($wire.lightboxOpen) $wire.closeLightbox();
    "
    @keydown.window.arrow-left="if ($wire.lightboxOpen) $wire.prevShot()"
    @keydown.window.arrow-right="if ($wire.lightboxOpen) $wire.nextShot()"
>
    <section id="galeria" class="relative py-28 lg:py-36 bg-abyss scroll-mt-20">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-14">
                <div>
                    <p class="reveal text-xs uppercase tracking-[.4em] text-amber mb-4">Galeria</p>
                    <h2 class="reveal reveal-d1 font-display font-bold text-4xl sm:text-5xl text-bone">Trailer &amp; Capturas</h2>
                </div>
                <p class="reveal reveal-d2 text-mist max-w-md">Imagens capturadas diretamente da build oficial. Clique para ampliar.</p>
            </div>

            <!-- Player de vídeo (YouTube) -->
            <div class="reveal frame-rustic bg-coal p-2 mb-10">
                <span class="corner tl"></span><span class="corner tr"></span><span class="corner bl"></span><span class="corner br"></span>
                <div id="inlinePlayer" class="relative aspect-video bg-abyss overflow-hidden">
                    @if ($inlineTrailerPlaying)
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}?autoplay=1&rel=0&modestbranding=1"
                            title="Trailer — Sertão das Sombras"
                            frameborder="0"
                            allow="autoplay; encrypted-media; picture-in-picture; fullscreen"
                            allowfullscreen
                        ></iframe>
                    @else
                        <button
                            type="button"
                            id="inlinePlayBtn"
                            wire:click="playInlineTrailer"
                            class="group absolute inset-0 w-full h-full grid place-items-center"
                            aria-label="Reproduzir trailer"
                        >
                            <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 40%, rgba(200,138,54,.18), transparent 60%), linear-gradient(180deg,#141418,#0A0A0C)"></div>
                            <span class="relative w-20 h-20 sm:w-24 sm:h-24 rounded-full border border-amber/60 grid place-items-center text-amber group-hover:bg-amber/10 group-hover:scale-105 group-hover:shadow-[0_0_50px_rgba(200,138,54,.4)] transition-all duration-300">
                                <i data-lucide="play" class="w-8 h-8 ml-1"></i>
                            </span>
                            <span class="absolute bottom-6 left-6 text-left">
                                <span class="block font-display text-xl sm:text-2xl text-bone">Trailer Oficial</span>
                                <span class="block text-xs uppercase tracking-[.3em] text-mist mt-1">Sertão das Sombras · v1.0</span>
                            </span>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Grid de screenshots -->
            <div id="gallery" class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                @foreach ($shots as $i => $shot)
                    @php
                        $delayClass = ['', 'reveal-d1', 'reveal-d2'][$i % 3] ?? '';
                        $c = $tints[$shot['hue'] ?? 'amber'] ?? '#C88A36';
                        $x = 120 + ($i * 97) % 560;
                        $cxPct = round($x / 800 * 100);
                        $num = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
                    @endphp
                    <button
                        type="button"
                        wire:key="shot-{{ $i }}"
                        wire:click="openLightbox({{ $i }})"
                        data-shot="{{ $i }}"
                        class="shot-wrap reveal in {{ $delayClass }} group relative aspect-video overflow-hidden border border-bone/10 rounded-sm bg-coal text-left transition-colors duration-500"
                        aria-label="Ampliar: {{ $shot['caption'] }}"
                    >
                        @if (!empty($shot['src']))
                            <img class="shot w-full h-full object-cover" src="{{ $shot['src'] }}" alt="{{ $shot['caption'] }}" loading="lazy" />
                        @else
                            <div class="shot w-full h-full">
                                <svg viewBox="0 0 800 450" preserveAspectRatio="xMidYMid slice" class="w-full h-full" aria-hidden="true">
                                    <defs>
                                        <radialGradient id="g{{ $i }}" cx="{{ $cxPct }}%" cy="35%" r="70%">
                                            <stop offset="0" stop-color="{{ $c }}" stop-opacity=".45"/>
                                            <stop offset=".5" stop-color="{{ $c }}" stop-opacity=".08"/>
                                            <stop offset="1" stop-color="#0A0A0C" stop-opacity="0"/>
                                        </radialGradient>
                                    </defs>
                                    <rect width="800" height="450" fill="#0c0b0e"/>
                                    <rect width="800" height="450" fill="url(#g{{ $i }})"/>
                                    <path d="M0 330 C 150 300 300 320 420 305 S 650 290 800 315 V450 H0Z" fill="#08080a"/>
                                    <path d="M{{ $x - 200 }} 450 C {{ $x - 190 }} 380 {{ $x - 215 }} 350 {{ $x - 185 }} 300 M{{ $x - 188 }} 320 C {{ $x - 150 }} 305 {{ $x - 130 }} 285 {{ $x - 100 }} 280" stroke="#040405" stroke-width="10" fill="none" stroke-linecap="round"/>
                                    <ellipse cx="{{ $x - 100 }}" cy="276" rx="50" ry="16" fill="#040405"/>
                                    <path d="M{{ $x + 120 }} 330 v-70 a9 9 0 0 1 18 0 v70z M{{ $x + 120 }} 290 h-16 v-22 a8 8 0 0 1 16 0z" fill="#050506"/>
                                    <text x="30" y="420" fill="#EAE6DF" opacity=".35" font-family="Inter" font-size="14" letter-spacing="4">SCREENSHOT {{ $num }}</text>
                                </svg>
                            </div>
                        @endif
                        <span class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-70 group-hover:opacity-100 transition-opacity"></span>
                        <span class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs text-bone/90 translate-y-1 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            <span class="truncate">{{ $shot['caption'] }}</span>
                            <i data-lucide="maximize-2" class="w-4 h-4 text-amber shrink-0"></i>
                        </span>
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===================== MODAL TRAILER ===================== -->
    <div
        id="trailerModal"
        wire:click.self="closeTrailerModal"
        class="modal {{ $trailerModalOpen ? 'open' : '' }} fixed inset-0 z-[70] bg-black/90 backdrop-blur-sm grid place-items-center p-4"
        role="dialog"
        aria-modal="true"
        aria-label="Trailer"
    >
        <div class="modal-box relative w-full max-w-5xl">
            <button
                type="button"
                wire:click="closeTrailerModal"
                data-close
                class="absolute -top-12 right-0 inline-flex items-center gap-2 text-mist hover:text-amber text-sm uppercase tracking-widest"
                aria-label="Fechar trailer"
            >
                Fechar <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <div class="frame-rustic bg-abyss p-2">
                <div id="modalVideo" class="aspect-video bg-black">
                    @if ($trailerModalOpen)
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}?autoplay=1&rel=0&modestbranding=1"
                            title="Trailer — Sertão das Sombras"
                            frameborder="0"
                            allow="autoplay; encrypted-media; picture-in-picture; fullscreen"
                            allowfullscreen
                        ></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== LIGHTBOX ===================== -->
    @php
        $activeShot = $shots[$currentShot] ?? ['src' => '', 'caption' => '', 'hue' => 'amber'];
        $lbColor = $tints[$activeShot['hue'] ?? 'amber'] ?? '#C88A36';
        $lbIndex = $currentShot + 100;
        $lbX = 120 + ($lbIndex * 97) % 560;
        $lbCxPct = round($lbX / 800 * 100);
        $lbNum = str_pad((string) ($currentShot + 1), 2, '0', STR_PAD_LEFT);
        $lbTotal = str_pad((string) count($shots), 2, '0', STR_PAD_LEFT);
    @endphp
    <div
        id="lightbox"
        wire:click.self="closeLightbox"
        class="modal {{ $lightboxOpen ? 'open' : '' }} fixed inset-0 z-[70] bg-black/95 backdrop-blur-sm grid place-items-center p-4"
        role="dialog"
        aria-modal="true"
        aria-label="Captura de tela ampliada"
    >
        <div class="modal-box relative w-full max-w-6xl">
            <button
                type="button"
                wire:click="closeLightbox"
                data-close
                class="absolute -top-12 right-0 inline-flex items-center gap-2 text-mist hover:text-amber text-sm uppercase tracking-widest"
                aria-label="Fechar"
            >
                Fechar <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <button
                type="button"
                id="lbPrev"
                wire:click="prevShot"
                class="absolute left-2 sm:-left-14 top-1/2 -translate-y-1/2 z-10 w-11 h-11 grid place-items-center rounded-full border border-bone/20 bg-black/60 text-bone hover:text-amber hover:border-amber/60"
                aria-label="Anterior"
            >
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            <button
                type="button"
                id="lbNext"
                wire:click="nextShot"
                class="absolute right-2 sm:-right-14 top-1/2 -translate-y-1/2 z-10 w-11 h-11 grid place-items-center rounded-full border border-bone/20 bg-black/60 text-bone hover:text-amber hover:border-amber/60"
                aria-label="Próxima"
            >
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
            <div class="frame-rustic bg-abyss p-2">
                <div id="lbContent" class="aspect-video overflow-hidden bg-black">
                    @if (!empty($activeShot['src']))
                        <img src="{{ $activeShot['src'] }}" alt="{{ $activeShot['caption'] }}" class="w-full h-full object-contain" />
                    @else
                        <svg viewBox="0 0 800 450" preserveAspectRatio="xMidYMid slice" class="w-full h-full" aria-hidden="true">
                            <defs>
                                <radialGradient id="g{{ $lbIndex }}" cx="{{ $lbCxPct }}%" cy="35%" r="70%">
                                    <stop offset="0" stop-color="{{ $lbColor }}" stop-opacity=".45"/>
                                    <stop offset=".5" stop-color="{{ $lbColor }}" stop-opacity=".08"/>
                                    <stop offset="1" stop-color="#0A0A0C" stop-opacity="0"/>
                                </radialGradient>
                            </defs>
                            <rect width="800" height="450" fill="#0c0b0e"/>
                            <rect width="800" height="450" fill="url(#g{{ $lbIndex }})"/>
                            <path d="M0 330 C 150 300 300 320 420 305 S 650 290 800 315 V450 H0Z" fill="#08080a"/>
                            <path d="M{{ $lbX - 200 }} 450 C {{ $lbX - 190 }} 380 {{ $lbX - 215 }} 350 {{ $lbX - 185 }} 300 M{{ $lbX - 188 }} 320 C {{ $lbX - 150 }} 305 {{ $lbX - 130 }} 285 {{ $lbX - 100 }} 280" stroke="#040405" stroke-width="10" fill="none" stroke-linecap="round"/>
                            <ellipse cx="{{ $lbX - 100 }}" cy="276" rx="50" ry="16" fill="#040405"/>
                            <path d="M{{ $lbX + 120 }} 330 v-70 a9 9 0 0 1 18 0 v70z M{{ $lbX + 120 }} 290 h-16 v-22 a8 8 0 0 1 16 0z" fill="#050506"/>
                            <text x="30" y="420" fill="#EAE6DF" opacity=".35" font-family="Inter" font-size="14" letter-spacing="4">SCREENSHOT {{ str_pad((string) ($lbIndex + 1), 2, '0', STR_PAD_LEFT) }}</text>
                        </svg>
                    @endif
                </div>
            </div>
            <p id="lbCaption" class="mt-4 text-center text-sm text-mist tracking-wide">
                {{ $lbNum }} / {{ $lbTotal }} — {{ $activeShot['caption'] }}
            </p>
        </div>
    </div>
</div>
