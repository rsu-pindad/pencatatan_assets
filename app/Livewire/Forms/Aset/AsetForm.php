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

    #[Validate('required', message: 'mohon isi no bukti')]
    public $noBukti = '';

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
        // $extension = $this->photo->getClientOriginalExtension();
        $photoName = 'default';
        // bcadd($this->nilai,'0',2);
        // dd($this->nilai);
        // $this->nilai = str_replace('.', '', $this->nilai);
        $data = [];
        try {
            if ($this->photo != null) {
                $photoName = $this->photo->hashName();
                Storage::disk('public')->putFileAs('asset_photo', $this->photo, $photoName);
            }
            $lastPrefix = Aset::where('kode_id', $this->kode)->withTrashed()->count();
            $newPrefix  = str_pad(intval($lastPrefix) + 1, 3, 0, STR_PAD_LEFT);
            Aset::create([
                'kode_id'             => $this->kode,
                'no_bukti'            => $this->noBukti,
                'prefix_aset'         => $newPrefix,
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
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
