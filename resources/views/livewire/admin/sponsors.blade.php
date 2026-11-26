<form wire:submit="save">
    <h1 class="font-display text-2xl font-bold text-bone">Patrocinadores</h1>
    <p class="mt-2 text-sm text-mist">Logomarcas do rodapé. Sem logo, aparece o nome; use uma quebra de linha para dividir em duas linhas.</p>

    <ol class="mt-8 space-y-4">
        @forelse ($rows as $index => $row)
            <li wire:key="sponsor-{{ $row['uid'] }}" class="admin-card flex flex-col gap-5 sm:flex-row">
                <div class="grid h-20 w-full shrink-0 place-items-center rounded-sm border border-dashed border-bone/15 bg-abyss px-3 sm:w-40">
                    @if (filter_var($row['logo'], FILTER_VALIDATE_URL))
                        <img src="{{ $row['logo'] }}" alt="" class="h-12 w-auto object-contain" loading="lazy" />
                    @else
                        <span class="text-center text-[11px] uppercase tracking-widest text-mist/70">{!! nl2br(e($row['name'] ?: 'Sem logo')) !!}</span>
                    @endif
                </div>

                <div class="grid flex-1 gap-4">
                    <div>
                        <label for="sponsor-name-{{ $row['uid'] }}" class="admin-label">Nome</label>
                        <textarea id="sponsor-name-{{ $row['uid'] }}" rows="2" wire:model.blur="rows.{{ $index }}.name" class="admin-input resize-none"></textarea>
                        @error("rows.{$index}.name") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="sponsor-logo-{{ $row['uid'] }}" class="admin-label">URL da logo</label>
                        <input id="sponsor-logo-{{ $row['uid'] }}" type="url" wire:model.blur="rows.{{ $index }}.logo" placeholder="https://…/logo.png" class="admin-input" />
                        @error("rows.{$index}.logo") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                @include('livewire.admin.partials.row-actions', ['index' => $index, 'total' => count($rows)])
            </li>
        @empty
            <li class="admin-card text-center text-sm text-mist">Nenhum patrocinador. Adicione o primeiro abaixo.</li>
        @endforelse
    </ol>

    @include('livewire.admin.partials.save-bar', ['addLabel' => 'Adicionar patrocinador'])
</form>
