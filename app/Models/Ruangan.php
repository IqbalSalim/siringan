<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'data',
        'nama_bangunan',
        'jenis_bangunan',
        'daya_rumah',
    ];
}
