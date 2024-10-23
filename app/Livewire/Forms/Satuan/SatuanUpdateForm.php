<?php

namespace App\Livewire\Forms\Satuan;

use App\Models\Satuan;
use Illuminate\Validation\Rule;
use Livewire\Form;

class SatuanUpdateForm extends Form
{
    public $rowId             = '';
    public $nama_satuan       = '';
    public $konversi_satuan   = '';
    public $keterangan_satuan = '';

    public function rules()
    {
        return [
            'nama_satuan' => [
                'required',
                'min:2',
                Rule::unique('satuan')->ignore($this->rowId),
            ],
            'konversi_satuan' => [
                'numeric',
                'nullable'
            ],
            'keterangan_satuan' => [
                'string',
                'nullable'
            ],
        ];
    }

    public function mount($row)
    {
        $satuan                  = Satuan::find($row);
        $this->rowId             = $satuan->id;
        $this->nama_satuan       = $satuan->nama_satuan;
        $this->konversi_satuan   = $satuan->konversi_satuan;
        $this->keterangan_satuan = $satuan->keterangan_satuan;
    }

    public function update()
    {
        $this->validate();
        try {
            $satuan                    = Satuan::find($this->rowId);
            $satuan->nama_satuan       = $this->nama_satuan;
            $satuan->konversi_satuan   = $this->konversi_satuan;
            $satuan->keterangan_satuan = $this->keterangan_satuan;
            $satuan->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function destroy($rowId)
    {
        Satuan::where('id', $rowId)->delete();
    }

    public function restore($rowId)
    {
        Satuan::withTrashed()->where('id', $rowId)->restore();
    }

    public function permanentDestroy($rowId)
    {
        Satuan::withTrashed()->where('id', $rowId)->forceDelete();
    }
}
