<?php

use App\Livewire\Forms\TipeMerek\TipeMerekForm;
use function Livewire\Volt\{form, action, on};

form(TipeMerekForm::class);

$insert = action(function () {
    $store = $this->form->storeMerek();
    if ($store) {
        return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: 'tipe-merek berhasil disimpan!.', icon: 'success');
    }
    return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: $store, icon: 'error');
});

?>

<!-- Card -->
<div wire:ignore.self>
  <x-wireui-modal name="createModal"
                  blur="base"
                  width="lg">
    <x-wireui-card title="create modal tipe-merek">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500 dark:text-neutral-500">
            Form Tipe-Merek
          </h2>
        </div>
      </div>
      <!-- End Header -->

      <div class="my-6">
        <form wire:submit="insert">
          <div class="mt-3">
            <x-wireui-select wire:model="form.tipe"
                             label="Cari tipe"
                             placeholder="Select tipe"
                             :async-data="[
                                 'api' => route('data-tipe'),
                                 'method' => 'GET',
                             ]"
                             option-label="nama_tipe"
                             option-value="id" />
          </div>
          <div class="mt-3">
            <x-wireui-select wire:model="form.merek"
                             label="Cari Merek"
                             placeholder="Select merek"
                             multiselect
                             :async-data="[
                                 'api' => route('data-merek'),
                                 'method' => 'GET',
                             ]"
                             option-label="nama_merek"
                             option-value="id" />
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
