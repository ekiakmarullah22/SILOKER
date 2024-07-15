<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LowonganPekerjaan extends Model
{
    use HasFactory;

    protected $table= "lowongan_pekerjaan";
    protected $fillable = ["nama", "batas_lamaran", "syarat", "catatan", "deskripsi", "gambar", "pemberi_kerja_id", "lokasi_id", "kategori_id", "besaran_gaji"];

    public function pemberi_kerja() {
        return $this->belongsTo(PemberiKerja::class);
    }

    
    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class)->withDefault();
    }

    
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class)->withDefault();
    }

    
}
