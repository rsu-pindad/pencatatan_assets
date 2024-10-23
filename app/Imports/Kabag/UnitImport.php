<?php

namespace App\Imports\Kabag;

use App\Models\Unit;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UnitImport implements ToModel, WithStartRow, WithChunkReading, WithUpserts
{
    use RemembersRowNumber;

    protected $awal;
    protected $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal  = $awal;
        $this->akhir = $akhir;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Unit([
            'nama_unit' => $row[1]
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_unit';
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
