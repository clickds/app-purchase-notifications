<?php

namespace ClickDs\AppPurchaseNotifications\Tests\Feature\Apple;

use ClickDs\AppPurchaseNotifications\Models\AppleNotification;
use ClickDs\AppPurchaseNotifications\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;

class InitialBuyTest extends TestCase
{
    use RefreshDatabase;

    public function test_dispatches_configured_job(): void
    {
        $this->markTestIncomplete();
    }

    public function test_stores_notification_payload(): void
    {
        $payload = $this->payload();

        $response = $this->makeRequest($payload);

        $response->assertSuccessful();
        $this->assertDatabaseCount('apple_notifications', 1);
    }

    private function makeRequest(array $payload): TestResponse
    {
        $url = route('webhooks.apple.store');
        return $this->postJson($url, $payload);
    }

    private function payload(): array
    {
        $data = AppleNotification::factory()->definition();
        $data['notification_type'] = 'INITIAL_BUY';
        return $data;
    }
}
