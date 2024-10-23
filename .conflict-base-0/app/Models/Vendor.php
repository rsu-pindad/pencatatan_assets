<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vendor';

    protected $fillable = [
        'prefix_vendor',
        'nama_vendor',
        'keterangan_vendor'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
