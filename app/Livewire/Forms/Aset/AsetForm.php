<?php

namespace App\Livewire\Forms\Aset;

use App\Models\Aset;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AsetForm extends Form
{
    #[Validate('required', message: 'mohon isi kode')]
    public $kode = '';

    #[Validate('required', message: 'mohon isi nama')]
    public $nama = '';

    #[Validate('required', message: 'mohon isi tanggal perolehan')]
    public $tglPerolehan = '';

    #[Validate('required', message: 'mohon isi nilai')]
    #[Validate('numeric')]
    #[Validate('min:1500000', message: 'Nilai >= 1.500.000')]
    public $nilai = '';

    #[Validate('required', message: 'mohon isi jumlah')]
    public $jumlah = '';

    #[Validate('required', message: 'mohon isi satuan')]
    public $satuan = '';

    #[Validate('required', message: 'mohon isi vendor')]
    public $vendor = '';

    public $tipeMerek = null;

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
        // bcadd($this->nilai,'0',2);
        // dd($this->nilai);
        // $this->nilai = str_replace('.', '', $this->nilai);
        $data = [];
        if ($this->photo != null) {
            $photoName = $this->photo->hashName();
            Storage::disk('public')->putFileAs('asset_photo', $this->photo, $photoName);
        }
        Aset::create([
            'kode_id'             => $this->kode,
            'prefix_aset'         => $this->kode . '-' . $this->nama,
            'nama_aset'           => $this->nama,
            'tanggal_perolehan'   => $this->tglPerolehan,
            'nilai_perolehan'     => $this->nilai,
            'satuan_id'           => $this->satuan,
            'jumlah'              => $this->jumlah,
            'vendor_id'           => $this->vendor,
            'pivot_tipe_merek_id' => $this->tipeMerek ?? null,
            'unit_id'             => $this->unit,
            'image_aset'          => $photoName,
        ]);
    }
}
