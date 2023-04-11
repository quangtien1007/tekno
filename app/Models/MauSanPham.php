<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MauSanPham extends Model
{
    use HasFactory;

    protected $table = 'mau';
    protected $fillable = [
        'mau',
    ];
}
