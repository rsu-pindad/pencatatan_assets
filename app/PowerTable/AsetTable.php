<?php

namespace App\PowerTable;

use App\Models\Aset;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
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

final class AsetTable extends PowerGridComponent
{
    use WithExport;

    #[Locked]
    public string $tableName = 'aset';

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

        $this->persist(
            tableItems: ['columns', 'filters', 'sorting'],
            prefix: 'satuan_table_' . Auth::id(),
        );
        $this->strRandom = Str::random(4);

        return [
            Exportable::make('export_aset_' . Carbon::now()->format('Y-M-d_') . $this->strRandom)
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
        return Aset::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        // text-end
        return PowerGrid::fields()
                   ->add('id')
                   ->add('kode_id')
                   ->add('prefix_aset')
                   ->add('nama_aset')
                   //    ->add('tanggal_perolehan')
                   ->add('tanggal_perolehan_formatted', fn(Aset $model) => Carbon::parse($model->tanggal_perolehan)->translatedFormat('d F Y'))
                   //    ->add('nilai_perolehan')
                   ->add('nilai_perolehan_formatted', fn(Aset $model) => Number::currency($model->nilai_perolehan, 'RUPIAH', 'id'))
                   ->add('satuan_id_formatted', function ($aset) {
                       return $aset->parentSatuan->nama_satuan;
                   })
                   ->add('jumlah')
                   ->add('vendor_id_formatted', function ($aset) {
                       return $aset->parentVendor->nama_vendor;
                   })
                   //    ->add('pivot_tipe_merek_id')
                   ->add('pivot_tipe_merek_id_format_tipe', function ($aset) {
                       return $aset->parentPivotTipeMerek->parentTipe->nama_tipe;
                   })
                   ->add('pivot_tipe_merek_id_format_merek', function ($aset) {
                       return $aset->parentPivotTipeMerek->parentMerek->nama_merek;
                   })
                   ->add('unit_id_formatted', function ($aset) {
                       return $aset->parentUnit->nama_unit;
                   })
                   ->add('image_aset');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hidden(isHidden: true, isForceHidden: true)
                ->visibleInExport(true),
            Column::make('Kode', 'kode_id'),
            Column::make('Prefix aset', 'prefix_aset')
                ->hidden(isHidden: true, isForceHidden: true)
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),
            Column::make('Nama aset', 'nama_aset')
                ->sortable()
                ->searchable(),
            Column::make('Tanggal perolehan', 'tanggal_perolehan_formatted', 'tanggal_perolehan')
                ->sortable(),
            Column::make('Nilai perolehan', 'nilai_perolehan_formatted', 'nilai_perolehan')
                ->sortable()
                ->searchable(),
            Column::make('Satuan', 'satuan_id_formatted', 'satuan_id'),
            Column::make('Jumlah', 'jumlah')
                ->sortable()
                ->searchable(),
            Column::make('Vendor', 'vendor_id_formatted', 'vendor_id'),
            Column::make('Tipe', 'pivot_tipe_merek_id_format_tipe', 'pivot_tipe_merek_id'),
            Column::make('Merek', 'pivot_tipe_merek_id_format_merek', 'pivot_tipe_merek_id'),
            Column::make('Unit', 'unit_id_formatted', 'unit_id'),
            Column::make('Foto', 'image_aset')
                ->sortable()
                ->searchable(),
            Column::action('Aksi')
                ->visibleInExport(false),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('tanggal_perolehan'),
        ];
    }

    public function actions(Aset $row): array
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
                $satuan = Aset::whereIn('id', Arr::flatten($this->checkboxValues));
                $satuan->delete();
                $this->js('window.pgBulkActions.clearAll()');
            }
            $this->dispatch('infoNotifikasi', title: 'Aset', description: 'aset berhasil dihapus!.', icon: 'info');
        } catch (\Throwable $th) {
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $th->getMessage(), icon: 'error');
        }
    }

    public function actionRules($row): array
    {
        return [
            Rule::button('hapus')
                ->when(fn(Aset $aset) => $aset->trashed() == true)
                ->hide(),
            Rule::button('bulk-delete')
                ->when(fn(Aset $aset) => $aset->trashed() == false)
                ->hide(),
            Rule::button('pulihkan')
                ->when(fn(Aset $aset) => $aset->trashed() == false)
                ->hide(),
            Rule::button('permanen-delete')
                ->when(fn(Aset $aset) => $aset->trashed() == false)
                ->hide(),
            Rule::checkbox()
                ->when(fn(Aset $aset) => $aset->trashed() == true)
                ->hide(),
        ];
    }
}
