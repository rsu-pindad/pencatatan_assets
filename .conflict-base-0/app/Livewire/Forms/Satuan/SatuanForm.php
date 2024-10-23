<?php

namespace App\Livewire\Forms\Satuan;

use App\Models\Satuan;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SatuanForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    public $nama = '';

    public $konversi   = null;
    public $keterangan = '';

    public function store()
    {
        $this->validate();
        Satuan::create([
            'nama_satuan'       => $this->nama,
            'konversi_satuan'   => $this->konversi,
            'keterangan_satuan' => $this->keterangan,
        ]);
    }
}
