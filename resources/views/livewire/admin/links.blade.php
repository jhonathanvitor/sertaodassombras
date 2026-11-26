@php
    $groups = [
        'Downloads' => [
            'download_windows' => ['Download para Windows', 'https://…/SertaoDasSombras_Windows.exe'],
            'download_linux' => ['Download para Linux', 'https://…/SertaoDasSombras_Linux.x86_64'],
            'version' => ['Versão exibida nos botões', 'v1.0 - Build Oficial'],
            'itch' => ['Página no itch.io', 'https://expiai.itch.io/…'],
            'github' => ['GitHub Releases', 'https://github.com/…/releases'],
        ],
        'Vídeo' => [
            'youtube_id' => ['Trailer no YouTube (link ou ID)', 'https://www.youtube.com/watch?v=…'],
        ],
        'Redes sociais' => [
            'instagram' => ['Instagram', 'https://instagram.com/…'],
            'youtube' => ['Canal no YouTube', 'https://youtube.com/@…'],
            'twitter' => ['X / Twitter', 'https://x.com/…'],
        ],
    ];
@endphp

<form wire:submit="save">
    <h1 class="font-display text-2xl font-bold text-bone">Links e vídeo</h1>
    <p class="mt-2 text-sm text-mist">Para onde apontam os botões de download, o trailer e as redes sociais da página.</p>

    <div class="mt-8 space-y-6">
        @foreach ($groups as $groupTitle => $fields)
            <fieldset class="admin-card">
                <legend class="px-2 text-xs uppercase tracking-[.3em] text-amber">{{ $groupTitle }}</legend>
                <div class="grid gap-5 sm:grid-cols-2">
                    @foreach ($fields as $key => [$label, $placeholder])
                        <div @class(['sm:col-span-2' => str_starts_with($key, 'download_')])>
                            <label for="setting-{{ $key }}" class="admin-label">{{ $label }}</label>
                            <input
                                id="setting-{{ $key }}"
                                type="{{ $key === 'version' || $key === 'youtube_id' ? 'text' : 'url' }}"
                                wire:model="settings.{{ $key }}"
                                placeholder="{{ $placeholder }}"
                                class="admin-input"
                            />
                            @error("settings.{$key}") <p class="admin-error">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                </div>

                @if ($groupTitle === 'Vídeo' && preg_match('/^[A-Za-z0-9_-]{11}$/', $settings['youtube_id'] ?? ''))
                    <div class="mt-5 aspect-video w-full max-w-md overflow-hidden rounded-sm border border-bone/10 bg-abyss">
                        <img src="https://i.ytimg.com/vi/{{ $settings['youtube_id'] }}/hqdefault.jpg" alt="Miniatura do trailer" class="h-full w-full object-cover" loading="lazy" />
                    </div>
                @endif
            </fieldset>
        @endforeach
    </div>

    @include('livewire.admin.partials.save-bar')
</form>
