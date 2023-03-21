<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;
    protected $table = 'baiviet';
    protected $fillable = [
        'author_id',
        'tieude',
        'tieude_slug',
        'thumbnail',
        'noidung',
        'luotxem',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
