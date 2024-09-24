<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class connnnn extends Model
{
    use HasFactory;

    protected $table = 'connnnn';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'ten',
        'ngaySinh',
        'gioiTinh',
        'canNang',
        'chieuCao',
        'ketQua',
        'avatar',
        'maNguoiDung',
        'trangThai',
        'thoiGian',
    ];

    public $timestamps = false;
}
