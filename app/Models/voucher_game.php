<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher_game extends Model
{
    use HasFactory;

    protected $table = 'voucher_game';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maNguoiDung',
        'voucher_id',
        'status',
        'expired',
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = false;
}
