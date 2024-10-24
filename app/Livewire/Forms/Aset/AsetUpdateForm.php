<?php

namespace App\Livewire\Forms\Aset;

use App\Models\Aset;
// use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class AsetUpdateForm extends Form
{
    public $rowId               = '';
    public $kode_id             = '';
    public $prefix_aset         = '';
    public $no_bukti            = '';
    public $nama_aset           = '';
    public $tanggal_perolehan   = '';
    public $nilai_perolehan     = '';
    public $satuan_id           = '';
    public $jumlah              = '';
    public $vendor_id           = '';
    public $pivot_tipe_merek_id = '';
    public $unit_id             = '';
    public $image_aset          = '';

    public function rules()
    {
        return [
            'kode_id' => [
                'required',
            ],
            'prefix_aset' => [
                'required',
            ],
            'no_bukti' => [
                'required',
                // Rule::unique('aset')->ignore($this->rowId),
            ],
            'nama_aset' => [
                'required',
            ],
            'tanggal_perolehan' => [
                'required',
            ],
            'nilai_perolehan' => [
                'required',
                'numeric',
                'min:1500000'
                // 'nullable',
            ],
            'satuan_id' => [
                'required',
            ],
            'jumlah' => [
                'required',
                'numeric'
            ],
            'vendor_id' => [
                'required',
            ],
            'pivot_tipe_merek_id' => [
                'nullable',
            ],
            'unit_id' => [
                'required',
            ],
            'image_aset' => [
                'image',
                'nullable',
                'max:1024'
            ],
        ];
    }

    public function mount($row)
    {
        $aset                      = Aset::find($row);
        $this->rowId               = $aset->id;
        $this->kode_id             = $aset->kode_id;
        $this->no_bukti            = $aset->no_bukti;
        $this->prefix_aset         = $aset->prefix_aset;
        $this->nama_aset           = $aset->nama_aset;
        $this->tanggal_perolehan   = $aset->tanggal_perolehan;
        $this->nilai_perolehan     = $aset->nilai_perolehan;
        $this->satuan_id           = $aset->satuan_id;
        $this->jumlah              = $aset->jumlah;
        $this->vendor_id           = $aset->vendor_id;
        $this->pivot_tipe_merek_id = $aset->pivot_tipe_merek_id;
        $this->unit_id             = $aset->unit_id;
        $this->image_aset          = $aset->image_aset;
    }

    public function update()
    {
        $this->validate();
        try {
            $lastPrefix = Aset::where('kode_id', $this->kode_id)->withTrashed()->count();
            $newPrefix  = str_pad(intval($lastPrefix) + 1, 3, 0, STR_PAD_LEFT);
            $aset       = Aset::find($this->rowId);
            if ($this->kode_id != $aset->kode_id) {
                $aset->prefix_aset = $newPrefix;
            } else {
                $aset->prefix_aset = $this->prefix_aset;
            }
            // if ($this->image_aset != null) {
            //     $photoName = $this->image_aset->hashName();
            //     Storage::disk('public')->putFileAs('asset_photo', $this->image_aset, $photoName);
            // }
            $aset->kode_id             = $this->kode_id;
            $aset->no_bukti            = $this->no_bukti;
            $aset->nama_aset           = $this->nama_aset;
            $aset->tanggal_perolehan   = $this->tanggal_perolehan;
            $aset->nilai_perolehan     = $this->nilai_perolehan;
            $aset->satuan_id           = $this->satuan_id;
            $aset->jumlah              = $this->jumlah;
            $aset->vendor_id           = $this->vendor_id;
            $aset->pivot_tipe_merek_id = $this->pivot_tipe_merek_id;
            $aset->unit_id             = $this->unit_id;
            // $aset->image_aset          = $this->image_aset;
            $aset->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

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
