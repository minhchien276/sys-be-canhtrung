<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ketquatest extends Model
{
    use HasFactory;

    protected $table = 'ketquatest';

    protected $primaryKey =  'maKetQuaTest';

    protected $fillable = [
        'maKetQuaTest',
        'maQuanLyQueTest',
        'maLoaiQue',
        'lanTest',
        'thoiGian',
        'ketQua',
        'image',
        'device',
    ];

    public $timestamps = false;
}
