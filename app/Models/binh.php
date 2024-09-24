<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class binh extends Model
{
    use HasFactory;

    protected $table = 'binh';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'lop',
        'khoangCach',
        'MaBinh',
    ];
    
    public $timestamps = false;
}
