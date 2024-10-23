<?php

namespace App\Livewire\Forms\Vendor;

use App\Models\Vendor;
use Illuminate\Validation\Rule;
use Livewire\Form;

class VendorUpdateForm extends Form
{
    public $rowId             = '';
    public $prefix_vendor     = '';
    public $nama_vendor       = '';
    public $keterangan_vendor = '';

    public function rules()
    {
        return [
            'prefix_vendor' => [
                'required',
                'min:2',
                Rule::unique('vendor')->ignore($this->rowId),
            ],
            'nama_vendor' => [
                'required',
                'min:2',
                Rule::unique('vendor')->ignore($this->rowId),
            ],
            'keterangan_vendor' => [
                'string',
            ],
        ];
    }

    public function mount($row)
    {
        $vendor                  = Vendor::find($row);
        $this->rowId             = $vendor->id;
        $this->prefix_vendor     = $vendor->prefix_vendor;
        $this->nama_vendor       = $vendor->nama_vendor;
        $this->keterangan_vendor = $vendor->keterangan_vendor;
    }

    public function update()
    {
        $this->validate();
        $vendor                    = Vendor::find($this->rowId);
        $vendor->prefix_vendor     = $this->prefix_vendor;
        $vendor->nama_vendor       = $this->nama_vendor;
        $vendor->keterangan_vendor = $this->keterangan_vendor;
        $vendor->save();
        $this->reset();
    }

    public function destroy($rowId)
    {
        Vendor::where('id', $rowId)->delete();
    }

    public function restore($rowId)
    {
        Vendor::withTrashed()->where('id', $rowId)->restore();
    }

    public function permanentDestroy($rowId)
    {
        Vendor::withTrashed()->where('id', $rowId)->forceDelete();
    }
}
