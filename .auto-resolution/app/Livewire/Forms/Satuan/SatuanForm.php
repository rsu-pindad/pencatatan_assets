<?php

namespace App\Livewire\Forms\Satuan;

use App\Models\Satuan;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SatuanForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    #[Validate('unique:satuan', message: 'nama satuan sudah ada')]
    public $nama_satuan = '';

    public $konversi   = null;
    public $keterangan = '';

    public function store()
    {
        $this->validate();
        try {
            Satuan::create([
                'nama_satuan'       => $this->nama_satuan,
                'konversi_satuan'   => $this->konversi,
                'keterangan_satuan' => $this->keterangan,
            ]);
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }
}
