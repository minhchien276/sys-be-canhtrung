<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thaiki extends Model
{
    use HasFactory;

    protected $table = 'thaiki';

    protected $primaryKey =  'maThaiKi';

    protected $fillable = [
        'maThaiKi',
        'maNguoiDung',
        'ngayQuanHe',
        'ngayDuSinh',
        'ngayTestThuThai',
        'ketQuaVangDa',
        'hinhAnh',
    ];
    
    protected $hidden = [
        'maNguoiDung',
    ];

    public $timestamps = false;
}
