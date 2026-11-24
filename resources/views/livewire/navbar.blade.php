<header
    id="navbar"
    x-data="{ scrolled: window.scrollY > 40 }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 40 }, { passive: true })"
    :class="{ 'scrolled': scrolled || $wire.mobileMenuOpen }"
    class="fixed top-0 inset-x-0 z-50 border-b border-transparent transition-all duration-500"
>
    <nav class="max-w-7xl mx-auto px-5 lg:px-8 h-20 flex items-center justify-between" aria-label="Navegação principal">
        <a href="#topo" class="group flex flex-col leading-none">
            <span class="font-display font-bold text-lg sm:text-xl tracking-[.18em] text-bone group-hover:text-amber transition-colors">SERTÃO DAS SOMBRAS</span>
            <span class="mt-1 text-[10px] uppercase tracking-[.35em] text-mist">Expiai</span>
        </a>

        <ul class="hidden lg:flex items-center gap-8 text-sm text-mist">
            <li><a class="link-u hover:text-bone transition-colors" href="#sobre">Sobre o Jogo</a></li>
            <li><a class="link-u hover:text-bone transition-colors" href="#folclore">O Folclore</a></li>
            <li><a class="link-u hover:text-bone transition-colors" href="#galeria">Galeria</a></li>
            <li><a class="link-u hover:text-bone transition-colors" href="#equipe">Equipe &amp; Créditos</a></li>
            <li><a class="link-u hover:text-bone transition-colors" href="#requisitos">Requisitos</a></li>
        </ul>

        <div class="flex items-center gap-3">
            <a href="#download" class="btn-blood hidden sm:inline-flex items-center gap-2 rounded-sm px-5 py-2.5 text-sm font-semibold tracking-wide">
                <i data-lucide="download" class="w-4 h-4"></i> Baixar Agora (PC)
            </a>
            <button
                type="button"
                wire:click="toggleMobileMenu"
                class="lg:hidden p-2 text-bone hover:text-amber transition-colors"
                aria-label="Abrir menu"
                aria-expanded="{{ $mobileMenuOpen ? 'true' : 'false' }}"
                aria-controls="mobileMenu"
            >
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </nav>

    <!-- Menu mobile -->
    <div id="mobileMenu" class="lg:hidden {{ $mobileMenuOpen ? '' : 'hidden' }} bg-abyss/95 backdrop-blur-xl border-t border-bone/5">
        <ul class="px-6 py-6 space-y-4 font-display tracking-widest text-bone">
            <li><a href="#sobre" wire:click="closeMobileMenu" class="block py-1 hover:text-amber">Sobre o Jogo</a></li>
            <li><a href="#folclore" wire:click="closeMobileMenu" class="block py-1 hover:text-amber">O Folclore</a></li>
            <li><a href="#galeria" wire:click="closeMobileMenu" class="block py-1 hover:text-amber">Galeria</a></li>
            <li><a href="#equipe" wire:click="closeMobileMenu" class="block py-1 hover:text-amber">Equipe &amp; Créditos</a></li>
            <li><a href="#requisitos" wire:click="closeMobileMenu" class="block py-1 hover:text-amber">Requisitos</a></li>
            <li class="pt-2">
                <a href="#download" wire:click="closeMobileMenu" class="btn-blood inline-flex items-center gap-2 rounded-sm px-5 py-3 text-sm font-sans font-semibold tracking-wide">
                    <i data-lucide="download" class="w-4 h-4"></i> Baixar Agora (PC)
                </a>
            </li>
        </ul>
    </div>
</header>
