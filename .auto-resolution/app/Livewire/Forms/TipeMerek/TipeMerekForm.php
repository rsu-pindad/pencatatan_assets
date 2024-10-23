<?php

namespace App\Livewire\Forms\TipeMerek;

use App\Models\Tipe;
use Livewire\Attributes\Validate;
use Livewire\Form;

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
        try {
            $this->tipeModel = Tipe::find($this->tipe);
            // foreach ($this->merek as $key => $item) {
            //     $this->tipeModel->mereks()->syncWithoutDetaching($item);
            // }
            $this->tipeModel->mereks()->syncWithoutDetaching($this->merek);

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
