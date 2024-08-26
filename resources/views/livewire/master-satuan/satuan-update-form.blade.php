<?php

use App\Models\Satuan;
use App\Livewire\Forms\Satuan\SatuanUpdateForm;
use function WireUi\Traits\WireUiActions;
use function Livewire\Volt\{form, action, on};

form(SatuanUpdateForm::class);

on([
    'edit' => function ($rowId) {
        $this->form->mount($rowId);
    },
]);
on([
    'executePulihkan' => function ($rowId) {
        try {
            $this->form->restore($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Satuan', description: 'satuan berhasil dipulihkan!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Satuan', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executeHapus' => function ($rowId) {
        try {
            $this->form->destroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Satuan', description: 'satuan berhasil dihapus!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Satuan', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executePermanentHapus' => function ($rowId) {
        try {
            $this->form->permanentDestroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Satuan', description: 'satuan berhasil dihapus dari database!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Satuan', description: $th->getMessage(), icon: 'error');
        }
    },
]);
$update = action(function () {
    try {
        $this->form->update();
        return $this->dispatch('infoNotifikasi', title: 'satuan', description: 'satuan berhasil diperbarui!.', icon: 'success');
    } catch (\Throwable $th) {
        return $this->dispatch('infoNotifikasi', title: 'satuan', description: $th->getMessage(), icon: 'error');
    }
});

?>

<div>
  <x-wireui-modal name="editModal"
                  blur="base">
    <x-wireui-card title="edit modal satuan">
      <form wire:submit="update">
        <div class="mt-3">
          <x-wireui-input wire:model="form.nama_satuan"
                          with-validation-colors=true
                          corner="min:2"
                          label="Nama Satuan"
                          icon="qr-code"
                          placeholder="masukan satuan"
                          description="minimal 2 huruf"
                          type="text" />

          <x-wireui-input wire:model="form.konversi_satuan"
                          with-validation-colors=true
                          corner="opsional"
                          label="Konversi Satuan"
                          icon="qr-code"
                          placeholder="masukan satuan"
                          type="text" />
        </div>
        <div class="mt-3">
          <x-wireui-textarea wire:model="form.keterangan_satuan"
                             label="Keterangan Satuan"
                             corner="opsional"
                             placeholder="masukan keterangan" />
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
