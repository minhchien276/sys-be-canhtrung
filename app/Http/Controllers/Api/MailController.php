<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use App\Models\nguoidung;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\OtpAccount;
use App\Models\otp;
use DateInterval;
use DateTime;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['sendResetLinkEmail']]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        $response = Password::sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            $user = nguoidung::where('email', $request->email)->first();

            // Tạo mật khẩu mới
            $newPassword = Str::random(6);
            $user->matKhau = bcrypt($newPassword);
            $user->save();

            // Gửi email chứa mật khẩu mới
            Mail::to($user->email)->send(new ResetPasswordMail($newPassword));

            return response()->json([
                'message' => 'Mật khẩu đã được đặt lại và gửi đến địa chỉ email của bạn.',
                'status' => true
            ], 200);
        }

        return response()->json([
            'message' => 'Không thể gửi email đặt lại mật khẩu. Vui lòng kiểm tra lại địa chỉ email của bạn.',
            'status' => false
        ], 400);
    }

    public function generateOtp(Request $request)
    {
        $maNguoiDung = $request->maNguoiDung;

        $expiryTime = new DateTime();
        $expiryTime->add(new DateInterval('PT15M'));

        $check = otp::where('maNguoiDung', $maNguoiDung)->first();
        if ($check) {
            $otp = otp::where('maNguoiDung', $maNguoiDung)->update([
                'pin' => rand(1000, 9999),
                'expired' => $expiryTime->format('Y-m-d H:i:s'),
                'status' => 0,
            ]);
        } else {
            $otp = otp::create([
                'pin' => rand(1000, 9999),
                'expired' => $expiryTime->format('Y-m-d H:i:s'),
                'status' => 0,
                'maNguoiDung' => $maNguoiDung
            ]);
        }

        $user = nguoidung::where('maNguoiDung', $maNguoiDung)->first();

        // Gửi email
        Mail::to($user->email)->send(new OtpAccount($otp->pin));

        return response()->json([
            'email' => $user->email,
            'message' => 'Mã OTP đã được gửi vào mail của bạn.',
            'status' => true
        ], 200);
    }

    public function verifyOtp(Request $request)
    {
        $maNguoiDung = $request->maNguoiDung;
        $pin = $request->pin;

        $expiryTime = new DateTime();
        $expiryTime->add(new DateInterval('PT15M'));

        $otp = otp::where('maNguoiDung', $maNguoiDung)
            ->where('pin', $pin)
            ->where('status', 0)
            ->where('expired', "<=", $expiryTime->format('Y-m-d H:i:s'))
            ->first();

        if ($otp) {
            nguoidung::where('maNguoiDung', $maNguoiDung)->update(['trangThai' => 0]);
            otp::where('maNguoiDung', $maNguoiDung)->delete();

            return response()->json([
                'message' => 'Tài khoản của bạn đã bị xóa',
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Xóa thất bại',
                'status' => false
            ], 200);
        }
    }
}
