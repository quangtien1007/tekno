<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HangSanXuat extends Model
{
	use HasFactory;

	protected $table = 'hangsanxuat';

	protected $fillable = [
		'tenhang',
		'tenhang_slug',
		'hinhanh',
	];

	public function SanPham()
	{
		return $this->hasMany(SanPham::class, 'loaisanpham_id', 'id');
	}
}
