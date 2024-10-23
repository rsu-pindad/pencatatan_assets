<?php

namespace App\Livewire\Forms\Aset;

use App\Models\Aset;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AsetUpdateForm extends Form
{
    public $rowId             = '';
    
    public function destroy($rowId)
    {
        Aset::where('id', $rowId)->delete();
    }

    public function restore($rowId)
    {
        Aset::withTrashed()->where('id', $rowId)->restore();
    }

    public function permanentDestroy($rowId)
    {
        Aset::withTrashed()->where('id', $rowId)->forceDelete();
    }
}
