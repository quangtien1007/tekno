<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'donhang';
    protected $fillable = [
        'is_thanhtoan',
        'pt_thanhtoan',
        'dienthoaigiaohang',
        'diachigiaohang',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function TinhTrang()
    {
        return $this->belongsTo(TinhTrang::class, 'tinhtrang_id', 'id');
    }

    public function DonHang_ChiTiet()
    {
        return $this->hasMany(DonHang_ChiTiet::class, 'donhang_id', 'id');
    }
}
