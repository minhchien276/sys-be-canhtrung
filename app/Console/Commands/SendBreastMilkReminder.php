<?php

namespace App\Console\Commands;

use App\Http\Controllers\admin\NotificationController;
use Illuminate\Console\Command;

class SendBreastMilkReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send-breast-milk-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected NotificationController $notificationController;

    public function __construct(NotificationController $notificationController) {
        parent::__construct();
        $this->notificationController = $notificationController;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->notificationController->sendNotificationBreastMilk();
    }
}
