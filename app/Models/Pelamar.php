<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Pelamar extends Model
{
    use HasFactory;
    protected $table = "pelamar";
    protected $fillable = ["lowongan_pekerjaan_id", "name", "email", "domisili", "umur", "cv"];
}
