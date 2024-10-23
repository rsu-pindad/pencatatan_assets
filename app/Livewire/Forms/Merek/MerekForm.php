<?php

namespace App\Livewire\Forms\Merek;

use App\Models\Merek;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MerekForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    #[Validate('unique:merek', message: 'nama merek sudah ada')]
    public $nama_merek = '';

    public function store()
    {
        $this->validate();
        try {
            Merek::create([
                'nama_merek' => $this->nama_merek,
            ]);
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
