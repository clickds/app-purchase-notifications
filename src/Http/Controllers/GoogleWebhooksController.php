<?php

namespace ClickDs\AppPurchaseNotifications\Http\Controllers;

use ClickDs\AppPurchaseNotifications\Models\GoogleNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Throwable;

class GoogleWebhooksController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        if (!$request->has('message.data')) {
            return new JsonResponse(null, 400);
        }
        $encryptedData = $request->input('message.data');
        $jsonData = base64_decode($encryptedData);
        $data = json_decode($jsonData, JSON_OBJECT_AS_ARRAY);
        $notificationType = $this->calculateNotificationType($data);

        $notification = GoogleNotification::create([
            'type' => $notificationType,
            'payload' => $data,
        ]);

        try {
            $this->dispatchJob($notification);
        } catch (Throwable $e) {
            Log::error($e);
        }
        return new JsonResponse(null, 204);
    }

    private function dispatchJob(GoogleNotification $googleNotification): void
    {
        $jobClass = $googleNotification->jobClass();
        if (is_null($jobClass)) {
            throw new Exception("Could not handle google notification {$googleNotification->id}");
        }
        $jobClass::dispatch($googleNotification);
    }

    private function calculateNotificationType(array $data): string
    {
        if (Arr::has($data, 'subscriptionNotification.notificationType')) {
            $notificationType = Arr::get($data, 'subscriptionNotification.notificationType');
            return GoogleNotification::GOOGLE_SUBSCRIPTION_NOTIFICATION_TYPES[$notificationType];
        }
        if (Arr::has($data, 'oneTimeProductNotification')) {
            return 'oneTimeProductNotification';
        }
        if (Arr::has($data, 'testNotification')) {
            return 'testNotification';
        }
        return 'Unknown';
    }
}
