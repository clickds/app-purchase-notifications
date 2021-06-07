<?php

namespace ClickDs\AppPurchaseNotifications\Tests\Feature\Google;

use ClickDs\AppPurchaseNotifications\Models\GoogleNotification;
use ClickDs\AppPurchaseNotifications\Tests\Support\DummyGoogleJob;
use ClickDs\AppPurchaseNotifications\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Testing\TestResponse;

class SubscriptionPurchasedTest extends TestCase
{
    use RefreshDatabase;

    public function test_dispatches_configured_job(): void
    {
        $response = $this->makeRequest();

        $response->assertSuccessful();
        Queue::assertPushed(DummyGoogleJob::class);
    }

    public function test_stores_notification_payload(): void
    {
        $response = $this->makeRequest();

        $response->assertSuccessful();
        $this->assertDatabaseCount('google_notifications', 1);
        $this->assertDatabaseHas('google_notifications', [
            'type' => 'SUBSCRIPTION_PURCHASED',
            'payload' => json_encode($this->payloadData()),
        ]);
    }

    private function makeRequest(): TestResponse
    {
        $url = route('webhooks.google.store');
        $data = $this->requestData();
        return $this->postJson($url, $data);
    }

    private function payloadData(): array
    {
        return [
            "version" => "1.0",
            "packageName" => "com.app",
            "eventTimeMillis" => "1622627834177",
            "subscriptionNotification" => [
                "version" => "1.0",
                "notificationType" => 4,
                "purchaseToken" => "some-purchase-token",
                "subscriptionId" => 'com.app.subs.premium.monthly',
            ]
        ];
    }

    private function requestData(): array
    {
        $payloadData = $this->payloadData();

        $jsonPayload = json_encode($payloadData);
        $encodedData = base64_encode($jsonPayload);

        $data = [
            "message" => [
                "data" => $encodedData,
                "messageId" => "123",
                "publishTime" => "2021-06-02T09:57:14.811Z"
            ],
            "subscription" => "projects/project-id/subscriptions/purchase-notifications-subscription"
        ];
        return $data;
    }
}
