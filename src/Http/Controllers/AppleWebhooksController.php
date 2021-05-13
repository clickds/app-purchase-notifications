<?php

namespace ClickDs\AppPurchaseNotifications\Http\Controllers;

use ClickDs\AppPurchaseNotifications\Models\AppleNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class AppleWebhooksController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $notification = AppleNotification::create([
            'type' => $request->input('notification_type'),
            'payload' => $request->all(),
        ]);

        try {
            $this->dispatchJob($notification);
            return new JsonResponse(null, 204);
        } catch (Throwable $e) {
            Log::error($e);
            return new JsonResponse(null, 501);
        }
    }

    private function dispatchJob(AppleNotification $appleNotification): void
    {
        $jobClass = $appleNotification->jobClass();
        if (is_null($jobClass)) {
            throw new Exception("Could not handle apple notification {$appleNotification->id}");
        }
        $jobClass::dispatch($appleNotification);
    }
}
