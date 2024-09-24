<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'quantity',
        'price',
        'id_order',
        'id_product_detail',
        'created_at',
    ];
    
    public $timestamps = false;
}
