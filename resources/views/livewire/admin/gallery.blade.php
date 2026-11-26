<form wire:submit="save">
    <h1 class="font-display text-2xl font-bold text-bone">Galeria</h1>
    <p class="mt-2 text-sm text-mist">Capturas de tela exibidas na página. Sem imagem, aparece um quadro com a cor escolhida.</p>

    <ol class="mt-8 space-y-4">
        @forelse ($rows as $index => $row)
            <li wire:key="shot-{{ $row['uid'] }}" class="admin-card flex flex-col gap-5 sm:flex-row">
                <div class="aspect-video w-full shrink-0 overflow-hidden rounded-sm border border-bone/10 bg-abyss sm:w-48">
                    @if (filter_var($row['src'], FILTER_VALIDATE_URL))
                        <img src="{{ $row['src'] }}" alt="" class="h-full w-full object-cover" loading="lazy" />
                    @else
                        <div class="grid h-full w-full place-items-center text-xs text-mist/60">Sem imagem</div>
                    @endif
                </div>

                <div class="grid flex-1 gap-4 sm:grid-cols-[1fr_9rem]">
                    <div class="sm:col-span-2">
                        <label for="shot-src-{{ $row['uid'] }}" class="admin-label">URL da imagem</label>
                        <input id="shot-src-{{ $row['uid'] }}" type="url" wire:model.blur="rows.{{ $index }}.src" placeholder="https://…/captura.jpg" class="admin-input" />
                        @error("rows.{$index}.src") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="shot-caption-{{ $row['uid'] }}" class="admin-label">Legenda</label>
                        <input id="shot-caption-{{ $row['uid'] }}" type="text" wire:model="rows.{{ $index }}.caption" class="admin-input" />
                        @error("rows.{$index}.caption") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="shot-hue-{{ $row['uid'] }}" class="admin-label">Cor de fundo</label>
                        <select id="shot-hue-{{ $row['uid'] }}" wire:model="rows.{{ $index }}.hue" class="admin-input">
                            @foreach (\App\Livewire\Admin\Gallery::HUES as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error("rows.{$index}.hue") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                @include('livewire.admin.partials.row-actions', ['index' => $index, 'total' => count($rows)])
            </li>
        @empty
            <li class="admin-card text-center text-sm text-mist">Nenhuma imagem. Adicione a primeira abaixo.</li>
        @endforelse
    </ol>

    @include('livewire.admin.partials.save-bar', ['addLabel' => 'Adicionar imagem'])
</form>
