<?php

use App\Livewire\Forms\TipeMerek\TipeMerekUpdateForm;
use function Livewire\Volt\{form, on};

form(TipeMerekUpdateForm::class);
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
?>

<div>
</div>
