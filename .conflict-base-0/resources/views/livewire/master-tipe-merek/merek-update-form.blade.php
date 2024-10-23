<?php

use App\Models\Merek;
use App\Livewire\Forms\Merek\MerekUpdateForm;
use function WireUi\Traits\WireUiActions;
use function Livewire\Volt\{form, action, on, uses};

form(MerekUpdateForm::class);

on([
    'edit' => function ($rowId) {
        $this->form->mount($rowId);
    },
]);
on([
    'executePulihkan' => function ($rowId) {
        try {
            $this->form->restore($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Merek', description: 'merek berhasil dipulihkan!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Merek', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executeHapus' => function ($rowId) {
        try {
            $this->form->destroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Merek', description: 'merek berhasil dihapus!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Merek', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executePermanentHapus' => function ($rowId) {
        try {
            $this->form->permanentDestroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Merek', description: 'merek berhasil dihapus dari database!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Merek', description: $th->getMessage(), icon: 'error');
        }
    },
]);

$update = action(function () {
    try {
        $this->form->update();
        return $this->dispatch('infoNotifikasi', title: 'Merek', description: 'merek berhasil diperbarui!.', icon: 'success');
    } catch (\Throwable $th) {
        return $this->dispatch('infoNotifikasi', title: 'Merek', description: $th->getMessage(), icon: 'error');
    }
});

?>

<div>
  <x-wireui-modal name="editModal"
                  blur="base">
    <x-wireui-card title="edit modal merek">
      <form wire:submit="update">
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
                           right-icon="pencil-square"
                           label="Perbarui"
                           primary />
        </div>
      </form>
    </x-wireui-card>
  </x-wireui-modal>
</div>
