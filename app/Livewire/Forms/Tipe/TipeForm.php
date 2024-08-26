<?php

namespace App\Livewire\Forms\Tipe;

use App\Models\Tipe;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TipeForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    public $nama = '';

    public function store()
    {
        $this->validate();
        Tipe::create([
            'nama_tipe'     => $this->nama,
        ]);
    }
}
