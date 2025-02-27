<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Menyimpan apakah user adalah admin, alumni, atau perusahaan
        'nip', // Untuk admin
        'nim', // Untuk alumni
        'program_studi', // Untuk alumni
        'jurusan', // Untuk alumni
        'tahun_masuk', // Untuk alumni
        'tahun_lulus', // Untuk alumni
        'company_name', // Untuk perusahaan
        'company_address', // Untuk perusahaan
        'company_phone', // Untuk perusahaan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function jobs()
    {
        return $this->hasMany(JobVacancies::class, 'user_id');
    }
}
