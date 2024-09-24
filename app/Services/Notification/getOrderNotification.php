<?php

namespace App\Services\Notification;

use App\Enums\TypeNotificationEnum;
use App\Models\notification;
use App\Supports\Responder;

class getOrderNotification
{
    public function handle($request)
    {
        try {
            $perPage = 20;
            $offset = ($request->page) * $perPage;

            $noti = notification::where('senderId', $request->maNguoiDung)
                ->where('type', TypeNotificationEnum::OrderNotification)
                ->skip($offset)
                ->take($perPage)
                ->get();
                
        } catch (\Exception $e) {
            return Responder::fail($e, 'Khong lay duoc danh sach thong bao');
        }

        return Responder::success($noti, 'Danh sach thong bao don hang');
    }
}
