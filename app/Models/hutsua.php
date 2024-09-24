<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hutsua extends Model
{
    use HasFactory;

    protected $table = 'hutsua';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maNguoiDung',
        'vuTrai',
        'vuPhai',
        'lanChoAn',
        'thoiGian',
        'ngayTao',
    ];
    
    public $timestamps = false;
}
