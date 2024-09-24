<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaichoan extends Model
{
    use HasFactory;

    protected $table = 'loaichoan';

    protected $primaryKey =  'maLoaiChoAn';

    protected $fillable = [
        'maLoaiChoAn',
        'tenLoaiChoAn',
        'donVi',
    ];
    
    public $timestamps = false;
}
