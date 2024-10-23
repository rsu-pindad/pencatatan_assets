<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipe';

    protected $fillable = [
        'nama_tipe',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function mereks(): BelongsToMany
    {
        return $this->belongsToMany(
            Merek::class,
            'pivot_tipe_merek',
        );
    }
}
