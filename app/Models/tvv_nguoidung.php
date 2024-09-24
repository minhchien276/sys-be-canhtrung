<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tvv_nguoidung extends Model
{
    use HasFactory;

    protected $table = 'tvv_nguoidung';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maNguoiDung',
        'maTvv',
        'thoiGian',
    ];
    
    public $timestamps = false;
}
