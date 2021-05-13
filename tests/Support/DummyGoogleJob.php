<?php

namespace ClickDs\AppPurchaseNotifications\Tests\Support;

use ClickDs\AppPurchaseNotifications\Models\GoogleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DummyGoogleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $notification;

    public function __construct(GoogleNotification $googleNotification)
    {
        $this->notification = $googleNotification;
    }

    public function handle()
    {
    }
}
