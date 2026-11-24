<section id="folclore" class="relative py-28 lg:py-36 bg-coal scroll-mt-20 overflow-hidden">
    <div class="absolute inset-0 opacity-40 pointer-events-none" style="background: radial-gradient(ellipse at 50% 0%, rgba(139,30,30,.22), transparent 60%)"></div>
    <div class="relative max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="reveal text-xs uppercase tracking-[.4em] text-amber mb-4">O Folclore</p>
            <h2 class="reveal reveal-d1 font-display font-bold text-4xl sm:text-5xl text-bone">Mitos &amp; Entidades</h2>
            <p class="reveal reveal-d2 mt-6 text-mist text-lg">Fragmentos encontrados entre as ruínas. Abra os arquivos por sua conta e risco.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($archives as $index => $archive)
                @php
                    $isOpen = in_array($index, $openCards, true);
                    $delayClass = ['', 'reveal-d1', 'reveal-d2'][$index % 3] ?? '';
                @endphp
                <article
                    wire:key="lore-{{ $index }}"
                    wire:click="toggleCard({{ $index }})"
                    wire:keydown.enter="toggleCard({{ $index }})"
                    wire:keydown.space.prevent="toggleCard({{ $index }})"
                    class="letter reveal in {{ $delayClass }} {{ !empty($archive['offset']) ? 'md:translate-y-6' : '' }} {{ $isOpen ? 'open' : '' }} relative border border-amber/20 rounded-sm p-8 cursor-pointer"
                    tabindex="0"
                    role="button"
                    aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                >
                    <div class="wax absolute -top-4 right-8 w-10 h-10 rounded-full grid place-items-center text-bone/80">
                        <i data-lucide="{{ $archive['icon'] }}" class="w-4 h-4"></i>
                    </div>
                    <p class="font-mono text-[11px] tracking-widest text-amber/80 mb-4">{{ $archive['code'] }}</p>
                    <h3 class="font-display text-2xl text-bone mb-3">{{ $archive['title'] }}</h3>
                    <p class="text-mist leading-relaxed">{{ $archive['summary'] }}</p>
                    <div class="reveal-text border-l-2 border-blood/60 pl-4 font-display italic text-bone/75 leading-relaxed">
                        {{ $archive['fragment'] }}
                    </div>
                    <div class="mt-6 flex items-center gap-2 text-xs uppercase tracking-widest text-amber">
                        <span class="label">{{ $isOpen ? 'Fechar fragmento' : 'Ler fragmento' }}</span>
                        <i data-lucide="chevron-down" class="chev w-4 h-4 transition-transform duration-500"></i>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
