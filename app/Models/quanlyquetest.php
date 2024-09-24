<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quanlyquetest extends Model
{
    use HasFactory;

    protected $table = 'quanlyquetest';

    protected $primaryKey =  'maQuanLyQueTest';

    protected $fillable = [
        'maQuanLyQueTest',
        'maNguoiDung',
        'soLuongQueThai',
        'soLuongQueTrung',
        'ngayTao',
    ];
    
    public $timestamps = false;
}
