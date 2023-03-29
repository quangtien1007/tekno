<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';

    protected $fillable = [
        'loaisanpham_id',
        'hangsanxuat_id',
        'tensanpham',
        'tensanpham_slug',
        'dongia',
        'hinhanh',
        'hinhanhmota',
        'motasanpham',
        'thongsokythuat',
    ];

    public function LoaiSanPham()
    {
        return $this->belongsTo(LoaiSanPham::class, 'loaisanpham_id', 'id');
    }

    public function HangSanXuat()
    {
        return $this->belongsTo(HangSanXuat::class, 'hangsanxuat_id', 'id');
    }

    public function DonHang_ChiTiet()
    {
        return $this->hasMany(DonHang_ChiTiet::class, 'sanpham_id', 'id');
    }
}
