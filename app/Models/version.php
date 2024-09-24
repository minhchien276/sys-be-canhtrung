<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class version extends Model
{
    use HasFactory;

    protected $table = 'version';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'version_id',
        'content',
        'update_at',
    ];
    
    public $timestamps = false;
}
