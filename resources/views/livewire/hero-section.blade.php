<section class="relative min-h-[100svh] flex items-center justify-center overflow-hidden" aria-label="Apresentação">
    <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
        <defs>
            <radialGradient id="sky" cx="68%" cy="22%" r="85%">
                <stop offset="0" stop-color="#2a2016"/>
                <stop offset=".35" stop-color="#16120f"/>
                <stop offset="1" stop-color="#0A0A0C"/>
            </radialGradient>
            <radialGradient id="halo" cx="50%" cy="50%" r="50%">
                <stop offset="0" stop-color="#C88A36" stop-opacity=".28"/>
                <stop offset="1" stop-color="#C88A36" stop-opacity="0"/>
            </radialGradient>
            <linearGradient id="ground" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0" stop-color="#0d0c0e"/><stop offset="1" stop-color="#050506"/>
            </linearGradient>
            <mask id="crescent">
                <rect width="1600" height="900" fill="black"/>
                <circle cx="1090" cy="210" r="70" fill="white"/>
                <circle cx="1118" cy="192" r="62" fill="black"/>
            </mask>
        </defs>
        <rect width="1600" height="900" fill="url(#sky)"/>
        <!-- estrelas -->
        <g fill="#EAE6DF" opacity=".55">
            <circle cx="120" cy="90" r="1"/><circle cx="310" cy="160" r=".8"/><circle cx="460" cy="70" r="1.1"/>
            <circle cx="640" cy="130" r=".7"/><circle cx="820" cy="60" r="1"/><circle cx="1320" cy="110" r=".9"/>
            <circle cx="1460" cy="200" r="1.2"/><circle cx="1530" cy="70" r=".8"/><circle cx="960" cy="320" r=".6"/>
            <circle cx="230" cy="280" r=".7"/><circle cx="1240" cy="300" r=".7"/>
        </g>
        <!-- lua crescente -->
        <circle cx="1090" cy="210" r="260" fill="url(#halo)"/>
        <g class="moon-glow"><rect width="1600" height="900" fill="#E9D7B5" mask="url(#crescent)"/></g>

        <!-- colinas distantes -->
        <path d="M0 620 C 200 570 380 600 560 575 S 900 540 1100 580 S 1450 560 1600 590 V900 H0Z" fill="#121114"/>

        <!-- árvores tortuosas do cerrado (fundo) -->
        <g fill="#0f0e11" stroke="#0f0e11" stroke-linecap="round">
            <path d="M210 640 C 205 600 225 570 200 530 M200 560 C 175 545 160 520 150 505 M208 575 C 235 560 250 540 270 535" stroke-width="7" fill="none"/>
            <ellipse cx="150" cy="500" rx="40" ry="16"/><ellipse cx="270" cy="528" rx="44" ry="15"/><ellipse cx="200" cy="522" rx="30" ry="12"/>
            <path d="M1400 615 C 1395 580 1420 555 1400 515 M1402 545 C 1380 530 1365 515 1350 500 M1405 560 C 1430 545 1445 525 1470 520" stroke-width="7" fill="none"/>
            <ellipse cx="1350" cy="495" rx="42" ry="15"/><ellipse cx="1470" cy="514" rx="46" ry="16"/>
        </g>

        <!-- chão -->
        <path d="M0 700 C 260 660 520 690 800 675 S 1300 650 1600 690 V900 H0Z" fill="url(#ground)"/>

        <!-- árvores (primeiro plano) -->
        <g fill="#060607" stroke="#060607" stroke-linecap="round" fill-rule="evenodd">
            <path d="M70 900 C 80 800 50 760 90 690 C 110 650 80 620 60 590 M88 700 C 130 680 150 650 190 640 M75 640 C 45 625 30 600 10 590" stroke-width="16" fill="none"/>
            <ellipse cx="20" cy="582" rx="70" ry="24"/><ellipse cx="195" cy="632" rx="62" ry="22"/><ellipse cx="65" cy="580" rx="50" ry="18"/>
            <path d="M1520 900 C 1510 810 1545 770 1505 700 C 1490 670 1520 640 1540 610 M1508 720 C 1470 700 1450 675 1410 668" stroke-width="16" fill="none"/>
            <ellipse cx="1550" cy="600" rx="70" ry="24"/><ellipse cx="1405" cy="660" rx="60" ry="20"/>
        </g>

        <!-- cactos (mandacaru) -->
        <g fill="#08080a">
            <path d="M455 720 v-120 a14 14 0 0 1 28 0 v120z"/><path d="M455 660 h-26 v-40 a12 12 0 0 1 24 0 v22 h2z"/><path d="M483 680 h22 v-52 a12 12 0 0 1 24 0 v70 h-46z"/>
            <path d="M1185 712 v-90 a11 11 0 0 1 22 0 v90z"/><path d="M1185 670 h-20 v-30 a10 10 0 0 1 20 0z"/><path d="M1207 680 h18 v-40 a10 10 0 0 1 20 0 v50 h-38z"/>
        </g>

        <!-- cavaleiro solitário -->
        <g fill="#030304" transform="translate(760 560)">
            <!-- cavalo -->
            <path d="M-70 95 C -72 70 -60 52 -30 48 L 40 46 C 58 44 68 30 74 10 L 86 -6 C 92 -10 100 -6 98 2 L 92 18 C 88 34 80 48 70 58 C 62 66 58 80 60 95 L 52 140 L 44 140 L 48 100 C 30 104 0 104 -22 100 L -28 140 L -36 140 L -38 104 C -50 110 -56 125 -54 140 L -62 140 C -66 120 -70 108 -70 95Z"/>
            <path d="M-70 70 C -90 72 -100 90 -96 116 C -92 100 -84 86 -70 84Z"/>
            <!-- cavaleiro -->
            <path d="M-8 48 C -12 20 -6 0 6 -10 L 14 -10 C 22 2 24 24 20 48Z"/>
            <path d="M-18 -14 L 36 -14 L 30 -20 L 20 -20 C 20 -34 2 -34 2 -20 L -8 -20Z"/>
            <circle cx="11" cy="-24" r="8"/>
            <path d="M18 8 L 46 34 L 42 38 L 16 16Z"/>
        </g>
    </svg>

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
