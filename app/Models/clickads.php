<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clickads extends Model
{
    use HasFactory;

    protected $table = 'clickads';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maNguoiDung',
        'id_quangcao',
        'thoiGian',
    ];
    
    public $timestamps = false;
}
