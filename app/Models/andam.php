<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class andam extends Model
{
    use HasFactory;

    protected $table = 'andam';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'loaiThucPham',
        'trongLuong',
        'id_con',
    ];
    
    public $timestamps = false;
}
