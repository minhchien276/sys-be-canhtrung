<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bubinh extends Model
{
    use HasFactory;

    protected $table = 'bubinh';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'suaCongThuc',
        'suaMe',
        'id_con',
    ];
    
    public $timestamps = false;
}
