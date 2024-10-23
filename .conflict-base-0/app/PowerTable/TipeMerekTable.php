<?php

namespace App\PowerTable;

use App\Models\Tipe;
use App\Models\TipeMerek;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class TipeMerekTable extends PowerGridComponent
{
    use WithExport;

    #[Locked]
    public string $tableName = 'pivot_tipe_merek';

    public bool $deferLoading = true;
    public string $strRandom  = '';

    public function hydrate(): void
    {
        sleep(1);
    }

    protected function queryString(): array
    {
        return [
            'search' => ['except' => ''],
            // 'page' => ['except' => 1],
            ...$this->powerGridQueryString(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('segarkan')
                ->slot('<x-wireui-mini-button sm rounded secondary icon="arrow-path" wire:click="$refresh" spinner />'),
            Button::add('bulk-delete')
                ->slot('<x-heroicons::outline.trash class="w-5 h-5" />(<span x-text="window.pgBulkActions.count(\'' . $this->tableName . '\')"></span>)')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->confirm('Anda yakin hapus data?')
                ->dispatch('bulkDelete.' . $this->tableName, []),
            // Button::add('bulk-delete-force')
            //     ->slot('<x-heroicons::outline.x-circle class="w-5 h-5" />(<span x-text="window.pgBulkActions.count(\'' . $this->tableName . '\')"></span>)')
            //     ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
            //     ->confirmPrompt('Anda yakin hapus data?, data akan terhapus dari database! masukan HAPUSDATA', 'HAPUSDATA')
            //     ->dispatch('bulkDeleteForce.' . $this->tableName, []),
        ];
    }

    public function setUp(): array
    {
        $this->showCheckBox();
        // $this->persist(
        //     tableItems: ['columns', 'filters', 'sorting'],
        //     prefix: 'pivot_tipe_merek_table_' . Auth::id(),
        // );
        $this->strRandom = Str::random(4);

        return [
            Exportable::make('export_pivot_tipe_merek_' . Carbon::now()->format('Y-M-d_') . $this->strRandom)
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
                ->csvSeparator(',')
                ->csvDelimiter('"'),
            // ->queues(3)
            // ->onQueue('pg-exportKode'),
            // ->onConnection('redis'),
            Header::make()
                ->showToggleColumns()
                ->showSoftDeletes(showMessage: false),
            // ->withoutLoading(),
            Footer::make()
                ->showPerPage(perPage: 5, perPageValues: [5, 25, 50, 100, 500])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return TipeMerek::query()->with(['parentTipe', 'parentMerek'])->orderBy('tipe_id');
    }

    public function relationSearch(): array
    {
        return [
            'parentTipe' => [
                'tipe_id',
            ],
            'parentMerek' => [
                'merek_id'
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
                   ->add('id')
                   ->add('tipe_id', fn(TipeMerek $tipeMerek)    => e($tipeMerek->parentTipe->id))
                   ->add('tipe_nama', fn(TipeMerek $tipeMerek)  => e($tipeMerek->parentTipe->nama_tipe))
                   ->add('merek_id', fn(TipeMerek $tipeMerek)   => e($tipeMerek->parentMerek->id))
                   ->add('merek_nama', fn(TipeMerek $tipeMerek) => e($tipeMerek->parentMerek->nama_merek));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hidden(isHidden: true, isForceHidden: true)
                ->visibleInExport(true),
            Column::make('Tipe', 'tipe_nama', 'tipe_id')
                ->sortable()
                ->searchable()
                ->visibleInExport(true),
            Column::make('Merek', 'merek_nama', 'merek_id')
                ->sortable()
                ->searchable()
                ->visibleInExport(true),
            Column::action('Aksi')
                ->visibleInExport(false),
        ];
    }

    public function filters(): array
    {
        return [
            // Filter::inputText('tipe_id')->placeholder('cari tipe'),
            // Filter::inputText('merek_id')->placeholder(' cari mere'),
            Filter::select('tipe_nama', 'tipe_id')
                ->dataSource(Tipe::all())
                ->optionLabel('nama_tipe')
                ->optionValue('id'),
        ];
    }

    public function actions(TipeMerek $row): array
    {
        return [

            Button::add('hapus')
                ->slot('<x-heroicons::solid.trash class="w-4 h-4" />')
                ->id()
                ->tooltip('hapus')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('hapus', ['rowId' => $row->id]),
            Button::add('pulihkan')
                ->slot('<x-heroicons::solid.arrow-uturn-left class="w-4 h-4" />')
                ->id()
                ->tooltip('pulihkan')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('pulihkan', ['rowId' => $row->id]),
            Button::add('permanen-delete')
                ->slot('<x-heroicons::solid.x-circle class="w-4 h-4" />')
                ->tooltip('permanent hapus')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('permanenDelete', ['rowId' => $row->id]),
        ];
    }

    #[On('bulkDelete.{tableName}')]
    public function bulkDelete(): void
    {
        try {
            if ($this->checkboxValues) {
                $tipeMerek = TipeMerek::whereIn('id', Arr::flatten($this->checkboxValues));
                $tipeMerek->delete();
                $this->js('window.pgBulkActions.clearAll()');
            }
            $this->dispatch('infoNotifikasi', title: 'Satuan', description: 'satuan berhasil dihapus!.', icon: 'info');
        } catch (\Throwable $th) {
            $this->dispatch('infoNotifikasi', title: 'Satuan', description: $th->getMessage(), icon: 'error');
        }
    }

    public function actionRules($row): array
    {
        return [
            Rule::button('hapus')
                ->when(fn(TipeMerek $tipeMerek) => $tipeMerek->trashed() == true)
                ->hide(),
            Rule::button('bulk-delete')
                ->when(fn(TipeMerek $tipeMerek) => $tipeMerek->trashed() == false)
                ->hide(),
            Rule::button('pulihkan')
                ->when(fn(TipeMerek $tipeMerek) => $tipeMerek->trashed() == false)
                ->hide(),
            Rule::button('permanen-delete')
                ->when(fn(TipeMerek $tipeMerek) => $tipeMerek->trashed() == false)
                ->hide(),
            Rule::checkbox()
                ->when(fn(TipeMerek $tipeMerek) => $tipeMerek->trashed() == true)
                ->hide(),
        ];
    }
}
