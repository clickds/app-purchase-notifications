<?php

namespace ClickDs\AppPurchaseNotifications\Http\Controllers;

use ClickDs\AppPurchaseNotifications\Models\GoogleNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class GoogleWebhooksController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $notificationType = $this->calculateNotificationType($request);

        $notification = GoogleNotification::create([
            'type' => $notificationType,
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

    private function dispatchJob(GoogleNotification $googleNotification): void
    {
        $jobClass = $googleNotification->jobClass();
        if (is_null($jobClass)) {
            throw new Exception("Could not handle google notification {$googleNotification->id}");
        }
        $jobClass::dispatch($googleNotification);
    }

    private function calculateNotificationType(Request $request)
    {
        if (!$request->has('subscriptionNotification')) {
            return 'Unknown';
        }
        $notificationType = $request->input('subscriptionNotification.notificationType');
        if (array_key_exists($notificationType, GoogleNotification::GOOGLE_SUBSCRIPTION_NOTIFICATION_TYPES)) {
            return GoogleNotification::GOOGLE_SUBSCRIPTION_NOTIFICATION_TYPES[$notificationType];
        }
        return $notificationType;
    }
}
