<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Notification\GetNotificationDetails;
use App\Services\Notification\getNotificationUser;
use App\Services\Notification\getOrderNotification;
use Illuminate\Http\Request;

class ApiNotificationController extends Controller
{
    private $getNotificationUser;
    private $getOrderNotification;
    private $getNotificationDetails;

    public function __construct(
        getNotificationUser $getNotificationUser,
        getOrderNotification $getOrderNotification,
        GetNotificationDetails $getNotificationDetails,
    ) {
        $this->middleware('auth:api');
        $this->getNotificationUser = $getNotificationUser;
        $this->getOrderNotification = $getOrderNotification;
        $this->getNotificationDetails = $getNotificationDetails;
    }

    public function getNotificationUser(Request $request)
    {
        return $this->getNotificationUser->handle($request);
    }

    public function getOrderNotification(Request $request)
    {
        return $this->getOrderNotification->handle($request);
    }

    public function getNotificationDetails(Request $request)
    {
        return $this->getNotificationDetails->handle($request);
    }
}
