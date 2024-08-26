<?php

namespace App\Livewire\Forms\Kode;

use App\Models\Kode;
use Illuminate\Validation\Rule;
use Livewire\Form;

class KodeUpdateForm extends Form
{
    public $rowId           = '';
    public $prefix_kode     = '';
    public $keterangan_kode = '';

    public function rules()
    {
        return [
            'prefix_kode' => [
                'required',
                'min:2',
                Rule::unique('kode')->ignore($this->rowId),
            ],
            'keterangan_kode' => [
                'string',
            ],
        ];
    }

    public function mount($row)
    {
        $kode                  = Kode::find($row);
        $this->rowId           = $kode->id;
        $this->prefix_kode     = $kode->prefix_kode;
        $this->keterangan_kode = $kode->keterangan_kode;
    }

    public function update()
    {
        $this->validate();
        $kode                  = Kode::find($this->rowId);
        $kode->prefix_kode     = $this->prefix_kode;
        $kode->keterangan_kode = $this->keterangan_kode;
        $kode->save();
        $this->reset();
    }

    public function destroy($rowId)
    {
        Kode::where('id', $rowId)->delete();
    }

    public function restore($rowId)
    {
        Kode::withTrashed()->where('id', $rowId)->restore();
    }

    public function permanentDestroy($rowId)
    {
        Kode::withTrashed()->where('id', $rowId)->forceDelete();
    }
}
