<?php

namespace ClickDs\AppPurchaseNotifications\Http\Controllers;

use ClickDs\AppPurchaseNotifications\Models\GoogleNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GoogleWebhooksController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $notificationType = $this->calculateNotificationType($request);

        GoogleNotification::create([
            'type' => $notificationType,
            'payload' => $request->all(),
        ]);

        return new JsonResponse(null, 204);
    }

    private function calculateNotificationType(Request $request)
    {
        if ($request->has('subscriptionNotification')) {
            $notificationType = $request->input('subscriptionNotification.notificationType');
            return GoogleNotification::GOOGLE_SUBSCRIPTION_NOTIFICATION_TYPES[$notificationType];
        }
    }
}
