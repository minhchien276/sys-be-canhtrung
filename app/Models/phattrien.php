<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phattrien extends Model
{
    use HasFactory;

    protected $table = 'phattrien';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maCon',
        'canNang',
        'chieuCao',
        'thoiGian',
    ];
    
    public $timestamps = false;
}
