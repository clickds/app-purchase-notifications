<?php

namespace ClickDs\AppPurchaseNotifications\Tests\Support;

use ClickDs\AppPurchaseNotifications\Models\AppleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DummyAppleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $notification;

    public function __construct(AppleNotification $appleNotification)
    {
        $this->notification = $appleNotification;
    }

    public function handle()
    {
    }
}
