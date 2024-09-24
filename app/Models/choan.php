<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class choan extends Model
{
    use HasFactory;

    protected $table = 'choan';

    protected $primaryKey =  'maChoAn';

    protected $fillable = [
        'maChoAn',
        'maLoaiChoAn',
        'maCon',
        'trongLuong',
        'lanChoAn',
        'thoiGian',
        'loaiThucPham',
        'vuTrai',
        'vuPhai',
        'ngayTao',
    ];
    
    public $timestamps = false;
}
