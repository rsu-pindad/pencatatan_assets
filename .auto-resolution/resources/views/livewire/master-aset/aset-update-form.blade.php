<?php

use App\Livewire\Forms\Aset\AsetUpdateForm;
use function WireUi\Traits\WireUiActions;
use function Livewire\Volt\{form,state,on};

form(AsetUpdateForm::class);

on([
    'executePulihkan' => function ($rowId) {
        try {
            $this->form->restore($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'aset berhasil dipulihkan!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executeHapus' => function ($rowId) {
        try {
            $this->form->destroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'aset berhasil dihapus!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: $th->getMessage(), icon: 'error');
        }
    },
]);
on([
    'executePermanentHapus' => function ($rowId) {
        try {
            $this->form->permanentDestroy($rowId);
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: 'aset berhasil dihapus dari database!.', icon: 'success');
        } catch (\Throwable $th) {
            return $this->dispatch('infoNotifikasi', title: 'Aset', description: $th->getMessage(), icon: 'error');
        }
    },
]);

?>

<div>
    
</div>
