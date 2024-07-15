<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PemberiKerja extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table= "pemberi_kerja";
    protected $guard = "instansi";
    protected $fillable = ["id","nama", "email", "password", "no_hp", "link", "deskripsi", "gambar", "slug", "status"];

    public function pekerjaan()
     {
         return $this->hasMany(LowonganPekerjaan::class, 'pemberi_kerja_id', 'id');
     }

     public function profile() {
        return $this->hasOne(PemberiKerja::class, 'id');
    }
}
