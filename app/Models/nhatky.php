<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhatky extends Model
{
    use HasFactory;

    protected $table = 'nhatky';

    protected $primaryKey =  'maNhatKy';

    protected $fillable = [
        'maNhatKy',
        'maNguoiDung',
        'thoiGian',
    ];
    
    public $timestamps = false;

    public function cautraloi()
    {
        return $this->hasMany(cautraloi::class, 'maNhatKy', 'maNhatKy');
    }
}
