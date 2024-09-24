<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class administrative_unit extends Model
{
    use HasFactory;

    protected $table = 'administrative_units';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'full_name',
        'full_name_en',
        'short_name',
        'short_name_en',
        'code_name',
        'code_name_en',
    ];
    
    public $timestamps = false;
}
