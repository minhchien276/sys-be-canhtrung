<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maNguoiDung',
        'address',
        'payment_method',
        'status',
        'user_payed',
        'total_price',
        'ship_price',
        'sale_price',
        'final_price',
        'name',
        'phone',
        'created_at',
        'content',
    ];
    
    public $timestamps = false;
}
