<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class luongkinh extends Model
{
    use HasFactory;

    protected $table = 'luongkinh';

    protected $primaryKey =  'maLuongKinh';

    protected $fillable = [
        'maLuongKinh',
        'maNguoiDung',
        'luongKinh',
        'thoiGian',
        'tonTai',
    ];
    
    public $timestamps = false;
}
