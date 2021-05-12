<?php

namespace ClickDs\AppPurchaseNotifications\Tests\Feature\Google;

use ClickDs\AppPurchaseNotifications\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;

class SubscriptionPurchasedTest extends TestCase
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
    }

    private function makeRequest(array $payload): TestResponse
    {
        $url = route('webhooks.google.store');
        return $this->postJson($url, $payload);
    }

    private function payload(): array
    {
        return [
            'notificationType' => 4,
        ];
    }
}
