<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DungLuong_Mau extends Model
{
    use HasFactory;

    protected $table = 'dungluong_mau';

    protected $fillable = [
        'dungluong_id',
        'mau_id',
        'sanpham_id',
        'soluongton',
    ];

    public function DungLuongSanPham()
    {
        return $this->hasMany(DungLuongSanPham::class, 'dungluong_id', 'id');
    }

    public function MauSanPham()
    {
        return $this->belongsTo(MauSanPham::class, 'mau_id', 'id');
    }

    public function SanPham()
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
    }
}
