<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    protected $table = "kategori";
    protected $fillable = ["nama_kategori", "slug"];

    /**
     * Get the user that owns the TipePekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
     public function pekerjaan(): HasMany
     {
         return $this->hasMany(LowonganPekerjaan::class, 'kategori_id', 'id');
     }
}
