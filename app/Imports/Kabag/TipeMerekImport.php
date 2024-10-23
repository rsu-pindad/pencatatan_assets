<?php

namespace App\Imports\Kabag;

use App\Models\Merek;
use App\Models\Tipe;
use App\Models\TipeMerek;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class TipeMerekImport implements OnEachRow, WithStartRow, WithChunkReading
{
    use RemembersRowNumber;

    protected $awal;
    protected $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal  = $awal;
        $this->akhir = $akhir;
    }

    public function onRow(Row $row)
    {
        $row = $row->toArray();
        $tipeMerek = TipeMerek::create([
            'tipe_id'  => Tipe::where('nama_tipe', $row[1])->pluck('id')->first(),
            'merek_id' => Merek::where('nama_merek', $row[2])->pluck('id')->first(),
        ]);

        return $tipeMerek;
    }

    public function startRow(): int
    {
        return $this->awal;
    }

    public function limit(): int
    {
        return $this->akhir - 1;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
