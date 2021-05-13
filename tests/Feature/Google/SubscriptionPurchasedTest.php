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
        $payload = $this->payload();

        $response = $this->makeRequest($payload);

        $response->assertSuccessful();
        Queue::assertPushed(DummyGoogleJob::class);
    }

    public function test_stores_notification_payload(): void
    {
        $payload = $this->payload();

        $response = $this->makeRequest($payload);

        $response->assertSuccessful();
        $this->assertDatabaseCount('google_notifications', 1);
    }

    private function makeRequest(array $payload): TestResponse
    {
        $url = route('webhooks.google.store');
        return $this->postJson($url, $payload);
    }

    private function payload(): array
    {
        $data = GoogleNotification::factory()->definition();
        $data['subscriptionNotification']['notificationType'] = 4;
        return $data;
    }
}
