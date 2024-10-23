<?php

use App\Livewire\Forms\Unit\UnitForm;
use function Livewire\Volt\{form, action, on};

form(UnitForm::class);

$insert = action(function () {
    try {
        $store = $this->form->store();
        $this->form->reset();
        return $this->dispatch('infoNotifikasi', title: 'Unit', description: 'unit berhasil disimpan!.', icon: 'success');
    } catch (\Throwable $th) {
        return $this->dispatch('infoNotifikasi', title: 'Unit', description: $th->getMessage(), icon: 'error');
    }
});

?>
<!-- Card -->
<div>
  <x-wireui-modal name="createModal"
                  blur="base"
                  width="lg">
    <x-wireui-card title="create modal unit">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500 dark:text-neutral-500">
            Form Unit
          </h2>
        </div>
      </div>
      <!-- End Header -->

      <div class="my-6">
        <form wire:submit="insert">
          <div class="mt-3">
            <x-wireui-input wire:model="form.nama"
                            with-validation-colors=true
                            corner="min:2"
                            label="Nama Unit"
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
