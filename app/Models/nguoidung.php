<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\CanResetPassword;

class nguoidung extends Model implements Authenticatable, JWTSubject, CanResetPassword
{
    use HasFactory;

    protected $table = 'nguoidung';

    protected $primaryKey =  'maNguoiDung';

    protected $fillable = [
        'maNguoiDung',
        'maPhanQuyen',
        'maTvv',
        'email',
        'taiKhoan',
        'matKhau',
        'tenNguoiDung',
        'namSinh',
        'chieuCao',
        'canNang',
        'phase',
        'avatar',
        'device_token',
        'trangThai',
        'ngayTao',
    ];


    protected $casts = [
        'maNguoiDung' => 'string',
    ];
    public $timestamps = false;

    protected $hidden = [
        'taiKhoan',
        'matKhau',
        'maPhanQuyen',
    ];

    public function getAuthIdentifierName()
    {
        // Phương thức trả về tên cột chứa ID người dùng
        return 'maNguoiDung';
    }

    public function getAuthIdentifier()
    {
        // Phương thức trả về giá trị ID người dùng
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        // Phương thức trả về mật khẩu người dùng
        return $this->matKhau;
    }

    public function getRememberToken()
    {
        // Phương thức trả về giá trị Remember Token người dùng
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        // Phương thức thiết lập giá trị Remember Token người dùng
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        // Phương thức trả về tên cột chứa Remember Token
        return 'remember_token';
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        // Gửi email đặt lại mật khẩu tới người dùng
        // Code gửi email ở đây

    }
}
