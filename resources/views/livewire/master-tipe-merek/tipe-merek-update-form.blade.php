<?php

use App\Livewire\Forms\TipeMerek\TipeMerekUpdateForm;
use function WireUi\Traits\WireUiActions;
use function Livewire\Volt\{form, action, on};

form(TipeMerekUpdateForm::class);

on([
    'edit' => function ($rowId) {
        $this->form->mount($rowId);
    },
]);

on([
    'executePulihkan' => function ($rowId) {
        try {
            $this->form->restore($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: 'Tipe-Merek berhasil dipulihkan!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: $th->getMessage(), icon: 'error');
        }
    },
]);

on([
    'executeHapus' => function ($rowId) {
        try {
            $this->form->destroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: 'tipe-merek berhasil dihapus!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: $th->getMessage(), icon: 'error');
        }
    },
]);

on([
    'executePermanentHapus' => function ($rowId) {
        try {
            $this->form->permanentDestroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: 'tipe-merek berhasil dihapus dari database!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: $th->getMessage(), icon: 'error');
        }
    },
]);

$update = action(function () {
    $update = $this->form->update();
    if ($update) {
        $this->dispatch('closeEditModal');
        return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: 'tipe-merek berhasil diperbarui!.', icon: 'success');
    }
    return $this->dispatch('infoNotifikasi', title: 'Tipe-Merek', description: $update, icon: 'error');
});

?>

<div>
  <x-wireui-modal name="editModal"
                  blur="base">
    <x-wireui-card title="edit modal tipe-merek">
      <form wire:submit="update">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <x-wireui-select label="Tipe"
                             placeholder="Pilih Tipe"
                             :async-data="route('data-tipe')"
                             option-label="nama_tipe"
                             option-value="id"
                             wire:model="form.tipeId" />
          </div>
          <div>
            <x-wireui-select label="Merek"
                             placeholder="Pilih Merek"
                             :async-data="route('data-merek')"
                             option-label="nama_merek"
                             option-value="id"
                             wire:model="form.merekId" />
          </div>
        </div>
        <div class="mt-4">
          <x-wireui-button type="submit"
                           right-icon="pencil-square"
                           label="Perbarui"
                           primary />
        </div>
      </form>
    </x-wireui-card>
  </x-wireui-modal>
</div>
