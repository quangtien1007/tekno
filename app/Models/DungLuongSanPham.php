<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DungLuongSanPham extends Model
{
    use HasFactory;

    protected $table = 'dungluong';

    protected $fillable = [
        'dungluong',
    ];
}
