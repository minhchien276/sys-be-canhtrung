<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clicklink extends Model
{
    use HasFactory;

    protected $table = 'clicklink';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maNguoiDung',
        'id_link',
        'thoiGian',
    ];
    
    public $timestamps = false;
}
