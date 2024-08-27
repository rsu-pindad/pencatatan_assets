<?php

use App\Livewire\Forms\Aset\AsetForm;
use App\Models\Tipe;
use App\Models\TipeMerek;
use function Livewire\Volt\{action, form, on, usesFileUploads};

usesFileUploads();
form(AsetForm::class);

$insert = action(function () {
    try {
        $store = $this->form->store();
        $this->form->reset();
        return $this->dispatch('infoNotifikasiInsert', title: 'Aset', description: 'aset berhasil disimpan!.', icon: 'success');
    } catch (\Throwable $th) {
        return $this->dispatch('infoNotifikasiInsert', title: 'Aset', description: $th->getMessage(), icon: 'error');
    }
});
?>

<!-- Card -->
<div>
  <x-wireui-modal name="createModal"
                  blur="base"
                  width="lg">
    <x-wireui-card title="create modal aset">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500 dark:text-neutral-500">
            Form Aset
          </h2>
        </div>
      </div>
      <!-- End Header -->

      <div class="my-6">
        <form wire:submit="insert">
          <div class="grid grid-cols-2 grid-rows-3 gap-6">
            <div class="inline-flex">
              <x-wireui-select wire:model="form.kode"
                               label="Pilih kode"
                               placeholder="Select kode"
                               :async-data="[
                                   'api' => route('data-kode'),
                                   'method' => 'GET',
                               ]"
                               option-label="prefix_kode"
                               option-value="id" />
            </div>
            <div class="inline-flex">
              <x-wireui-input wire:model="form.nama"
                              with-validation-colors=true
                              corner="min:4"
                              label="Nama Aset"
                              icon="qr-code"
                              placeholder="masukan nama aset"
                              type="text" />
            </div>
            <div class="inline-flex"
                 wire:ignore>
              <x-wireui-datetime-picker wire:model.live="form.tglPerolehan"
                                        label="Tanggal Perolehan Aset"
                                        placeholder="Tanggal Perolehan"
                                        without-time
                                        without-timezone
                                        without-time-seconds />
            </div>
            <div class="inline-flex">
              <x-wireui-currency wire:model="form.nilai"
                              with-validation-colors=true
                              corner="min:Rp.0"
                              label="Nilai Perolehan Aset"
                              placeholder="masukan nilai"
                              prefix="Rp."
                              decimal=","
                              thousands="."
                              emit-formatted="true"
                              max="10000000000"
                              min="0"
                              />
            </div>
            <div class="inline-flex">
              <x-wireui-number wire:model="form.jumlah"
                               label="Berapa Jumlah Aset"
                               placeholder="0" />
            </div>
            <div class="inline-flex">
              <x-wireui-select wire:model="form.satuan"
                               label="Pilih satuan"
                               placeholder="Select satuan"
                               :async-data="[
                                   'api' => route('data-satuan'),
                                   'method' => 'GET',
                               ]"
                               option-label="nama_satuan"
                               option-value="id" />
            </div>
            <div class="inline-flex">
              <x-wireui-select wire:model="form.vendor"
                               label="Pilih vendor"
                               placeholder="Select vendor"
                               :async-data="[
                                   'api' => route('data-vendor'),
                                   'method' => 'GET',
                               ]"
                               option-label="nama_vendor"
                               option-value="id" />
            </div>
            <div>
              <label for="hs-select-label"
                     class="mb-2 block text-sm font-medium dark:text-white">Pilih Tipe/Merek</label>
              <select id="hs-select-label"
                      wire:model="form.tipeMerek"
                      class="block w-full rounded-lg border-gray-200 px-4 py-3 pe-9 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                @forelse (TipeMerek::with(['parentTipe', 'parentMerek'])->get() as $tipeMerek)
                  <option value="{{ $tipeMerek->id }}">
                    {{ $tipeMerek->parentTipe->nama_tipe }}/
                    {{ $tipeMerek->parentMerek->nama_merek }}
                  </option>
                @empty
                  <option disabled>Belum Ada Data</option>
                @endforelse
              </select>
            </div>
            <div class="inline-flex">
              <x-wireui-select wire:model="form.unit"
                               label="Pilih unit"
                               placeholder="Select unit"
                               :async-data="[
                                   'api' => route('data-unit'),
                                   'method' => 'GET',
                               ]"
                               option-label="nama_unit"
                               option-value="id" />
            </div>
            <div class="inline-flex">
              {{-- <label class="block">
                <span class="sr-only">pilih photo</span>
                <input wire:model="form.foto"
                       type="file"
                       class="block w-full text-sm text-gray-500 file:me-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 file:disabled:pointer-events-none file:disabled:opacity-50 dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400">
              </label> --}}
              <div x-data="{ uploading: false, progress: 0 }"
                   x-on:livewire-upload-start="uploading = true"
                   x-on:livewire-upload-finish="uploading = false"
                   x-on:livewire-upload-cancel="uploading = false"
                   x-on:livewire-upload-error="uploading = false"
                   x-on:livewire-upload-progress="progress = $event.detail.progress">
                <!-- File Input -->
                <input type="file"
                       wire:model="form.photo"
                       class="block w-full text-sm text-gray-500 file:me-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 file:disabled:pointer-events-none file:disabled:opacity-50 dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400">

                <!-- Progress Bar -->
                <div x-show="uploading">
                  <progress max="100"
                            x-bind:value="progress"></progress>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-6">
            <x-wireui-button type="submit"
                             right-icon="plus"
                             label="Simpan"
                             primary />
          </div>
        </form>
      </div>
    </x-wireui-card>
  </x-wireui-modal>
</div>
<!-- End Card -->
