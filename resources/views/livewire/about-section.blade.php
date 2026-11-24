<section id="sobre" class="relative py-28 lg:py-36 bg-abyss scroll-mt-20">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">
            <div>
                <p class="reveal text-xs uppercase tracking-[.4em] text-amber mb-4">Sobre o Jogo</p>
                <h2 class="reveal reveal-d1 font-display font-bold text-4xl sm:text-5xl leading-tight text-bone">A terra seca guarda o que a família enterrou.</h2>
                <div class="reveal reveal-d1 divider w-32 my-8 !ml-0" style="background:linear-gradient(90deg,#C88A36,transparent)"></div>
                <div class="reveal reveal-d2 space-y-5 text-mist text-lg leading-relaxed">
                    <p>Em primeira pessoa (3D), você explora um vilarejo isolado e abandonado no coração do <span class="text-bone">Cerrado de Mato Grosso</span>.</p>
                    <p>Movido por mistérios familiares e segredos enterrados na terra seca, você precisará sobreviver à escuridão, resolver enigmas ambientais e enfrentar entidades que habitam as veredas e as matas fechadas.</p>
                </div>
                <div class="reveal reveal-d3 mt-10 flex flex-wrap gap-3 text-xs uppercase tracking-widest">
                    <span class="px-3 py-1.5 border border-bone/10 text-mist rounded-sm">Terror psicológico</span>
                    <span class="px-3 py-1.5 border border-bone/10 text-mist rounded-sm">Primeira pessoa</span>
                    <span class="px-3 py-1.5 border border-bone/10 text-mist rounded-sm">Folclore</span>
                    <span class="px-3 py-1.5 border border-bone/10 text-mist rounded-sm">Single-player</span>
                </div>
            </div>

            <!-- Card visual com moldura rústica -->
            <div class="reveal reveal-d2">
                <figure class="frame-rustic bg-coal p-3 rotate-[.6deg] shadow-[0_40px_80px_-30px_rgba(0,0,0,.9)]">
                    <span class="corner tl"></span><span class="corner tr"></span><span class="corner bl"></span><span class="corner br"></span>
                    <div class="relative aspect-[4/5] overflow-hidden bg-abyss">
                        <svg viewBox="0 0 400 500" class="w-full h-full" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
                            <defs>
                                <radialGradient id="lamp" cx="50%" cy="62%" r="55%">
                                    <stop offset="0" stop-color="#C88A36" stop-opacity=".55"/>
                                    <stop offset=".4" stop-color="#5a3a17" stop-opacity=".25"/>
                                    <stop offset="1" stop-color="#0A0A0C" stop-opacity="0"/>
                                </radialGradient>
                            </defs>
                            <rect width="400" height="500" fill="#0c0b0d"/>
                            <rect width="400" height="500" fill="url(#lamp)"/>
                            <!-- casa de adobe -->
                            <path d="M60 330 L200 230 L340 330 Z" fill="#17120e"/>
                            <rect x="80" y="325" width="240" height="140" fill="#1d1712"/>
                            <rect x="175" y="370" width="50" height="95" fill="#050405"/>
                            <rect x="105" y="360" width="38" height="34" fill="#C88A36" opacity=".85"/>
                            <rect x="105" y="360" width="38" height="34" fill="none" stroke="#0a0806" stroke-width="4"/>
                            <line x1="124" y1="360" x2="124" y2="394" stroke="#0a0806" stroke-width="3"/>
                            <rect x="257" y="360" width="38" height="34" fill="#070607"/>
                            <!-- vulto na porta -->
                            <ellipse cx="200" cy="392" rx="9" ry="11" fill="#000"/>
                            <path d="M186 465 C 186 420 190 404 200 402 C 210 404 214 420 214 465Z" fill="#000"/>
                            <circle cx="196" cy="390" r="1.4" fill="#A82A2A"/><circle cx="204" cy="390" r="1.4" fill="#A82A2A"/>
                            <rect x="0" y="465" width="400" height="35" fill="#070607"/>
                            <!-- galhos -->
                            <path d="M0 120 C 60 140 90 110 140 130 M30 128 C 40 100 30 80 50 60" stroke="#050506" stroke-width="6" fill="none"/>
                            <path d="M400 90 C 340 110 320 80 270 100 M360 98 C 350 70 360 50 345 30" stroke="#050506" stroke-width="6" fill="none"/>
                        </svg>
                        <div class="absolute inset-0 bg-gradient-to-t from-abyss via-transparent to-transparent"></div>
                    </div>
                    <figcaption class="px-2 pt-4 pb-1 flex items-center justify-between text-xs uppercase tracking-[.3em] text-mist">
                        <span>Vilarejo — MT</span><span class="text-amber">Arquivo nº 01</span>
                    </figcaption>
                </figure>
            </div>
        </div>

        <!-- Pilares -->
        <div class="mt-24 grid md:grid-cols-3 gap-6">
            @foreach ($pillars as $index => $pillar)
                @php
                    $delayClass = ['', 'reveal-d1', 'reveal-d2'][$index % 3] ?? '';
                @endphp
                <article class="pillar reveal {{ $delayClass }} bg-coal border border-bone/5 rounded-sm p-8">
                    <div class="w-12 h-12 grid place-items-center border border-amber/40 text-amber rounded-full mb-6">
                        <i data-lucide="{{ $pillar['icon'] }}" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-display text-xl font-semibold text-bone mb-3">{{ $pillar['title'] }}</h3>
                    <p class="text-mist leading-relaxed">{{ $pillar['description'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
