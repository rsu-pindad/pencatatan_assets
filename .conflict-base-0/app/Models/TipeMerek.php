<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipeMerek extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pivot_tipe_merek';

    protected $fillable = [
        'tipe_id',
        'merek_id',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function parentTipe(): BelongsTo
    {
        return $this->belongsTo(Tipe::class, 'tipe_id', 'id');
    }

    public function parentMerek(): BelongsTo
    {
        return $this->belongsTo(Merek::class, 'merek_id', 'id');
    }

//     public function hasManyTipe(): HasMany
//     {
//         return $this->hasMany(Tipe::class, 'tipe_id', 'id');
//     }

//     public function hasManyMerek(): HasMany
//     {
//         return $this->hasMany(Merek::class, 'merek_id', 'id');
//     }
}
