<?php

namespace App\Livewire\Forms\Unit;

use App\Models\Unit;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnitForm extends Form
{
    #[Validate('required', message: 'mohon isi nama')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    #[Validate('unique:unit', message: 'nama unit sudah ada')]
    public $nama_unit = '';

    public function store()
    {
        $this->validate();
        try {
            Unit::create([
                'nama_unit' => $this->nama_unit,
            ]);
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
