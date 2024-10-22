<?php

namespace App\Livewire\Forms\Kode;

use App\Models\Kode;
use Livewire\Attributes\Validate;
use Livewire\Form;

class KodeForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    #[Validate('unique:kode', message: 'prefix kode sudah ada')]
    public $prefix_kode = '';

    public $keterangan = '';

    public function store()
    {
        $this->validate();
        try {
            Kode::create([
                'prefix_kode'     => $this->prefix_kode,
                'keterangan_kode' => $this->keterangan,
            ]);
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
