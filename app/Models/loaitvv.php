<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaitvv extends Model
{
    use HasFactory;

    protected $table = 'loaitvv';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'type',
    ];

    public $timestamps = false;
}
