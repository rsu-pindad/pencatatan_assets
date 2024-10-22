<?php

namespace App\Livewire\Forms\Tipe;

use App\Models\Tipe;
use Illuminate\Validation\Rule;
use Livewire\Form;

class TipeUpdateForm extends Form
{
    public $rowId     = '';
    public $nama_tipe = '';

    public function rules()
    {
        return [
            'nama_tipe' => [
                'required',
                'min:2',
                Rule::unique('tipe')->ignore($this->rowId),
            ]
        ];
    }

    public function mount($row)
    {
        $tipe            = Tipe::find($row);
        $this->rowId     = $tipe->id;
        $this->nama_tipe = $tipe->nama_tipe;
    }

    public function update()
    {
        $this->validate();
        try {
            $tipe            = Tipe::find($this->rowId);
            $tipe->nama_tipe = $this->nama_tipe;
            $tipe->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function destroy($rowId)
    {
        Tipe::where('id', $rowId)->delete();
    }

    public function restore($rowId)
    {
        Tipe::withTrashed()->where('id', $rowId)->restore();
    }

    public function permanentDestroy($rowId)
    {
        Tipe::withTrashed()->where('id', $rowId)->forceDelete();
    }
}
