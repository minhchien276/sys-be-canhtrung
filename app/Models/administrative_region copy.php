<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class administrative_region extends Model
{
    use HasFactory;

    protected $table = 'administrative_regions';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'name',
        'name_en',
        'code_name',
        'code_name_en',
    ];
    
    public $timestamps = false;
}
