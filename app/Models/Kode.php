<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kode';

    protected $fillable = [
        'prefix_kode',
        'keterangan_kode'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

}
