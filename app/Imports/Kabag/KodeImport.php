<?php

namespace App\Imports\Kabag;

use App\Models\Kode;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KodeImport implements ToModel, WithStartRow, WithChunkReading, WithUpserts, WithHeadingRow, WithCalculatedFormulas
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
        return new Kode([
            'prefix_kode'     => $row['prefix_kode'],
            'keterangan_kode' => $row['keterangan_kode']
        ]);
    }

    public function uniqueBy()
    {
        return 'prefix_kode';
    }

    public function startRow(): int
    {
        return $this->awal;
    }

    public function limit(): int
    {
        return $this->akhir;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
