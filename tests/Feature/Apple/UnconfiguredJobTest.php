<?php

namespace ClickDs\AppPurchaseNotifications\Tests\Feature\Apple;

use ClickDs\AppPurchaseNotifications\Models\AppleNotification;
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
        $app['config']->set('apple', [
            'initial_buy' => null,
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
