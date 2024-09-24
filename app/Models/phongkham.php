<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phongkham extends Model
{
    use HasFactory;

    protected $table = 'phongkham';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone',
    ];
    
    public $timestamps = false;
}
