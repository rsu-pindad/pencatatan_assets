<?php

namespace App\Livewire\Forms\Merek;

use App\Models\Merek;
use Illuminate\Validation\Rule;
use Livewire\Form;

class MerekUpdateForm extends Form
{
    public $rowId      = '';
    public $nama_merek = '';

    public function rules()
    {
        return [
            'nama_merek' => [
                'required',
                'min:2',
                Rule::unique('merek')->ignore($this->rowId),
            ]
        ];
    }

    public function mount($row)
    {
        $merek            = Merek::find($row);
        $this->rowId      = $merek->id;
        $this->nama_merek = $merek->nama_merek;
    }

    public function update()
    {
        $this->validate();
        try {
            $merek             = Merek::find($this->rowId);
            $merek->nama_merek = $this->nama_merek;
            $merek->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function destroy($rowId)
    {
        Merek::where('id', $rowId)->delete();
    }

    public function restore($rowId)
    {
        Merek::withTrashed()->where('id', $rowId)->restore();
    }

    public function permanentDestroy($rowId)
    {
        Merek::withTrashed()->where('id', $rowId)->forceDelete();
    }
}
