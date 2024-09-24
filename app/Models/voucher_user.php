<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher_user extends Model
{
    use HasFactory;

    protected $table = 'voucher_user';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maNguoiDung',
        'voucher_id',
        'status',
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = false;
}
