<?php

namespace App\Livewire\Admin\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Editable, ordered list of records backed by a model with a `sort_order` column.
 * Rows carry an `id` (null for new rows) and a `uid` used as a stable wire:key.
 */
trait ManagesOrderedRows
{
    /** @var array<int, array<string, mixed>> */
    public array $rows = [];

    public ?string $status = null;

    /**
     * @return class-string<Model>
     */
    abstract protected function modelClass(): string;

    /**
     * Default values for a new row, keyed by model attribute.
     *
     * @return array<string, string>
     */
    abstract protected function blankRow(): array;

    /**
     * @return array<string, mixed>
     */
    abstract protected function rowRules(): array;

    public function mount(): void
    {
        $this->loadRows();
    }

    public function addRow(): void
    {
        $this->rows[] = ['id' => null, 'uid' => Str::random(10)] + $this->blankRow();
        $this->status = null;
    }

    public function removeRow(int $index): void
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
        $this->status = null;
    }

    public function moveRow(int $index, int $direction): void
    {
        $target = $index + ($direction < 0 ? -1 : 1);

        if (! isset($this->rows[$index], $this->rows[$target])) {
            return;
        }

        [$this->rows[$index], $this->rows[$target]] = [$this->rows[$target], $this->rows[$index]];
        $this->status = null;
    }

    public function save(): void
    {
        $this->validate($this->rowRules(), [
            'required' => 'Campo obrigatório.',
            'url' => 'Informe uma URL válida, começando com http:// ou https://.',
            'max' => 'Texto muito longo.',
            'in' => 'Opção inválida.',
        ]);

        $modelClass = $this->modelClass();
        $fields = array_keys($this->blankRow());

        DB::transaction(function () use ($modelClass, $fields): void {
            $keptIds = [];

            foreach ($this->rows as $position => $row) {
                $attributes = [];
                foreach ($fields as $field) {
                    $value = trim((string) ($row[$field] ?? ''));
                    $attributes[$field] = $value === '' ? null : $value;
                }
                $attributes['sort_order'] = $position + 1;

                $record = filled($row['id'] ?? null)
                    ? $modelClass::findOrFail($row['id'])
                    : new $modelClass;

                $record->fill($attributes)->save();
                $keptIds[] = $record->getKey();
            }

            $modelClass::query()->whereNotIn('id', $keptIds)->delete();
        });

        $this->loadRows();
        $this->status = 'Alterações salvas.';
    }

    protected function loadRows(): void
    {
        $fields = array_keys($this->blankRow());

        $this->rows = $this->modelClass()::query()
            ->orderBy('sort_order')
            ->get()
            ->map(function (Model $record) use ($fields): array {
                $row = ['id' => $record->getKey(), 'uid' => Str::random(10)];
                foreach ($fields as $field) {
                    $row[$field] = (string) ($record->{$field} ?? '');
                }

                return $row;
            })
            ->all();
    }
}
