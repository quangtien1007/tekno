<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormMau extends Model
{
    use HasFactory;

    protected $table = 'form_mau';

    protected $fillable = [
        'form',
    ];
}
