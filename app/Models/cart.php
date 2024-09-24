<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'quantity',
        'maNguoiDung',
        'id_product_detail',
        'created_at',
    ];
    
    public $timestamps = false;
}
