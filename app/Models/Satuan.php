<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'satuan';

    protected $fillable = [
        'nama_satuan',
        'konversi_satuan',
        'keterangan_satuan'
    ];
    
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
