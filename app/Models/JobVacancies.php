<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancies extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Relasi ke perusahaan yang membuat lowongan
        'title',
        'description',
        'requirements',
        'location',
        'status', // "pending", "approved", "rejected"
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
