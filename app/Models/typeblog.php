<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeblog extends Model
{
    use HasFactory;

    protected $table = 'type_blog';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'type',
        'phase',
        'status',
        'name',
        'isHorizontal',
    ];

    public $timestamps = false;
}
