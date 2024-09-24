<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'provinces',
        'districts',
        'wards',
        'address_specific',
        'maNguoiDung',
        'status',
        'username',
        'phone',
        'provinceId',
        'districtId',
        'wardId',
    ];
    
    public $timestamps = false;
}
