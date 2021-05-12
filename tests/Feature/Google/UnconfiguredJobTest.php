<?php

namespace ClickDs\AppPurchaseNotifications\Tests\Feature\Google;

use ClickDs\AppPurchaseNotifications\Models\GoogleNotification;
use ClickDs\AppPurchaseNotifications\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Testing\TestResponse;

class UnconfiguredJobTest extends TestCase
{
    use RefreshDatabase;

    protected function defineEnvironment($app)
    {
        $app['config']->set('google', [
            'subscription_purchased' => null,
        ]);
    }

    public function test_dispatches_configured_job(): void
    {
        Log::shouldReceive('error')->once();
        $payload = $this->payload();

        $response = $this->makeRequest($payload);

        $response->assertStatus(501);
        Queue::assertNothingPushed();
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
