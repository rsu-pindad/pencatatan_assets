<?php

namespace App\Livewire\Forms\Unit;

use App\Models\Unit;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnitForm extends Form
{
    #[Validate('required', message: 'mohon isi nama')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    public $nama = '';

    public function store()
    {
        $this->validate();
        Unit::create([
            'nama_unit'     => $this->nama,
        ]);
    }
}
