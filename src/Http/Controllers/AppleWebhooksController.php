<?php

namespace ClickDs\AppPurchaseNotifications\Http\Controllers;

use ClickDs\AppPurchaseNotifications\Models\AppleNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppleWebhooksController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        AppleNotification::create([
            'type' => $request->input('notification_type'),
            'payload' => $request->all(),
        ]);

        return new JsonResponse(null, 204);
    }
}
