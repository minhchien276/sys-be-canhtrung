<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_detail extends Model
{
    use HasFactory;

    protected $table = 'product_detail';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'image',
        'price',
        'sale',
        'description',
        'content',
        'guide',
        'product_id',
        'created_at',
    ];
    
    public $timestamps = false;
}
