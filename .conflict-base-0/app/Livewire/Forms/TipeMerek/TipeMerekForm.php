<?php

namespace App\Livewire\Forms\TipeMerek;

use App\Models\Tipe;
use App\Models\TipeMerek;
use Illuminate\Support\Arr;
use Livewire\Attributes\Validate;
use Livewire\Form;

// use Illuminate\Support\Arr;

class TipeMerekForm extends Form
{
    // public Tipe $tipeModel;
    public $tipeModel;

    #[Validate('required', message: 'mohon pilih tipe')]
    public $tipe = '';

    #[Validate('required', message: 'mohon pilih merek')]
    public $merek = [];

    public function storeMerek()
    {
        $this->validate();
        $this->tipeModel = Tipe::find($this->tipe);
        // foreach ($this->merek as $key => $item) {
        //     $this->tipeModel->mereks()->syncWithoutDetaching($item);
        // }
        $this->tipeModel->mereks()->syncWithoutDetaching($this->merek);
    }
}
