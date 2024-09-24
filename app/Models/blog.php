<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'image',
        'title',
        'content',
        'link',
        'type',
        'date',
        'type_blog_id',
    ];
    
    public $timestamps = false;
}
