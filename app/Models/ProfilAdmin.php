<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilAdmin extends Model
{
    use HasFactory;
    protected $table = "profil";
    protected $fillable = ["admin_id", "username", "avatar"];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}
