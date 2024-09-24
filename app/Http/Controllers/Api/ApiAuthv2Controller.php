<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Auth\logged;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiAuthv2Controller extends Controller
{
    private $logged;

    public function __construct(
        logged $logged
    ) {
        $this->logged = $logged;
    }

    public function loginV2(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'taiKhoan' => [
                    'required',
                ],
                'matKhau' => 'required',
            ], [
                'taiKhoan.regex' => 'Số điện thoại hoặc mật khẩu không đúng',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'status' => false
                ], 400);
            }

            $credentials = [
                'taiKhoan' => $request->taiKhoan,
                'password' => $request->matKhau,
            ];

            $token = Auth::attempt($credentials);
            if (!$token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sai số tài khoản hoặc mật khẩu',
                ], 401);
            }

            $user = Auth::user();

            if ($user->trangThai == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tài khoản không tồn tại',
                ]);
            }

            $data = $this->logged->handle($user->maNguoiDung);
            
            return response()->json([
                'status' => true,
                'nguoidung' => $user,
                'token' => $token,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }
    }

    public function redirectToApp(Request $request)
    {
        $userAgent = $request->header('User-Agent');

        if (stripos($userAgent, "iPod") !== false || stripos($userAgent, "iPhone") !== false) {
            return redirect("zalo://qr/p/12wkn8agpk8hw");
        } elseif (stripos($userAgent, "iPad") !== false) {
            return redirect("zalo://qr/p/12wkn8agpk8hw");
        } elseif (stripos($userAgent, "Android") !== false) {
            return redirect("https://zaloapp.com/qr/p/12wkn8agpk8hw");
        } elseif (stripos($userAgent, "webOS") !== false) {
            return redirect("zalo://conversation?phone=0961161254");
        } else {
            return redirect("zalo://conversation?phone=0961161254");
        }
    }
}
