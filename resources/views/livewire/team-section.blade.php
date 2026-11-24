<section id="equipe" class="relative py-28 lg:py-36 bg-abyss scroll-mt-20">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="reveal text-xs uppercase tracking-[.4em] text-amber mb-4">Equipe &amp; Créditos</p>
            <h2 class="reveal reveal-d1 font-display font-bold text-4xl sm:text-5xl text-bone">Expiai</h2>
            <p class="reveal reveal-d2 mt-6 text-mist text-lg">Um estúdio independente de Mato Grosso contando histórias do próprio chão.</p>
        </div>

        <div id="team" class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            @foreach ($team as $i => $member)
                @php
                    $parts = preg_split('/\s+/', trim($member['name']));
                    $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                    $delayClass = ['', 'reveal-d1', 'reveal-d2', 'reveal-d3', 'reveal-d3'][$i] ?? '';
                @endphp
                <article class="pillar reveal {{ $delayClass }} group bg-coal border border-bone/5 rounded-sm p-8 text-center">
                    @if (!empty($member['photo']))
                        <div class="relative w-28 h-28 mx-auto">
                            <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}" class="w-28 h-28 mx-auto rounded-full object-cover grayscale group-hover:grayscale-0 transition" />
                            <span class="absolute -bottom-1 -right-1 w-9 h-9 rounded-full bg-coal border border-amber/40 grid place-items-center text-amber">
                                <i data-lucide="{{ $member['icon'] }}" class="w-4 h-4"></i>
                            </span>
                        </div>
                    @else
                        <div class="relative w-28 h-28 mx-auto rounded-full border border-amber/30 grid place-items-center bg-abyss group-hover:border-amber/70 group-hover:shadow-[0_0_40px_-6px_rgba(200,138,54,.45)] transition-all duration-500">
                            <span class="font-display text-3xl text-bone/90">{{ $initials }}</span>
                            <span class="absolute -bottom-1 -right-1 w-9 h-9 rounded-full bg-coal border border-amber/40 grid place-items-center text-amber">
                                <i data-lucide="{{ $member['icon'] }}" class="w-4 h-4"></i>
                            </span>
                        </div>
                    @endif
                    <h3 class="mt-6 font-display text-xl text-bone">{{ $member['name'] }}</h3>
                    <p class="mt-2 text-sm text-mist leading-relaxed">{{ $member['role'] }}</p>
                    @if (!empty($member['note']))
                        <p class="mt-3 text-[11px] uppercase tracking-[.3em] text-amber italic">{{ $member['note'] }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
