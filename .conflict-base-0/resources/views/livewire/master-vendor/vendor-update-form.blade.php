<?php

use App\Models\Vendor;
use App\Livewire\Forms\Vendor\VendorUpdateForm;
use function WireUi\Traits\WireUiActions;
use function Livewire\Volt\{form, action, on};

form(VendorUpdateForm::class);

on([
    'edit' => function ($rowId) {
        $this->form->mount($rowId);
    },
]);
on([
    'executePulihkan' => function ($rowId) {
        try {
            $this->form->restore($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Vendor', description: 'vendor berhasil dipulihkan!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Vendor', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executeHapus' => function ($rowId) {
        try {
            $this->form->destroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Vendor', description: 'vendor berhasil dihapus!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Vendor', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executePermanentHapus' => function ($rowId) {
        try {
            $this->form->permanentDestroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Vendor', description: 'vendor berhasil dihapus dari database!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Vendor', description: $th->getMessage(), icon: 'error');
        }
    },
]);

$update = action(function () {
    try {
        $this->form->update();
        return $this->dispatch('infoNotifikasi', title: 'Vendor', description: 'vendor berhasil diperbarui!.', icon: 'success');
    } catch (\Throwable $th) {
        return $this->dispatch('infoNotifikasi', title: 'Vendor', description: $th->getMessage(), icon: 'error');
    }
});

?>

<div>
  <x-wireui-modal name="editModal"
                  blur="base">
    <x-wireui-card title="edit modal vendor">
      <form wire:submit="update">
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
          <x-wireui-input wire:model="form.nama_vendor"
                          with-validation-colors=true
                          corner="min:2"
                          label="Nama Vendor"
                          icon="qr-code"
                          placeholder="masukan nama"
                          description="minimal 2 huruf"
                          type="text" />
        </div>
        <div class="mt-3">
          <x-wireui-textarea wire:model="form.keterangan_vendor"
                             label="Keterangan Vendor"
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