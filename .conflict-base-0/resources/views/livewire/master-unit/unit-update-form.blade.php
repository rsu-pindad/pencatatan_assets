<?php

use App\Models\Unit;
use App\Livewire\Forms\Unit\UnitUpdateForm;
use function WireUi\Traits\WireUiActions;
use function Livewire\Volt\{form, action, on, uses};

form(UnitUpdateForm::class);

on([
    'edit' => function ($rowId) {
        $this->form->mount($rowId);
    },
]);
on([
    'executePulihkan' => function ($rowId) {
        try {
            $this->form->restore($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Unit', description: 'unit berhasil dipulihkan!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Unit', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executeHapus' => function ($rowId) {
        try {
            $this->form->destroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Unit', description: 'unit berhasil dihapus!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Unit', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executePermanentHapus' => function ($rowId) {
        try {
            $this->form->permanentDestroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Unit', description: 'unit berhasil dihapus dari database!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Unit', description: $th->getMessage(), icon: 'error');
        }
    },
]);

$update = action(function () {
    try {
        $this->form->update();
        return $this->dispatch('infoNotifikasi', title: 'Unit', description: 'unit berhasil diperbarui!.', icon: 'success');
    } catch (\Throwable $th) {
        return $this->dispatch('infoNotifikasi', title: 'Unit', description: $th->getMessage(), icon: 'error');
    }
});

?>

<div>
  <x-wireui-modal name="editModal"
                  blur="base">
    <x-wireui-card title="edit modal unit">
      <form wire:submit="update">
        <div class="mt-3">
          <x-wireui-input wire:model="form.nama_unit"
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
                           right-icon="pencil-square"
                           label="Perbarui"
                           primary />
        </div>
      </form>
    </x-wireui-card>
  </x-wireui-modal>
</div>

@push('customScript')
  <script type="module">
    Livewire.on('edit', (event) => {
      // console.log(event);
      $openModal('editModal');
    });
    Livewire.on('hapus', (event) => {
      //   console.log(event);
      window.$wireui.confirmDialog({
        title: 'Anda Yakin',
        description: 'hapus data?',
        icon: 'question',
        accept: {
          label: 'iya',
          execute: () => Livewire.dispatch('executeHapus', {
            rowId: event
          })
        },
        reject: {
          label: 'batal',
          execute: () => window.$wireui.notify({
            'icon': 'info',
            'title': 'batal hapus data',
          })
        }
      })
    });
  </script>
@endpush
