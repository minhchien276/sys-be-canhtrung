<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kinhnguyet extends Model
{
    use HasFactory;

    protected $table = 'kinhnguyet';
    
    protected $primaryKey =  'maKinhNguyet';

    protected $fillable = [
        'maKinhNguyet',
        'maNguoiDung',
        'tbnkn',
        'snck',
        'snct',
        'ckdn',
        'cknn',
        'ngayBatDau',
        'ngayKetThuc',
        'ngayBatDauKinh',
        'ngayKetThucKinh',
        'ngayBatDauTrung',
        'ngayKetThucTrung',
        'trangThai',
    ];

    public $timestamps = false;
}
