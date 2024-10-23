<?php

use App\Livewire\Forms\Merek\MerekForm;
use function Livewire\Volt\{form, action, on};

form(MerekForm::class);

$insert = action(function () {
    $store = $this->form->store();
    if ($store) {
        return $this->dispatch('infoNotifikasi', title: 'Merek', description: 'merek berhasil disimpan!.', icon: 'success');
    }
    return $this->dispatch('infoNotifikasi', title: 'Merek', description: $store, icon: 'error');
});

?>
<!-- Card -->
<div>
  <x-wireui-modal name="createModal"
                  blur="base"
                  width="lg">
    <x-wireui-card title="create modal merek">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500 dark:text-neutral-500">
            Form Merek
          </h2>
        </div>
      </div>
      <!-- End Header -->

      <div class="my-6">
        <form wire:submit="insert">
          <div class="mt-3">
            <x-wireui-input wire:model="form.nama_merek"
                            with-validation-colors=true
                            corner="min:2"
                            label="Nama Merek"
                            icon="qr-code"
                            placeholder="masukan nama"
                            description="minimal 2 huruf"
                            type="text" />
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
