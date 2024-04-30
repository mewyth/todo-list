<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;

    protected $table = "jadwals";

    protected $fillable = [
        'judul',
        'deskripsi',
        'start',
        'end',
        'id_user',
    ];
}
