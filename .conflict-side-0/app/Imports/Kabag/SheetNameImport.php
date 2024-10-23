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
            'Unit'          => new UnitImport($this->awal, $this->akhir),
            'Tipe'          => new TipeImport($this->awal, $this->akhir),
            'Merek'         => new MerekImport($this->awal, $this->akhir),
            'TipeMerek'     => new TipeMerekImport($this->awal, $this->akhir),
            'Vendor'        => new VendorImport($this->awal, $this->akhir),
            'Satuan'        => new SatuanImport($this->awal, $this->akhir),
            'Kode'          => new KodeImport($this->awal, $this->akhir),
            'DATA ASET TRF' => new AsetImport($this->awal, $this->akhir),
        ];
    }
}
