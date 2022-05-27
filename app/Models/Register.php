<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $fillable = [
        'nama', 
        'nik', 
        'tempat_lahir', 
        'tgl_lahir', 
        'email', 
        'password', 
        'no_telp', 
        'jenis_kelamin', 
        'pekerjaan', 
        'alamat', 
        'level',
        'status',
    ];
}
