<?php

namespace App\Livewire\Forms\Aset;

use App\Models\Aset;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
// use Illuminate\Support\Number;

// use Livewire\WithFileUploads;

class AsetForm extends Form
{
    // use WithFileUploads;

    #[Validate('required', message: 'mohon isi kode')]
    public $kode = '';

    #[Validate('required', message: 'mohon isi nama')]
    public $nama = '';

    #[Validate('required', message: 'mohon isi tanggal perolehan')]
    public $tglPerolehan = '';

    #[Validate('required', message: 'mohon isi nilai')]
    public $nilai = '';

    #[Validate('required', message: 'mohon isi jumlah')]
    public $jumlah = '';

    #[Validate('required', message: 'mohon isi satuan')]
    public $satuan = '';

    #[Validate('required', message: 'mohon isi vendor')]
    public $vendor = '';

    #[Validate('required', message: 'mohon isi tipe/merek')]
    public $tipeMerek = '';

    #[Validate('required', message: 'mohon isi unit')]
    public $unit = '';

    #[Validate('image|max:1024|nullable')]
    public $photo;

    public function store()
    {
        $this->validate();
        // dd($this->all());
        // $extension = $this->photo->getClientOriginalExtension();
        $photoName = 'default';
        $storeImg = false;
        // dd(bcadd($this->nilai,'0',2));
        $this->nilai = str_replace('.','',$this->nilai);
        // $nominal = Number::currency($nominal, 'RUPIAH', 'id');
        if($this->photo != null){
            $photoName = $this->photo->hashName();
            $storeImg  = Storage::disk('public')->putFileAs('asset_photo', $this->photo, $photoName);
        }
        if (!$storeImg) {
            Aset::create([
                'kode_id'             => $this->kode,
                'prefix_aset'         => $this->kode . $this->nama,
                'nama_aset'           => $this->nama,
                'tanggal_perolehan'   => $this->tglPerolehan,
                'nilai_perolehan'     => $this->nilai,
                'satuan_id'           => $this->satuan,
                'jumlah'              => $this->jumlah,
                'vendor_id'           => $this->vendor,
                'pivot_tipe_merek_id' => $this->tipeMerek,
                'unit_id'             => $this->unit,
                'image_aset'          => $photoName,
            ]);
        }
        Aset::create([
            'kode_id'             => $this->kode,
            'prefix_aset'         => $this->kode . $this->nama,
            'nama_aset'           => $this->nama,
            'tanggal_perolehan'   => $this->tglPerolehan,
            'nilai_perolehan'     => floatval($this->nilai),
            'satuan_id'           => $this->satuan,
            'jumlah'              => $this->jumlah,
            'vendor_id'           => $this->vendor,
            'pivot_tipe_merek_id' => $this->tipeMerek,
            'unit_id'             => $this->unit,
            'image_aset'          => $photoName,
        ]);
    }
}
