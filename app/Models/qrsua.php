<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrsua extends Model
{
    use HasFactory;

    protected $table = 'qrsua';

    protected $primaryKey =  'id';

    protected $fillable = [
        'id',
        'maNguoiDung',
        'maQr',
        'expired',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;
}
