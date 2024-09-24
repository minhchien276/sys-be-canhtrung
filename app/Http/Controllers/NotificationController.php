<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_CloudTasks;
use GuzzleHttp\Client;

class NotificationController extends Controller
{
    private $credPath;
    private $projectId = "ovumb-notification";

    public function __construct()
    {
        $this->credPath = public_path('ovumb-notification-firebase-adminsdk-9p9e5-b2ebfc31bc.json');
    }

    public function sendNotification()
    {
        $accessToken = $this->getAccessToken();

        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";


        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json; UTF-8',
        ];

        $notificationData = [
            'message' => [
                // 'topic' => '1',
                'token' => 'c6r7c5yQj0SLjrqWC9jO53:APA91bEGtnpEwLDg_cjH5GgokleRmTjfNR9KCZ9tkTyqs5QmcLncH750v-pWpYOhIFJ847nv5vQFWP9Eivx9oeT-f9lc6IUQFwrbezUU6YK5eaksQhDpHmqIqmPBgjS4wPY-JDB18R2a',
                'notification' => [
                    'title' => '[test]',
                    'body' => '[test body]',
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
