<?php

namespace App\Livewire\Forms\Kode;

use App\Models\Kode;
use Livewire\Attributes\Validate;
use Livewire\Form;

class KodeForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    public $prefix = '';

    public $keterangan = '';

    public function store()
    {
        $this->validate();
        Kode::create([
            'prefix_kode'     => $this->prefix,
            'keterangan_kode' => $this->keterangan,
        ]);
    }
}
