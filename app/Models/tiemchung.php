<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiemchung extends Model
{
    use HasFactory;

    protected $table = 'tiemchung';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'id_vacxin',
        'lanTiem',
        'thoiGian',
        'id_con',
    ];
    
    public $timestamps = false;
}
