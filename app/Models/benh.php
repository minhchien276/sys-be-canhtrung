<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class benh extends Model
{
    use HasFactory;

    protected $table = 'benh';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'name',
    ];
    
    public $timestamps = false;
}
