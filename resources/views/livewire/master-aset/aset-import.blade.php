<?php

use App\Imports\Kabag\SheetNameImport;
use Maatwebsite\Excel\Facades\Excel;
use function Livewire\Volt\{state, usesFileUploads, on};

usesFileUploads();

state(['dokumen', 'nama_sheet', 'baris_awal', 'baris_akhir']);

$import = function () {
    $this->validate([
        'dokumen' => 'required',
        'nama_sheet' => 'required',
        'baris_awal' => 'required',
        'baris_akhir' => 'required',
    ]);
    try {
        $import = new SheetNameImport($this->baris_awal, $this->baris_akhir);
        $import->onlySheets($this->nama_sheet);
        $importData = Excel::import($import, $this->dokumen->path());
        $this->reset();
        return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'Data Aset berhasil diimport', icon: 'success');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();
        foreach ($failures as $failure) {
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $failure->row(), icon: 'error');
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $failure->attribute(), icon: 'error');
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $failure->errors(), icon: 'error');
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $failure->values(), icon: 'error');
            //  $failure->row(); // row that went wrong
            //  $failure->attribute(); // either heading key (if using heading row concern) or column index
            //  $failure->errors(); // Actual error messages from Laravel validator
            //  $failure->values(); // The values of the row that has failed.
        }
    }
};

?>

<div>
  <x-wireui-modal name="importModal"
                  blur="base">
    <x-wireui-card title="Import aset">
      <form wire:submit="import"
            enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-4">
          <div class="col-span-2">
            <x-wireui-input wire:model="dokumen"
                            with-validation-colors=true
                            label="Pilih Dokumen"
                            placeholder="masukan baris akhir data"
                            type="file" />
          </div>
          <div class="col-span-2">
            <x-wireui-input wire:model="nama_sheet"
                            with-validation-colors=true
                            corner="min:2"
                            label="Nama Sheet"
                            icon="document"
                            placeholder="masukan nama sheet"
                            description="minimal 2 huruf"
                            type="text" />
          </div>
          <div>
            <x-wireui-number wire:model="baris_awal"
                             label="Baris Awal Data"
                             with-validation-colors=true
                             corner="min:1"
                             description="minimal angka 1"
                             placeholder="1" />
          </div>
          <div>
            <x-wireui-number wire:model="baris_akhir"
                             label="Baris Akhir Data"
                             with-validation-colors=true
                             placeholder="0" />
          </div>
        </div>
        <div class="mt-3">
          <x-wireui-button type="submit"
                           right-icon="arrow-down-tray"
                           label="Import"
                           primary />
        </div>
      </form>
    </x-wireui-card>
  </x-wireui-modal>
</div>

<?php

use App\Imports\Kabag\SheetNameImport;
use Maatwebsite\Excel\Facades\Excel;
use function Livewire\Volt\{state, usesFileUploads, on};

usesFileUploads();

state(['dokumen', 'nama_sheet', 'baris_awal', 'baris_akhir']);

$import = function () {
    $this->validate([
        'dokumen' => 'required',
        'nama_sheet' => 'required',
        'baris_awal' => 'required',
        'baris_akhir' => 'required',
    ]);
    try {
        $import = new SheetNameImport($this->baris_awal, $this->baris_akhir);
        $import->onlySheets($this->nama_sheet);
        $importData = Excel::import($import, $this->dokumen->path());
        $this->reset();
        return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'Data Aset berhasil diimport', icon: 'success');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();
        foreach ($failures as $failure) {
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $failure->row(), icon: 'error');
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $failure->attribute(), icon: 'error');
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $failure->errors(), icon: 'error');
            $this->dispatch('infoNotifikasi', title: 'Aset', description: $failure->values(), icon: 'error');
            //  $failure->row(); // row that went wrong
            //  $failure->attribute(); // either heading key (if using heading row concern) or column index
            //  $failure->errors(); // Actual error messages from Laravel validator
            //  $failure->values(); // The values of the row that has failed.
        }
    }
};

on([
    'downloadImport' => function () {
        try {
            $path = config('app.import_template_aset');
            return Storage::disk('public')->download($path);
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: $th->getMessage(), icon: 'error');
        }
    },
]);

?>

<div>
  <x-wireui-modal name="importModal"
                  blur="base">
    <x-wireui-card title="Import aset">
      <form wire:submit="import"
            enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-4">
          <div class="col-span-2">
            <x-wireui-input wire:model="dokumen"
                            with-validation-colors=true
                            label="Pilih Dokumen"
                            placeholder="masukan baris akhir data"
                            type="file" />
          </div>
          <div class="col-span-2">
            <x-wireui-input wire:model="nama_sheet"
                            with-validation-colors=true
                            corner="min:2"
                            label="Nama Sheet"
                            icon="document"
                            placeholder="masukan nama sheet"
                            description="minimal 2 huruf"
                            type="text" />
          </div>
          <div>
            <x-wireui-number wire:model="baris_awal"
                             label="Baris Awal Data"
                             with-validation-colors=true
                             corner="min:1"
                             description="minimal angka 1"
                             placeholder="1" />
          </div>
          <div>
            <x-wireui-number wire:model="baris_akhir"
                             label="Baris Akhir Data"
                             with-validation-colors=true
                             placeholder="0" />
          </div>
        </div>
        <div class="mt-3">
          <x-wireui-button type="submit"
                           right-icon="arrow-down-tray"
                           label="Import"
                           primary />
        </div>
      </form>
    </x-wireui-card>
  </x-wireui-modal>
</div>
