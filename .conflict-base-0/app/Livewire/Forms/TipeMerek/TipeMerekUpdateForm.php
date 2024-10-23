<?php

namespace App\Livewire\Forms\TipeMerek;

use App\Models\TipeMerek;
use Livewire\Form;

class TipeMerekUpdateForm extends Form
{
    public $rowId = '';

    public function mount($row)
    {
        $tipeMerek   = TipeMerek::find($row);
        $this->rowId = $tipeMerek->id;
    }

    public function destroy($rowId)
    {
        TipeMerek::where('id', $rowId)->delete();
    }

    public function restore($rowId)
    {
        TipeMerek::withTrashed()->where('id', $rowId)->restore();
    }

    public function permanentDestroy($rowId)
    {
        TipeMerek::withTrashed()->where('id', $rowId)->forceDelete();
    }
}
