<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasUuids;

    protected $fillable = [
        'NIM',
        'name',
        'jurusan',
    ];

    protected $table = 'mahasiswas';
}
