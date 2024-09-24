<?php

namespace App\Services\Notification;

use App\Models\notification;
use App\Supports\Responder;

class GetNotificationDetails
{
    public function handle($request)
    {
        try {
            $noti = notification::where('id', $request->id)->first();

            if (!$noti) {
                return Responder::fail(null, 'Khong lay duoc chi tiet thong bao');
            }

            return Responder::success($noti, 'chi tiet thong bao tong');
        } catch (\Exception $e) {
            return Responder::fail($e, 'Da co loi xay ra');
        }
    }
}
