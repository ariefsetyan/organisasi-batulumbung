<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelAbsensi extends Model
{
    protected $table = 'excel_absensi';
    protected $fillable = [
        'user_id',
        'nama',
        'status'];
}
