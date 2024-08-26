<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aset extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aset';

    protected $fillable = [
        'kode_id',
        'prefix_aset',
        'nama_aset',
        'tanggal_perolehan',
        'nilai_perolehan',
        'satuan_id',
        'jumlah',
        'vendor_id',
        'pivot_tipe_merek_id',
        'unit_id',
        'image_aset',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
