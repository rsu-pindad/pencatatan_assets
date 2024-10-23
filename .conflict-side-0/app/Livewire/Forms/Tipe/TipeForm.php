<?php

namespace App\Livewire\Forms\Tipe;

use App\Models\Tipe;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TipeForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    #[Validate('unique:tipe', message: 'nama tipe sudah ada')]
    public $nama_tipe = '';

    public function store()
    {
        $this->validate();
        try {
            Tipe::create([
                'nama_tipe' => $this->nama_tipe,
            ]);
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
