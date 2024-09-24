<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    use HasFactory;

    protected $table = 'link';

    protected $primaryKey =  'maLink';

    protected $fillable = [
        'maLink',
        'tenLink',
        'title',
        'member',
        'image',
        'description',
    ];
    
    public $timestamps = false;
}
