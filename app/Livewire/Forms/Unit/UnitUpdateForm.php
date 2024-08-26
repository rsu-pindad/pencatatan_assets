<?php

namespace App\Livewire\Forms\Unit;

use App\Models\Unit;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UnitUpdateForm extends Form
{
    public $rowId     = '';
    public $nama_unit = '';

    public function rules()
    {
        return [
            'nama_unit' => [
                'required',
                'min:2',
                Rule::unique('unit')->ignore($this->rowId),
            ],
        ];
    }

    public function mount($row)
    {
        $unit            = Unit::find($row);
        $this->rowId     = $unit->id;
        $this->nama_unit = $unit->nama_unit;
    }

    public function update()
    {
        $this->validate();
        $unit            = Unit::find($this->rowId);
        $unit->nama_unit = $this->nama_unit;
        $unit->save();
        $this->reset();
    }

    public function destroy($rowId)
    {
        Unit::where('id', $rowId)->delete();
    }

    public function restore($rowId)
    {
        Unit::withTrashed()->where('id', $rowId)->restore();
    }

    public function permanentDestroy($rowId)
    {
        Unit::withTrashed()->where('id', $rowId)->forceDelete();
    }
}
