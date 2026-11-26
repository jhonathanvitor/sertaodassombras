<footer class="relative bg-coal border-t border-bone/5">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-16">
        <!-- Chancela cultural -->
        <div class="reveal text-center max-w-3xl mx-auto">
            <p class="text-[11px] uppercase tracking-[.4em] text-amber mb-4">Apoio Cultural</p>
            <p class="text-bone/85 leading-relaxed">
                Projeto contemplado pelo <strong class="font-semibold text-bone">Edital nº 23/2024/SECEL/MT – Cinemotion Audiovisual</strong>
                (PNAB – Política Nacional Aldir Blanc de Fomento à Cultura).
            </p>
        </div>

        <!-- Logomarcas -->
        <ul class="reveal mt-12 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4" aria-label="Realização e apoio">
            @foreach ($sponsors as $sponsor)
                <li class="h-24 border border-dashed border-bone/15 rounded-sm grid place-items-center px-3 text-center text-[11px] uppercase tracking-widest text-bone/60 hover:border-amber/40 hover:text-bone transition-colors">
                    @if (!empty($sponsor['logo']))
                        <img src="{{ $sponsor['logo'] }}" alt="{{ str_replace("\n", ' ', $sponsor['name']) }}" class="h-12 w-auto opacity-80 grayscale brightness-200 hover:opacity-100 transition" />
                    @else
                        {!! nl2br(e($sponsor['name'])) !!}
                    @endif
                </li>
            @endforeach
        </ul>

        <div class="divider my-12"></div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="text-center md:text-left">
                <picture>
                    <source srcset="{{ asset('img/logo-sertao-360.webp') }}" type="image/webp" />
                    <img src="{{ asset('img/logo-sertao-900.png') }}" alt="Sertão das Sombras" width="360" height="156" loading="lazy" class="h-14 w-auto mx-auto md:mx-0" />
                </picture>
                <a href="mailto:{{ $email }}" class="mt-2 inline-flex items-center gap-2 text-sm text-mist hover:text-amber transition-colors">
                    <i data-lucide="mail" class="w-4 h-4"></i> {{ $email }}
                </a>
            </div>
            <!-- Redes sociais -->
            <ul class="flex items-center gap-3" aria-label="Redes sociais">
                <li>
                    <a href="{{ ($links['instagram'] ?? '') ?: '#' }}" target="_blank" rel="noopener" aria-label="Instagram" class="w-10 h-10 grid place-items-center border border-bone/10 rounded-full text-mist hover:text-amber hover:border-amber/50 hover:shadow-[0_0_20px_rgba(200,138,54,.25)] transition-all">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ ($links['youtube'] ?? '') ?: '#' }}" target="_blank" rel="noopener" aria-label="YouTube" class="w-10 h-10 grid place-items-center border border-bone/10 rounded-full text-mist hover:text-amber hover:border-amber/50 hover:shadow-[0_0_20px_rgba(200,138,54,.25)] transition-all">
                        <i data-lucide="youtube" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ ($links['twitter'] ?? '') ?: '#' }}" target="_blank" rel="noopener" aria-label="X / Twitter" class="w-10 h-10 grid place-items-center border border-bone/10 rounded-full text-mist hover:text-amber hover:border-amber/50 hover:shadow-[0_0_20px_rgba(200,138,54,.25)] transition-all">
                        <i data-lucide="twitter" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ ($links['itch'] ?? '') ?: '#' }}" data-link="itch" target="_blank" rel="noopener" aria-label="Itch.io" class="w-10 h-10 grid place-items-center border border-bone/10 rounded-full text-mist hover:text-amber hover:border-amber/50 hover:shadow-[0_0_20px_rgba(200,138,54,.25)] transition-all">
                        <i data-lucide="gamepad-2" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ ($links['github'] ?? '') ?: '#' }}" data-link="github" target="_blank" rel="noopener" aria-label="GitHub" class="w-10 h-10 grid place-items-center border border-bone/10 rounded-full text-mist hover:text-amber hover:border-amber/50 hover:shadow-[0_0_20px_rgba(200,138,54,.25)] transition-all">
                        <i data-lucide="github" class="w-4 h-4"></i>
                    </a>
                </li>
            </ul>
        </div>

        <p class="mt-10 text-center text-xs text-mist/80">{{ $copyright }}</p>
    </div>
</footer>
