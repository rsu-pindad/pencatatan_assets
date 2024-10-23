<?php

namespace App\Livewire\Forms\TipeMerek;

use App\Models\TipeMerek;
use Illuminate\Validation\Rule;
use Livewire\Form;

class TipeMerekUpdateForm extends Form
{
    public $id      = '';
    public $tipeId  = '';
    public $merekId = '';

    public function rules()
    {
        return [
            'id' => [
                'required',
                Rule::unique('pivot_tipe_merek')->ignore($this->id),
            ],
            'tipeId' => [
                'required',
            ],
            'merekId' => [
                'required',
            ],
        ];
    }

    public function mount($row)
    {
        $tipeMerek     = TipeMerek::find($row);
        $this->id      = $tipeMerek->id;
        $this->tipeId  = $tipeMerek->tipe_id;
        $this->merekId = $tipeMerek->merek_id;
    }

    public function update()
    {
        $this->validate();
        try {
            $tipeMerek           = TipeMerek::find($this->id);
            $tipeMerek->tipe_id  = $this->tipeId;
            $tipeMerek->merek_id = $this->merekId;
            $tipeMerek->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
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
