<?php

namespace App\Imports\Kabag;

use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SheetNameImport implements WithMultipleSheets
{
    use WithConditionalSheets;

    public $awal;
    public $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal  = $awal;
        $this->akhir = $akhir;
    }

    public function conditionalSheets(): array
    {
        return [
            'Unit' => new UnitImport($this->awal, $this->akhir),
        ];
    }
}
