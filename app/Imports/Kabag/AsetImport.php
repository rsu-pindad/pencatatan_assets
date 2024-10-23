<?php

namespace App\Imports\Kabag;

use App\Models\Aset;
use App\Models\Kode;
use App\Models\Satuan;
use App\Models\Unit;
use App\Models\Vendor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AsetImport implements ToModel, WithStartRow, WithLimit, WithHeadingRow, WithValidation, WithChunkReading, WithBatchInserts
{
    use Importable, RemembersRowNumber, RemembersChunkOffset;

    protected $awal;
    protected $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal  = $awal;
        $this->akhir = $akhir;
    }

    public function prepareForValidation($data, $index)
    {
        $splitKode = explode('.', $data['kode']);
        $kode = array_shift($splitKode);
        $prefixAset = last($splitKode);
        $parseDate = intval($data['tanggal_perolehan_aset']);
        $parsedDate = Date::excelToDateTimeObject($parseDate)->format('Y-m-d');
        $normalisedRow = [
            'kode_id'           => Kode::where('prefix_kode', $kode)->pluck('id')->first(),
            'prefix_aset'       => $prefixAset,
            'no_bukti'          => $data['no_butki'],
            'nama_aset'         => $data['nama_aset'],
            'tanggal_perolehan' => $parsedDate,
            'nilai_perolehan'   => intval($data['nilai_perolehan_aset']),
            'satuan_id'         => Satuan::where('nama_satuan', $data['pilih_satuan'])->pluck('id')->first(),
            'jumlah'            => intval($data['berapa_jumlah_aset']),
            'vendor_id'         => Vendor::where('nama_vendor', $data['pilih_vendor'])->pluck('id')->first(),
            'unit_id'           => Unit::where('nama_unit', $data['pilih_unit'])->pluck('id')->first(),
        ];

        return $normalisedRow;
    }

    public function rules(): array
    {
        return [
            'kode_id'           => 'required',
            'prefix_aset'       => 'required',
            'no_bukti'          => 'required',
            'nama_aset'         => 'required',
            'tanggal_perolehan' => 'required',
            'nilai_perolehan'   => 'required',
            'satuan_id'         => 'required',
            'jumlah'            => 'required',
            'vendor_id'         => 'required',
            'unit_id'           => 'required',
        ];
    }

    // public function collection(Collection $rows)
    // {

    //     foreach ($rows as $row) {
    //         if (!isset($row['kode'])) {
    //             return '';
    //         }
    //         $splitKode  = explode('.', $row['kode']);
    //         $kode       = array_shift($splitKode);
    //         $prefixAset = last($splitKode);
    //         $parseDate  = intval($row['tanggal_perolehan_aset']);
    //         $parsedDate = Date::excelToDateTimeObject($parseDate)->format('Y-m-d');
    //         $kodeId     = Kode::where('prefix_kode', $kode)->pluck('id')->first();
    //         $satuanId   = Satuan::where('nama_satuan', $row['pilih_satuan'])->pluck('id')->first();
    //         $vendorId   = Vendor::where('nama_vendor', $row['pilih_vendor'])->pluck('id')->first();
    //         $unitId     = Unit::where('nama_unit', $row['pilih_unit'])->pluck('id')->first();
    //         Aset::create([
    //             'kode_id'           => $kodeId,
    //             'prefix_aset'       => $prefixAset,
    //             'no_bukti'          => $row['no_butki'],
    //             'nama_aset'         => $row['nama_aset'],
    //             'tanggal_perolehan' => $parsedDate,
    //             'nilai_perolehan'   => intval($row['nilai_perolehan_aset']),
    //             'satuan_id'         => $satuanId,
    //             'jumlah'            => intval($row['berapa_jumlah_aset']),
    //             'vendor_id'         => $vendorId,
    //             'unit_id'           => $unitId,
    //         ]);
    //     }
    // }

    public function model(array $row)
    {
        $currentRowNumber = $this->getRowNumber();
        $chunkOffset      = $this->getChunkOffset();
        // if (!isset($row['kode_id'])) {
        //     return null;
        // }

        return new Aset([
            'kode_id'           => $row['kode_id'],
            'prefix_aset'       => $row['prefix_aset'],
            'no_bukti'          => $row['no_bukti'],
            'nama_aset'         => $row['nama_aset'],
            'tanggal_perolehan' => $row['tanggal_perolehan'],
            'nilai_perolehan'   => $row['nilai_perolehan'],
            'satuan_id'         => $row['satuan_id'],
            'jumlah'            => $row['jumlah'],
            'vendor_id'         => $row['vendor_id'],
            'unit_id'           => $row['unit_id']
        ]);
    }

    public function batchSize(): int
    {
        return 200;
    }

    public function headingRow(): int
    {
        return 1;
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
        return 200;
    }
}
