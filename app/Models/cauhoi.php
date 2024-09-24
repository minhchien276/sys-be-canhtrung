<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cauhoi extends Model
{
    use HasFactory;

    protected $table = 'cauhoi';

    protected $primaryKey =  'maCauHoi';

    protected $fillable = [
        'maCauHoi',
        'noiDung',
    ];
    
    public $timestamps = false;
}
