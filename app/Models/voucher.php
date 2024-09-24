<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'discount',
        'minPrice',
        'maxPrice',
        'status',
        'idTypeVoucher',
        'expired',
        'quantity',
        'reQuantity',
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = false;
}
