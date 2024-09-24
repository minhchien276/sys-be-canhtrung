<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bume extends Model
{
    use HasFactory;

    protected $table = 'bume';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'trai',
        'phai',
        'id_con',
    ];
    
    public $timestamps = false;
}
