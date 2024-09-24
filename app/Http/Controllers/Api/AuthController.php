<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Auth\createUser;
use App\Services\Auth\findUser;
use App\Services\Auth\logged;
use App\Services\Auth\resetPassword;
use App\Services\Auth\updateDeviceToken;
use App\Services\Auth\updateUser;
use App\Services\Auth\updateUserPhase;
use App\Supports\Responder;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    private $createUser;
    private $updateUser;
    private $findUser;
    private $resetPassword;
    private $updateUserPhase;
    private $logged;
    private $updateDeviceToken;

    public function __construct(
        createUser $createUser,
        updateUser $updateUser,
        updateUserPhase $updateUserPhase,
        findUser $findUser,
        resetPassword $resetPassword,
        logged $logged,
        updateDeviceToken $updateDeviceToken,
    ) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->createUser = $createUser;
        $this->updateUser = $updateUser;
        $this->updateUserPhase = $updateUserPhase;
        $this->findUser = $findUser;
        $this->resetPassword = $resetPassword;
        $this->logged = $logged;
        $this->updateDeviceToken = $updateDeviceToken;
    }

    public function login(Request $request)
    {
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

        return response()->json([
            'status' => true,
            'nguoidung' => $user,
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'taiKhoan' => [
                    'required',
                    'regex:/^(0[3|5|7|8|9]\d{8}|(?:\+?84|\b84)\d{9})$/',
                    Rule::unique('nguoidung', 'taiKhoan')
                ],
                'email' => [
                    'required',
                    'email',
                    Rule::unique('nguoidung', 'email')
                ],
                'matKhau' => 'required|min:6',
                'tenNguoiDung' => 'required',
                'namSinh' => [
                    'required', 'digits:4', 'not_regex:/^0/'
                ],
            ],
            [
                'taiKhoan.unique' => 'Số điện thoại đã tồn tại',
                'taiKhoan.regex' => 'Số điện thoại không hợp lệ',
                'email.unique' => 'Email đã tồn tại',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $user = $this->createUser->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($user, 'User created successfully');
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        return $this->updateUser->handle($request, $id);
    }

    public function updatePhase(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'phase' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $check = $this->updateUserPhase->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($check, 'User phase updated successfully');
    }

    public function find($id)
    {
        try {
            $user = $this->findUser->handle($id);
            return Responder::success($user, 'Find user successfully');
        } catch (Exception $e) {
            return Responder::fail($user, $e->getMessage());
        };
    }

    public function resetPassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'matKhau' => 'required|min:6',
            'matKhauMoi' => 'required|min:6|same:password_confirmation',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $data = $this->resetPassword->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $data;
    }

    public function logged($maNguoiDung)
    {
        try {
            $data = $this->logged->handle($maNguoiDung);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($data, 'get successfully');
    }

    public function updateDeviceToken(Request $request, $id)
    {
        return $this->updateDeviceToken->handle($request, $id);
    }
}
