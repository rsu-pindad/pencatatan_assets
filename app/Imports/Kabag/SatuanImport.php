<?php

namespace App\Imports\Kabag;

use App\Models\Satuan;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SatuanImport implements ToModel, WithStartRow, WithChunkReading, WithUpserts, WithHeadingRow
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
        return new Satuan([
            'nama_satuan'       => $row['nama_satuan'],
            'konversi_satuan'   => $row['konversi_satuan'] ?? null,
            'keterangan_satuan' => $row['keterangan_satuan'] ?? null,
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_satuan';
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
