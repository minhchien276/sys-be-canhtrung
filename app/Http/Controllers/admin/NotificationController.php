<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\notification;
use App\ServicesAdmin\Notification\PushNotification;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{
    private $push_notification;
    private $credPath;
    private $projectId = "ovumb-notification";

    public function __construct(
        PushNotification $push_notification,
    ) {
        $this->push_notification = $push_notification;
        $this->credPath = public_path('ovumb-notification-firebase-adminsdk-9p9e5-b2ebfc31bc.json');
    }

    public function index()
    {
        return view('admin.notification.push_notification');
    }

    public function sendNotification(Request $request)
    {
        try {
            DB::beginTransaction();
            $now = Carbon::now()->timestamp * 1000;
            $topic = $request->notification;
            $title = $request->title;
            $content = $request->content;
            $type_noti = $request->type_noti;

            $noti = notification::create([
                'title' => $title,
                'content' => $content,
                'receiverId' => 0,
                'senderId' => 0,
                'applicationId' => 0,
                'type' => $type_noti,
                'seen' => 0,
                'createdAt' => $now,
            ]);

            $this->push_notification->sendNotification($topic, $title, $content, $type_noti, $noti->id);

            DB::commit();
            return redirect()->back()->with('success', 'Gửi thông báo thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra!' . $e->getMessage());
        }
    }

    public function sendNotificationBreastMilk()
    {
        $accessToken = $this->getAccessToken();

        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        $currentUtcTime = Carbon::now('UTC');
        if ($currentUtcTime->format('A') === 'AM') {
            $bodyMessage = 'Chúc mẹ một ngày mới vui vẻ. Mình bắt đầu hành trình kích sữa hôm nay với OvumB mẹ nhé!';
        } else {
            $bodyMessage = 'Mẹ đừng quên cập nhật dữ liệu vào app để theo dõi hành trình kích sữa cho bé yêu mẹ nhé!';
        }

        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json; UTF-8',
        ];

        $notificationData = [
            'message' => [
                'topic' => '4',
                // 'token' => 'c6r7c5yQj0SLjrqWC9jO53:APA91bEGtnpEwLDg_cjH5GgokleRmTjfNR9KCZ9tkTyqs5QmcLncH750v-pWpYOhIFJ847nv5vQFWP9Eivx9oeT-f9lc6IUQFwrbezUU6YK5eaksQhDpHmqIqmPBgjS4wPY-JDB18R2a',
                'notification' => [
                    'title' => '⏰ Đã đến giờ kích sữa!',
                    'body' => $bodyMessage,
                ],
                'apns' => [
                    'payload' => [
                        'aps' => [
                            'sound' => 'ovumb.wav',
                        ],
                    ],
                ],
                "android" => [
                    "notification" => [
                        "channel_id" => "ovumb_id",
                        "sound" => "ovumb.wav",
                    ]
                ],
                "data" => [
                    "type" => '1',
                    "id" => '1',
                ]
            ],
        ];

        $client = new Client();
        $response = $client->post($url, [
            'headers' => $headers,
            'body' => json_encode($notificationData),
        ]);

        return response()->json([
            'status_code' => $response->getStatusCode(),
            'response_json' => json_decode($response->getBody(), true),
            'project_id' => $this->projectId,
            'access_token' => $accessToken,
            'notification_data' => $notificationData,
        ]);
    }

    private function getAccessToken()
    {
        if (!file_exists($this->credPath)) {
            throw new \Exception("File does not exist: " . $this->credPath);
        }

        $client = new Google_Client();
        $client->setAuthConfig($this->credPath);
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');

        $accessToken = $client->fetchAccessTokenWithAssertion();

        if (isset($accessToken['error'])) {
            throw new \Exception("Error fetching access token: " . $accessToken['error']);
        }

        if (is_null($accessToken) || !isset($accessToken['access_token'])) {
            throw new \Exception("Failed to fetch access token.");
        }

        return $accessToken['access_token'];
    }
}
