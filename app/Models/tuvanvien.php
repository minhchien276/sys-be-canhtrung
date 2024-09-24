<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tuvanvien extends Model
{
    use HasFactory;

    protected $primaryKey =  'maTvv';

    protected $table = 'tuvanvien';

    protected $fillable = [
        'maTvv',
        'tenTvv',
        'linkZalo',
        'soDienThoai',
        'linkAnh',
        'kinhnghiem',
        'gioithieu',
        'rating',
        'linkFb',
        'status',
        'id_loaitvv',
    ];

    public $timestamps = false;
}
