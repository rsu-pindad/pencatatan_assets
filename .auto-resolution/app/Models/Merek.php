<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merek extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'merek';

    protected $fillable = [
        'nama_merek',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function tipes(): BelongsToMany
    {
        return $this->belongsToMany(Tipe::class, 'pivot_tipe_merek');
    }
    
}
