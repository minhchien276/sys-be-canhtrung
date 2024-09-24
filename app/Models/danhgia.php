<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhgia extends Model
{
    use HasFactory;

    protected $table = 'danhgia';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'id_nguoidung',
        'id_tvv',
        'danhgia',
        'sao',
        'thoiGian',
    ];
    
    public $timestamps = false;
}
