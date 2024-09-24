<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'name',
        'image',
        'loaisanpham_id',
        'keyword',
        'sold',
        'ngayTao',
    ];
    
    public $timestamps = false;
}
