<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trieuchung extends Model
{
    use HasFactory;

    protected $table = 'trieuchung';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'dauHieu',
        'noDung',
        'capDo',
        'id_con',
    ];
    
    public $timestamps = false;
}
