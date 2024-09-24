<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phanquyen extends Model
{
    use HasFactory;

    protected $table = 'phanquyen';

    protected $primaryKey =  'maPhanQuyen';

    protected $fillable = [
        'maPhanQuyen',
        'loaiQuyen'
    ];

    public $timestamps = false;
}
