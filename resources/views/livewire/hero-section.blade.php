<section class="relative min-h-[100svh] flex items-center justify-center overflow-hidden" aria-label="Apresentação">
    <video
        class="hero-bg absolute inset-0 w-full h-full object-cover object-[50%_40%]"
        autoplay muted loop playsinline preload="auto"
        poster="{{ asset('img/hero-fundo-poster.jpg') }}"
        aria-hidden="true"
        x-data
        x-init="if (matchMedia('(prefers-reduced-motion: reduce)').matches) { $el.removeAttribute('autoplay'); $el.pause() }"
    >
        <source src="{{ asset('img/hero-fundo.webm') }}" type="video/webm" />
        <source src="{{ asset('img/hero-fundo.mp4') }}" type="video/mp4" />
    </video>
    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse 60% 55% at 50% 52%, rgba(10,10,12,.72), rgba(10,10,12,.25) 70%, transparent 100%), linear-gradient(180deg, rgba(10,10,12,.55) 0%, transparent 25%)"></div>

    <div class="fog"></div>
    <div class="fog f2"></div>
    <div class="absolute inset-0 vignette pointer-events-none"></div>
    <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-abyss to-transparent pointer-events-none"></div>

    <div class="relative z-10 text-center px-5 pt-24 pb-16 max-w-5xl">
        <p class="reveal text-xs sm:text-sm uppercase tracking-[.5em] text-amber/90 mb-6">Expiai apresenta</p>
        <h1 class="reveal reveal-d1">
            <picture>
                <source type="image/webp" srcset="{{ asset('img/logo-sertao-900.webp') }} 900w, {{ asset('img/logo-sertao-1600.webp') }} 1600w" sizes="(min-width: 1024px) 760px, 92vw" />
                <img src="{{ asset('img/logo-sertao-900.png') }}" alt="Sertão das Sombras" width="900" height="390" fetchpriority="high" class="logo-hero mx-auto w-[92vw] max-w-[760px] h-auto" />
            </picture>
        </h1>
        <div class="reveal reveal-d2 divider w-56 mx-auto my-8"></div>
        <p class="reveal reveal-d2 font-display italic text-lg sm:text-2xl text-bone/85 max-w-2xl mx-auto leading-relaxed">
            “Algumas lendas do Cerrado nunca dormem. Elas esperam você entrar na mata.”
        </p>

        <div class="reveal reveal-d3 mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ $downloadWindows }}" download data-link="download-windows" class="btn-blood group inline-flex items-center gap-3 rounded-sm px-7 py-4 text-left">
                <i data-lucide="download" class="w-6 h-6 shrink-0 group-hover:translate-y-0.5 transition-transform"></i>
                <span class="flex flex-col leading-tight">
                    <span class="font-semibold tracking-wide">Download Gratuito (Windows .EXE)</span>
                    <code class="text-[11px] text-bone/70 font-mono mt-0.5">{{ $version }}</code>
                </span>
            </a>
            <a href="{{ $downloadLinux }}" download data-link="download-linux" class="btn-blood group inline-flex items-center gap-3 rounded-sm px-7 py-4 text-left">
                <i data-lucide="terminal" class="w-6 h-6 shrink-0 group-hover:translate-y-0.5 transition-transform"></i>
                <span class="flex flex-col leading-tight">
                    <span class="font-semibold tracking-wide">Download Gratuito (Linux x86_64)</span>
                    <code class="text-[11px] text-bone/70 font-mono mt-0.5">{{ $version }}</code>
                </span>
            </a>
            <button type="button" wire:click="openTrailer" data-open-trailer class="btn-ghost inline-flex items-center gap-3 rounded-sm px-7 py-4 text-amber font-semibold tracking-wide">
                <i data-lucide="play" class="w-5 h-5"></i> Assistir Trailer
            </button>
        </div>

        <p class="reveal reveal-d3 mt-8 text-[11px] sm:text-xs uppercase tracking-[.3em] text-mist">
            Desenvolvido na {{ $engine }} <span class="text-amber mx-2">•</span> 100% Brasileiro
        </p>
    </div>

    <a href="#sobre" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 text-mist hover:text-amber transition-colors animate-bounce" aria-label="Rolar para Sobre o Jogo">
        <i data-lucide="chevrons-down" class="w-6 h-6"></i>
    </a>
</section>
