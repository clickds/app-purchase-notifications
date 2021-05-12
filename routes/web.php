<?php

use Illuminate\Support\Facades\Route;
use ClickDs\AppPurchaseNotifications\Http\Controllers\AppleWebhooksController;
use ClickDs\AppPurchaseNotifications\Http\Controllers\GoogleWebhooksController;

Route::group([
    'prefix' => 'webhooks',
    'as' => 'webhooks.'
], function ($router) {
    $router->post('apple', [AppleWebhooksController::class, 'store'])->name('apple.store');
    $router->post('google', [GoogleWebhooksController::class, 'store'])->name('google.store');
});
