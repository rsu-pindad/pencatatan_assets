<?php

namespace App\Livewire\Forms\Merek;

use App\Models\Merek;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MerekForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    public $nama = '';

    public function store()
    {
        $this->validate();
        Merek::create([
            'nama_merek' => $this->nama,
        ]);
    }
}
