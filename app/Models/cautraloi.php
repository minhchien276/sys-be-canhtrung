<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cautraloi extends Model
{
    use HasFactory;

    protected $table = 'cautraloi';

    protected $primaryKey =  'maCauTraLoi';

    protected $fillable = [
        'maCauTraLoi',
        'maNhatKy',
        'maCauHoi',
        'cauTraLoi',
    ];
    
    public $timestamps = false;
}
