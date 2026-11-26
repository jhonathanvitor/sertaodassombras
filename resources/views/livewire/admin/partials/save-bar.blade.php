{{-- Expects optional $addLabel --}}
<div class="sticky bottom-0 -mx-4 mt-8 flex flex-wrap items-center gap-3 border-t border-bone/10 bg-abyss/95 px-4 py-4 backdrop-blur sm:mx-0 sm:rounded-sm sm:border sm:px-5">
    @isset($addLabel)
        <button type="button" wire:click="addRow" class="btn-ghost rounded-sm px-4 py-2.5 text-sm text-amber">+ {{ $addLabel }}</button>
    @endisset
    <button type="submit" class="btn-blood ml-auto rounded-sm px-6 py-2.5 text-sm font-semibold tracking-wide" wire:loading.attr="disabled" wire:target="save">
        <span wire:loading.remove wire:target="save">Salvar alterações</span>
        <span wire:loading wire:target="save">Salvando…</span>
    </button>
    @if ($status)
        <p class="w-full text-right text-sm text-emerald-400" role="status">{{ $status }}</p>
    @elseif ($errors->any())
        <p class="w-full text-right text-sm text-red-400" role="alert">Corrija os campos destacados antes de salvar.</p>
    @endif
</div>
