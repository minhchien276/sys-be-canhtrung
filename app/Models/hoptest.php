<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hoptest extends Model
{
    use HasFactory;

    protected $table = 'hoptest';

    protected $primaryKey =  'maHopTest';

    protected $fillable = [
        'maHopTest',
        'maNguoiDung',
        'thoiGian',
    ];
    
    public $timestamps = false;
}
