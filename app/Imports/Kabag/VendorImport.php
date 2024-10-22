<?php

namespace App\Imports\Kabag;

use App\Models\Vendor;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class VendorImport implements ToModel, WithStartRow, WithChunkReading, WithUpserts, WithHeadingRow, WithCalculatedFormulas
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
        return new Vendor([
            'prefix_vendor'     => $row['prefix_vendor'] ?? Str::take($row['nama_vendor'], 2) ?? Str::random(2),
            'nama_vendor'       => $row['nama_vendor'],
            'keterangan_vendor' => $row['keterangan_vendor'] ?? null,
        ]);
    }

    // public function headingRow(): int
    // {
    //     return 1;
    // }

    public function uniqueBy()
    {
        return ['prefix_vendor', 'nama_vendor'];
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
        return 100;
    }
}
