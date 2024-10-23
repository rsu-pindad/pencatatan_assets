<?php

use App\Livewire\Forms\Satuan\SatuanForm;
use function Livewire\Volt\{form, action, on};

form(SatuanForm::class);

$insert = action(function () {
    $store = $this->form->store();
    if ($store) {
        return $this->dispatch('infoNotifikasi', title: 'Satuan', description: 'satuan berhasil disimpan!.', icon: 'success');
    }
    return $this->dispatch('infoNotifikasi', title: 'Satuan', description: $store, icon: 'error');
});

?>
<!-- Card -->
<div>
  <x-wireui-modal name="createModal"
                  blur="base"
                  width="lg">
    <x-wireui-card title="create modal satuan">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500 dark:text-neutral-500">
            Form Satuan
          </h2>
        </div>
      </div>
      <!-- End Header -->

      <div class="my-6">
        <form wire:submit="insert">
          <div class="mt-3">
            <x-wireui-input wire:model="form.nama_satuan"
                            with-validation-colors=true
                            corner="min:2"
                            label="Nama Satuan"
                            icon="qr-code"
                            placeholder="masukan nama satuan"
                            description="minimal 2 huruf"
                            type="text" />
          </div>
          <div class="mt-3">
            <x-wireui-input wire:model="form.konversi"
                            with-validation-colors=true
                            corner="opsional"
                            label="Konversi Satuan"
                            icon="qr-code"
                            placeholder="masukan konversi satuan"
                            type="number" />
          </div>
          <div class="mt-3">
            <x-wireui-textarea wire:model="form.keterangan"
                               label="Keterangan Satuan"
                               corner="opsional"
                               placeholder="masukan keterangan" />
          </div>
          <div class="mt-3">
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
