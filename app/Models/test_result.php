<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_result extends Model
{
    use HasFactory;

    protected $table = 'test_result';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'backgroundColor',
        'imageUrl',
        'titleText',
        'subText',
        'textColor',
        'progressColor',
        'testEnum',
        'phase',
        'type',
        'isBefore',
        'titleNotification',
        'notification',
        'imageType',
    ];
    
    public $timestamps = false;
}
