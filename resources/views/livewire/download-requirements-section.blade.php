<section id="requisitos" class="relative py-28 lg:py-36 bg-coal scroll-mt-20 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse at 50% 20%, rgba(200,138,54,.10), transparent 55%)"></div>
    <div class="relative max-w-5xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-14">
            <p class="reveal text-xs uppercase tracking-[.4em] text-amber mb-4">Download</p>
            <h2 class="reveal reveal-d1 font-display font-bold text-4xl sm:text-5xl text-bone">Entre na mata. Se tiver coragem.</h2>
        </div>

        <!-- Card de download -->
        <div id="download" class="reveal scroll-mt-28 frame-rustic bg-abyss/80 p-8 sm:p-12 text-center shadow-[0_40px_100px_-40px_rgba(139,30,30,.6)]">
            <span class="corner tl"></span><span class="corner tr"></span><span class="corner bl"></span><span class="corner br"></span>
            <dl class="grid sm:grid-cols-3 gap-6 sm:gap-4 mb-10 text-left sm:text-center">
                <div class="flex sm:flex-col items-center gap-4 sm:gap-2">
                    <i data-lucide="monitor" class="w-6 h-6 text-amber shrink-0"></i>
                    <div>
                        <dt class="text-[11px] uppercase tracking-[.3em] text-mist">Plataforma</dt>
                        <dd class="text-bone mt-1">Windows &amp; Linux (64-bit)<span class="block text-xs text-mist italic mt-0.5">Exportação nativa Godot 4.6</span></dd>
                    </div>
                </div>
                <div class="flex sm:flex-col items-center gap-4 sm:gap-2">
                    <i data-lucide="hard-drive" class="w-6 h-6 text-amber shrink-0"></i>
                    <div>
                        <dt class="text-[11px] uppercase tracking-[.3em] text-mist">Tamanho estimado</dt>
                        <dd class="text-bone mt-1">~2.5 GB<span class="block text-xs text-mist italic mt-0.5">Arquivo ZIP / Instalador</span></dd>
                    </div>
                </div>
                <div class="flex sm:flex-col items-center gap-4 sm:gap-2">
                    <i data-lucide="languages" class="w-6 h-6 text-amber shrink-0"></i>
                    <div>
                        <dt class="text-[11px] uppercase tracking-[.3em] text-mist">Idioma</dt>
                        <dd class="text-bone mt-1">Português (Brasil)<span class="block text-xs text-mist italic mt-0.5">Áudio e legendas</span></dd>
                    </div>
                </div>
            </dl>

            <div class="flex flex-col sm:flex-row items-stretch justify-center gap-4">
                <a
                    href="{{ $downloadWindows }}"
                    download
                    wire:click="trackDownload('windows')"
                    data-link="download-windows"
                    class="btn-blood group inline-flex items-center justify-center gap-3 rounded-sm px-8 py-5 text-left"
                >
                    <i data-lucide="monitor-down" class="w-7 h-7 shrink-0 group-hover:translate-y-0.5 transition-transform"></i>
                    <span class="flex flex-col leading-tight">
                        <span class="text-lg font-semibold tracking-wide">Baixar para Windows</span>
                        <span class="text-xs text-bone/70 mt-0.5">.EXE · 64-bit · Grátis</span>
                    </span>
                </a>
                <a
                    href="{{ $downloadLinux }}"
                    download
                    wire:click="trackDownload('linux')"
                    data-link="download-linux"
                    class="btn-blood group inline-flex items-center justify-center gap-3 rounded-sm px-8 py-5 text-left"
                >
                    <i data-lucide="terminal" class="w-7 h-7 shrink-0 group-hover:translate-y-0.5 transition-transform"></i>
                    <span class="flex flex-col leading-tight">
                        <span class="text-lg font-semibold tracking-wide">Baixar para Linux</span>
                        <span class="text-xs text-bone/70 mt-0.5">x86_64 · 64-bit · Grátis</span>
                    </span>
                </a>
            </div>
            <p class="mt-4 text-xs font-mono text-mist">{{ $version }}</p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-6 text-sm text-mist">
                <span>Também disponível em:</span>
                <a href="{{ $itchUrl }}" data-link="itch" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-amber hover:text-bone link-u">
                    <i data-lucide="gamepad-2" class="w-4 h-4"></i> Itch.io
                </a>
                <a href="{{ $githubUrl }}" data-link="github" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-amber hover:text-bone link-u">
                    <i data-lucide="github" class="w-4 h-4"></i> GitHub Releases
                </a>
            </div>
        </div>

        <!-- Tabela de requisitos -->
        <div class="reveal mt-20">
            <h3 class="font-display text-2xl sm:text-3xl text-bone text-center mb-8">Requisitos do Sistema</h3>
            <div class="overflow-x-auto border border-bone/10 rounded-sm">
                <table class="w-full min-w-[560px] text-left text-sm">
                    <caption class="sr-only">Requisitos mínimos e recomendados</caption>
                    <thead>
                        <tr class="bg-abyss">
                            <th scope="col" class="px-6 py-4 text-[11px] uppercase tracking-[.3em] text-mist font-medium w-1/4">Componente</th>
                            <th scope="col" class="px-6 py-4 font-display text-base text-bone">Mínimos</th>
                            <th scope="col" class="px-6 py-4 font-display text-base text-amber">Recomendados</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-bone/5">
                        @foreach ($requirements as $req)
                            <tr class="hover:bg-bone/[.02] transition-colors">
                                <th scope="row" class="px-6 py-4 text-mist font-normal">{{ $req['component'] }}</th>
                                <td class="px-6 py-4 text-bone/90">
                                    {{ $req['min'] }}
                                    @if (!empty($req['min_sub']))
                                        <br/><span class="text-mist">{{ $req['min_sub'] }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-bone/90">
                                    {{ $req['rec'] }}
                                    @if (!empty($req['rec_sub']))
                                        <br/><span class="text-mist">{{ $req['rec_sub'] }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
