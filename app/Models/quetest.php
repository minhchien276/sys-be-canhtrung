<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quetest extends Model
{
    use HasFactory;

    protected $table = 'quetest';

    protected $primaryKey =  'maLoaiQue';

    protected $fillable = [
        'maLoaiQue',
        'tenQue',
    ];
    
    public $timestamps = false;
}
