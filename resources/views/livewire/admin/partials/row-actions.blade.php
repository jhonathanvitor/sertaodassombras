{{-- Expects $index and $total --}}
<div class="flex items-center gap-1.5">
    <button type="button" wire:click="moveRow({{ $index }}, -1)" class="admin-icon-btn" title="Mover para cima" aria-label="Mover para cima" @disabled($index === 0)>↑</button>
    <button type="button" wire:click="moveRow({{ $index }}, 1)" class="admin-icon-btn" title="Mover para baixo" aria-label="Mover para baixo" @disabled($index === $total - 1)>↓</button>
    <button type="button" wire:click="removeRow({{ $index }})" wire:confirm="Remover este item? Ele só será apagado ao salvar." class="admin-icon-btn hover:!border-red-400/60 hover:!text-red-400" title="Remover" aria-label="Remover">✕</button>
</div>
