<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = "lokasi";
    protected $fillable = ["nama_kampung", "nama_kecamatan", "slug"];

    /**
     * Get the user that owns the Lokasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

     /**
      * Get all of the comments for the Lokasi
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasMany
      */
     public function pekerjaan(): HasMany
     {
         return $this->hasMany(LowonganPekerjaan::class);
     }
    
}
