<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otp extends Model
{
    use HasFactory;

    protected $table = 'otp';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'pin',
        'expired',
        'status',
        'maNguoiDung',
    ];
    
    public $timestamps = false;
}
