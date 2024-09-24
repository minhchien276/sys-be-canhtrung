<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_voucher extends Model
{
    use HasFactory;

    protected $table = 'type_voucher';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = false;
}
