<?php

namespace ClickDs\AppPurchaseNotifications\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppleWebhooksController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        return new JsonResponse(null, 204);
    }
}