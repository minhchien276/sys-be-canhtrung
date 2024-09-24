<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lichkham extends Model
{
    use HasFactory;

    protected $table = 'lichkham';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'id_phongkham',
        'maNguoiDung',
        'id_tvv',
        'phone',
        'datetime',
        'status',
        'id_benh',
    ];
    
    public $timestamps = false;
}
