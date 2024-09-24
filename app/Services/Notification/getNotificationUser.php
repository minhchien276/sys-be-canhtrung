<?php

namespace App\Services\Notification;

use App\Models\notification;
use App\Services\ParseToken\ParseToken;
use App\Supports\Responder;

class getNotificationUser
{
    private $parseToken;

    public function __construct(
        ParseToken $parseToken
    ) {
        $this->parseToken = $parseToken;
    }

    public function handle($request)
    {
        try {
            $perPage = 20;
            $offset = ($request->page) * $perPage;
            $maNguoiDung = $this->parseToken->handle()->maNguoiDung;

            $noti = notification::where(function ($query) use ($maNguoiDung) {
                $query->where('receiverId', '0')
                    ->orWhere('receiverId', $maNguoiDung);
            })
                ->orderBy('createdAt', 'desc')
                ->skip($offset)
                ->take($perPage)
                ->get();
        } catch (\Exception $e) {
            return Responder::fail($e, 'Khong lay duoc danh sach thong bao');
        }

        return Responder::success($noti, 'Danh sach thong bao tong');
    }
}
