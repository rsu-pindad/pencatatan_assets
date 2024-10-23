<?php

namespace App\PowerTable;

use App\Models\Kode;
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

final class KodeTable extends PowerGridComponent
{
    use WithExport;

    #[Locked]
    public string $tableName = 'kode_power_table';

    public bool $showFilters        = true;
    public bool $deferLoading       = true;
    public string $strRandom        = '';
    public string $loadingComponent = 'components.power.spinner-loading';

    public function boot(): void
    {
        config(['livewire-powergrid.filter' => 'outside']);
    }

    public function hydrate(): void
    {
        sleep(1);
    }

    // protected function queryString(): array
    // {
    //     return [
    //         'search' => ['except' => ''],
    //         // 'page' => ['except' => 1],
    //         ...$this->powerGridQueryString(),
    //     ];
    // }

    public function header(): array
    {
        return [
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
            prefix: 'kode_table_' . Auth::id(),
        );
        $this->strRandom = Str::random(4);

        return [
            Exportable::make('export_kode_' . Carbon::now()->format('Y-M-d_') . $this->strRandom)
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
                ->csvSeparator(',')
                ->csvDelimiter('"'),
            // ->queues(3)
            // ->onQueue('pg-exportKode'),
            // ->onConnection('redis'),
            Header::make()
                ->withoutLoading()
                ->showToggleColumns()
                ->showSoftDeletes(showMessage: false)
                ->includeViewOnTop('components.power.kode.header-top'),
            Footer::make()
                ->showPerPage(perPage: 50, perPageValues: [50, 100, 500])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Kode::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
                   ->add('id')
                   ->add('prefix_kode')
                   ->add('keterangan_kode');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hidden(isHidden: true, isForceHidden: true)
                ->visibleInExport(true),
            Column::make('No', 'id')
                ->index(),
            Column::make('Prefix', 'prefix_kode')
                ->fixedOnResponsive()
                ->sortable()
                ->searchable()
                ->visibleInExport(true),
            Column::make('Keterangan', 'keterangan_kode')
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
            Filter::inputText('prefix_kode')
                ->operators(['contains', 'is', 'is_not'])
                ->placeholder('cari prefix'),
            Filter::inputText('keterangan_kode')
                ->operators(['contains', 'is', 'is_not'])
                ->placeholder(' cari keterangan'),
        ];
    }

    public function actions(Kode $row): array
    {
        return [
            Button::add('edit')
                ->slot('<x-heroicons::solid.pencil class="w-4 h-4" />')
                ->id()
                ->tooltip('edit')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),
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
                $kode = Kode::whereIn('id', Arr::flatten($this->checkboxValues));
                $kode->delete();
                // Kode::destroy($this->checkboxValues);
                $this->js('window.pgBulkActions.clearAll()');
            }
            $this->dispatch('infoNotifikasi', title: 'Kode', description: 'kode berhasil dihapus!.', icon: 'info');
        } catch (\Throwable $th) {
            $this->dispatch('infoNotifikasi', title: 'Kode', description: $th->getMessage(), icon: 'error');
        }
    }

    // #[On('bulkDeleteForce.{tableName}')]
    // public function bulkDeleteForce(): void
    // {
    //     try {
    //         if ($this->checkboxValues) {
    //             $kode = Kode::whereIn('id', Arr::flatten($this->checkboxValues));
    //             $kode->forceDelete();
    //             // Kode::destroy($this->checkboxValues);
    //             $this->js('window.pgBulkActions.clearAll()');
    //         }
    //         $this->dispatch('infoNotifikasi', title: 'Kode', description: 'kode berhasil dihapus!.', icon: 'info');
    //     } catch (\Throwable $th) {
    //         $this->dispatch('infoNotifikasi', title: 'Kode', description: $th->getMessage(), icon: 'error');
    //     }
    // }

    public function actionRules($row): array
    {
        return [
            Rule::button('edit')
                ->when(fn(Kode $kode) => $kode->trashed() == true)
                ->hide(),
            Rule::button('hapus')
                ->when(fn(Kode $kode) => $kode->trashed() == true)
                ->hide(),
            Rule::button('bulk-delete')
                ->when(fn(Kode $kode) => $kode->trashed() == false)
                ->hide(),
            Rule::button('pulihkan')
                ->when(fn(Kode $kode) => $kode->trashed() == false)
                ->hide(),
            Rule::button('permanen-delete')
                ->when(fn(Kode $kode) => $kode->trashed() == false)
                ->hide(),
            Rule::checkbox()
                ->when(fn(Kode $kode) => $kode->trashed() == true)
                ->hide(),
        ];
    }
}
