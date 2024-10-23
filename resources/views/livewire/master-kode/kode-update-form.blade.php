<?php

use App\Models\Kode;
use App\Livewire\Forms\Kode\KodeUpdateForm;
use function WireUi\Traits\WireUiActions;
use function Livewire\Volt\{form, action, on};

form(KodeUpdateForm::class);

on([
    'edit' => function ($rowId) {
        $this->form->mount($rowId);
    },
]);
on([
    'executePulihkan' => function ($rowId) {
        try {
            $this->form->restore($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Kode', description: 'kode berhasil dipulihkan!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Kode', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executeHapus' => function ($rowId) {
        try {
            $this->form->destroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Kode', description: 'kode berhasil dihapus!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Kode', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executePermanentHapus' => function ($rowId) {
        try {
            $this->form->permanentDestroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Kode', description: 'kode berhasil dihapus dari database!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Kode', description: $th->getMessage(), icon: 'error');
        }
    },
]);

$update = action(function () {
    $update = $this->form->update();
    if ($update) {
        $this->dispatch('closeEditModal');
        return $this->dispatch('infoNotifikasi', title: 'Kode', description: 'kode berhasil diperbarui!.', icon: 'success');
    }
    return $this->dispatch('infoNotifikasi', title: 'Kode', description: $update, icon: 'error');
});

?>

<div>
  <x-wireui-modal name="editModal"
                  blur="base">
    <x-wireui-card title="edit modal kode">
      <form wire:submit="update">
        <div class="mt-3">
          <x-wireui-input wire:model="form.prefix_kode"
                          with-validation-colors=true
                          corner="min:2"
                          label="Prefix Kode"
                          icon="qr-code"
                          placeholder="masukan prefix"
                          description="minimal 2 huruf"
                          type="text" />
        </div>
        <div class="mt-3">
          <x-wireui-textarea wire:model="form.keterangan_kode"
                             label="Keterangan Kode"
                             corner="opsional"
                             placeholder="masukan keterangan" />
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
