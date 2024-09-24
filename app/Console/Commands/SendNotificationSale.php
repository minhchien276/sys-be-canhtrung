<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Exception;
use GuzzleHttp\Client;
use Google_Client;

class SendNotificationSale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send-sale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sale notification for specific date';

    private $credPath;
    private $projectId = "ovumb-notification";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $accessToken = $this->getAccessToken();

        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        $currentDate = Carbon::now('UTC')->format('Y-m-d');
        $messages = [
            '2024-08-31' => [
                'title' => "🎁CHỈ CÒN 49K/1 HỘP BCS MÊ EM?",
                'body' => "👉Từ 01/09, OvumB tung ra đợt khuyến mãi \"cực khủng\".\n👉Tận hưởng thời gian hạnh phúc bên nhau cùng MÊ EM",
            ],
            '2024-09-01' => [
                'title' => "🎁KHUYỄN MÃI TƯNG BỪNG.\n🌺CHÀO MỪNG NGÀY QUỐC KHÁNH VIỆT NAM - 2/9.",
                'body' => "💥Giảm giá lên đến 100k khi mua các sản phẩm từ OvumB.\n👉Nhanh tay số lượng có hạn.",
            ],
            '2024-09-02' => [
                'title' => "🌺BẠN ĐÃ NHẬN ĐƯỢC VOUCHER 100K TỪ OVUMB CHƯA?",
                'body' => "👉Nếu chưa thì nhanh tay truy cập OvumB để là người tiếp theo có được may mắn này nhé!\n💥Số lượng có hạn.",
            ],
            '2024-09-03' => [
                'title' => "😍ĐÃ CÓ 99 NGƯỜI DÀNH ĐƯỢC VOUCHER 100K KHI MUA SẢN PHẨM BẤT KỲ TỪ OVUMB!!!",
                'body' => "👉Bạn sẽ là người thứ 100 tiếp theo đó!\n👉Nhanh tay truy cập OvumB để cùng khám phá và nhận được chiếc vourcher cuối cùng này nhé!",
            ],
        ];

        $messageData = $messages[$currentDate];

        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json; UTF-8',
        ];

        // $tokens = [
        //     'c6r7c5yQj0SLjrqWC9jO53:APA91bEGtnpEwLDg_cjH5GgokleRmTjfNR9KCZ9tkTyqs5QmcLncH750v-pWpYOhIFJ847nv5vQFWP9Eivx9oeT-f9lc6IUQFwrbezUU6YK5eaksQhDpHmqIqmPBgjS4wPY-JDB18R2a',
        //     'fYVZrsJSyU9OtDZ5bPoHfZ:APA91bHjohCnsTnUryxU_p5NFdSsa876D5H-S8eAJD9ycfVbG0q0qAoFfqddzdJQPIuAZ7mFRGy3AWq6BzctBNSNok-wzs2cf6S-bG5wKL3uAO2x_guquhSANzt3NLwT8lbIyLLldKfR'
        // ];
        $notificationData = [
            'message' => [
                'topic' => '0',
                // 'token' => 'c6r7c5yQj0SLjrqWC9jO53:APA91bEGtnpEwLDg_cjH5GgokleRmTjfNR9KCZ9tkTyqs5QmcLncH750v-pWpYOhIFJ847nv5vQFWP9Eivx9oeT-f9lc6IUQFwrbezUU6YK5eaksQhDpHmqIqmPBgjS4wPY-JDB18R2a',
                'notification' => [
                    'title' => $messageData['title'],
                    'body' => $messageData['body'],
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

        return 0;
    }

    private function getAccessToken()
    {
        $credPath = public_path('ovumb-notification-firebase-adminsdk-9p9e5-b2ebfc31bc.json');
        if (!file_exists($credPath)) {
            throw new \Exception("File does not exist: " . $credPath);
        }

        $client = new Google_Client();
        $client->setAuthConfig($credPath);
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
