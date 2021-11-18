<?php

namespace ClickDs\AppPurchaseNotifications\Http\Controllers;

use ClickDs\AppPurchaseNotifications\Models\AppleNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AppleWebhooksController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $notification = AppleNotification::create([
            'type' => $request->input('notification_type'),
            'payload' => $request->all(),
        ]);

        try {
            $this->dispatchJob($notification);

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $exception) {
            Log::error($exception);

            return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    /**
     * @param AppleNotification $appleNotification
     *
     * @throws Exception
     */
    private function dispatchJob(AppleNotification $appleNotification): void
    {
        $jobClass = $appleNotification->jobClass();

        if (is_null($jobClass)) {
            throw new Exception("Could not handle apple notification {$appleNotification->id}");
        }

        $jobClass::dispatch($appleNotification)->delay(now()->addSeconds(5));
    }
}
