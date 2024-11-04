<?php

use App\Models\TipeMerek;
use App\Livewire\Forms\Aset\AsetUpdateForm;
use function WireUi\Traits\WireUiActions;
use function Livewire\Volt\{form, action, on, usesFileUploads};

form(AsetUpdateForm::class);
usesFileUploads();

on([
    'edit' => function ($rowId) {
        $this->form->mount($rowId);
    },
]);
on([
    'executePulihkan' => function ($rowId) {
        try {
            $this->form->restore($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'aset berhasil dipulihkan!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executeHapus' => function ($rowId) {
        try {
            $this->form->destroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'aset berhasil dihapus!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executePermanentHapus' => function ($rowId) {
        try {
            $this->form->permanentDestroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'aset berhasil dihapus dari database!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: $th->getMessage(), icon: 'error');
        }
    },
]);
$update = action(function () {
    $update = $this->form->update();
    if ($update) {
        $this->dispatch('closeEditModal');
        return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'aset berhasil diperbarui!.', icon: 'success');
    }
    return $this->dispatch('infoNotifikasi', title: 'Aset', description: $update, icon: 'error');
});

?>

<div>

  <x-wireui-modal name="editModal"
                  blur="base">
    <x-wireui-card title="edit modal aset">
      <form wire:submit="update">
        <div class="grid grid-cols-2 gap-6">
          <div class="inline-block">
            <x-wireui-select wire:model.live="form.kode_id"
                             label="Pilih kode"
                             placeholder="Select kode"
                             :async-data="[
                                 'api' => route('data-kode'),
                                 'method' => 'GET',
                             ]"
                             option-label="keterangan_kode"
                             option-value="id" />
          </div>
          <div class="inline-block">
            <x-wireui-input wire:model.blur="form.no_bukti"
                            with-validation-colors=true
                            label="No Bukti"
                            icon="document-text"
                            placeholder="masukan no bukti"
                            type="text" />
          </div>
          <div class="inline-block">
            <x-wireui-input wire:model.blur="form.nama_aset"
                            with-validation-colors=true
                            corner="min:4"
                            label="Nama Aset"
                            icon="qr-code"
                            placeholder="masukan nama aset"
                            type="text" />
          </div>
          <div class="inline-block">
            <x-wireui-datetime-picker wire:model.live="form.tanggal_perolehan"
                                      label="Tanggal Perolehan Aset"
                                      placeholder="Tanggal Perolehan"
                                      without-time
                                      without-timezone
                                      without-time-seconds />
          </div>
          <div class="inline-block">
            <x-wireui-currency wire:model.blur="form.nilai_perolehan"
                               with-validation-colors=true
                               corner=">=1.500.000"
                               label="Nilai Perolehan Aset"
                               placeholder="masukan nilai"
                               prefix="Rp."
                               decimal=","
                               thousands="."
                               min="1499999" />
          </div>
          <div class="inline-block">
            <x-wireui-number wire:model.live="form.jumlah"
                             label="Berapa Jumlah Aset"
                             placeholder="0" />
          </div>
          <div class="inline-block">
            <x-wireui-select wire:model.live="form.satuan_id"
                             label="Pilih satuan"
                             placeholder="Select satuan"
                             :async-data="[
                                 'api' => route('data-satuan'),
                                 'method' => 'GET',
                             ]"
                             option-label="keterangan_satuan"
                             option-value="id" />
          </div>
          <div class="inline-block">
            <x-wireui-select wire:model.live="form.vendor_id"
                             label="Pilih vendor"
                             placeholder="Select vendor"
                             :async-data="[
                                 'api' => route('data-vendor'),
                                 'method' => 'GET',
                             ]"
                             option-label="nama_vendor"
                             option-value="id" />
          </div>
          <div class="inline-block">
            <x-wireui-select wire:model.live="form.unit_id"
                             label="Pilih unit"
                             placeholder="Select unit"
                             :async-data="[
                                 'api' => route('data-unit'),
                                 'method' => 'GET',
                             ]"
                             option-label="nama_unit"
                             option-value="id" />
          </div>
        </div>
        <div class="mt-6 grid grid-cols-2 gap-6">
          <div class="inline-block">
            <label for="hs-select-label"
                   class="mb-2 block text-sm font-medium dark:text-white">Pilih Tipe/Merek (opsional)
            </label>
            <select id="hs-select-label"
                    wire:model.live="form.pivot_tipe_merek_id"
                    class="block w-full rounded-lg border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
              <option hidden>Pilih Tipe/Merek</option>
              @forelse (TipeMerek::with(['parentTipe', 'parentMerek'])->get() as $tipeMerek)
                <option value="{{ $tipeMerek->id }}">
                  {{ $tipeMerek->parentTipe->nama_tipe }}
                  -
                  {{ $tipeMerek->parentMerek->nama_merek }}
                </option>
              @empty
                <option disabled>Belum Ada Data</option>
              @endforelse
            </select>
          </div>
          <div class="inline-block">
            <label for="foto"
                   class="mb-2 block text-sm font-medium dark:text-white">Unggah Foto (opsional)
            </label>
            <div x-data="{ uploading: false, progress: 0 }"
                 x-on:livewire-upload-start="uploading = true"
                 x-on:livewire-upload-finish="uploading = false"
                 x-on:livewire-upload-cancel="uploading = false"
                 x-on:livewire-upload-error="uploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress">
              <!-- File Input -->
              <input id="foto"
                     type="file"
                     wire:model.live="form.image_aset"
                     class="block w-full text-sm text-gray-500 file:me-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 file:disabled:pointer-events-none file:disabled:opacity-50 dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400">

              <!-- Progress Bar -->
              <div x-show="uploading">
                <progress max="100"
                          x-bind:value="progress">
                </progress>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 flex gap-x-4">
          <x-wireui-button type="submit"
                           right-icon="pencil-square"
                           label="Perbarui"
                           primary />
          <x-wireui-button flat
                           label="tutup"
                           x-on:click="close" />
        </div>
      </form>
    </x-wireui-card>
  </x-wireui-modal>

</div>
