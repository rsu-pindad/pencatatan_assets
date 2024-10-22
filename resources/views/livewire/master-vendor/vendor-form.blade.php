<?php

use App\Livewire\Forms\Vendor\VendorForm;
use function Livewire\Volt\{form, action, on};

form(VendorForm::class);

$insert = action(function () {
    $store = $this->form->store();
    if ($store) {
        return $this->dispatch('infoNotifikasi', title: 'Vendor', description: 'vendor berhasil disimpan!.', icon: 'success');
    }
    return $this->dispatch('infoNotifikasi', title: 'Vendor', description: $store, icon: 'error');
});

?>
<!-- Card -->
<div>
  <x-wireui-modal name="createModal"
                  blur="base"
                  width="lg">
    <x-wireui-card title="create modal vendor">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500 dark:text-neutral-500">
            Form Vendor
          </h2>
        </div>
      </div>
      <!-- End Header -->

      <div class="my-6">
        <form wire:submit="insert">
          <div class="mt-3">
            <x-wireui-input wire:model="form.prefix_vendor"
                            with-validation-colors=true
                            corner="min:2"
                            label="Prefix Vendor"
                            icon="qr-code"
                            placeholder="masukan prefix"
                            description="minimal 2 huruf"
                            type="text" />
          </div>
          <div class="mt-3">
            <x-wireui-input wire:model="form.nama"
                            with-validation-colors=true
                            corner="min:2"
                            label="Nama Vendor"
                            icon="qr-code"
                            placeholder="masukan nama"
                            description="minimal 2 huruf"
                            type="text" />
          </div>
          <div class="mt-3">
            <x-wireui-textarea wire:model="form.keterangan"
                               label="Keterangan Vendor"
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
