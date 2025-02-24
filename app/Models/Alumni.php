<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumni extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['nama', 'nim', 'email', 'program_studi', 'jurusan', 'tahun_masuk', 'tahun_lulus', 'password'];

    protected $hidden = ['password'];
}

