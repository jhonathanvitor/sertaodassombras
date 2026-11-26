<form wire:submit="save">
    <h1 class="font-display text-2xl font-bold text-bone">Equipe</h1>
    <p class="mt-2 text-sm text-mist">Sem foto, aparece o ícone indicado (nomes do <a href="https://lucide.dev/icons" target="_blank" rel="noopener" class="text-amber hover:underline">Lucide</a>, ex.: compass, music, palette).</p>

    <ol class="mt-8 space-y-4">
        @forelse ($rows as $index => $row)
            <li wire:key="member-{{ $row['uid'] }}" class="admin-card flex flex-col gap-5 sm:flex-row">
                <div class="h-24 w-24 shrink-0 overflow-hidden rounded-full border border-bone/10 bg-abyss">
                    @if (filter_var($row['photo'], FILTER_VALIDATE_URL))
                        <img src="{{ $row['photo'] }}" alt="" class="h-full w-full object-cover" loading="lazy" />
                    @else
                        <div class="grid h-full w-full place-items-center text-xs text-mist/60">Sem foto</div>
                    @endif
                </div>

                <div class="grid flex-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="member-name-{{ $row['uid'] }}" class="admin-label">Nome</label>
                        <input id="member-name-{{ $row['uid'] }}" type="text" wire:model="rows.{{ $index }}.name" class="admin-input" />
                        @error("rows.{$index}.name") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="member-role-{{ $row['uid'] }}" class="admin-label">Função</label>
                        <input id="member-role-{{ $row['uid'] }}" type="text" wire:model="rows.{{ $index }}.role" class="admin-input" />
                        @error("rows.{$index}.role") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="member-photo-{{ $row['uid'] }}" class="admin-label">URL da foto</label>
                        <input id="member-photo-{{ $row['uid'] }}" type="url" wire:model.blur="rows.{{ $index }}.photo" placeholder="https://…/foto.jpg" class="admin-input" />
                        @error("rows.{$index}.photo") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="member-note-{{ $row['uid'] }}" class="admin-label">Observação (opcional)</label>
                        <input id="member-note-{{ $row['uid'] }}" type="text" wire:model="rows.{{ $index }}.note" class="admin-input" />
                        @error("rows.{$index}.note") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="member-icon-{{ $row['uid'] }}" class="admin-label">Ícone</label>
                        <input id="member-icon-{{ $row['uid'] }}" type="text" wire:model="rows.{{ $index }}.icon" class="admin-input" />
                        @error("rows.{$index}.icon") <p class="admin-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                @include('livewire.admin.partials.row-actions', ['index' => $index, 'total' => count($rows)])
            </li>
        @empty
            <li class="admin-card text-center text-sm text-mist">Nenhum integrante. Adicione o primeiro abaixo.</li>
        @endforelse
    </ol>

    @include('livewire.admin.partials.save-bar', ['addLabel' => 'Adicionar integrante'])
</form>
