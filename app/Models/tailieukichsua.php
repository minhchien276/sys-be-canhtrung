<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tailieukichsua extends Model
{
    use HasFactory;

    protected $table = 'tailieukichsua';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'title',
        'content',
        'image',
        'link',
        'type',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;
}
