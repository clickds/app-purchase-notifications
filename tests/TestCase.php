<?php

namespace ClickDs\AppPurchaseNotifications\Tests;

use ClickDs\AppPurchaseNotifications\AppPurchaseNotificationsServiceProvider;
use ClickDs\AppPurchaseNotifications\Tests\Support\DummyAppleJob;
use ClickDs\AppPurchaseNotifications\Tests\Support\DummyGoogleJob;
use Illuminate\Support\Facades\Queue;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
        Queue::fake();
    }

    protected function getPackageProviders($app)
    {
        return [
            // Package providers here
            AppPurchaseNotificationsServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('app-purchase-notifications.apple', [
            'initial_buy' => DummyAppleJob::class,
            'cancel' => DummyAppleJob::class,
            'renewal' => DummyAppleJob::class,
            'interactive_renewal' => DummyAppleJob::class,
            'did_change_renewal_pref' => DummyAppleJob::class,
            'did_change_renewal_status' => DummyAppleJob::class,
            'did_fail_to_renew' => DummyAppleJob::class,
            'did_recover' => DummyAppleJob::class,
            'price_increase_consent' => DummyAppleJob::class,
        ]);

        $app['config']->set('app-purchase-notifications.google', [
            'subscription_recovered' => DummyGoogleJob::class,
            'subscription_renewed' => DummyGoogleJob::class,
            'subscription_cancelled' => DummyGoogleJob::class,
            'subscription_purchased' => DummyGoogleJob::class,
            'subscription_on_hold' => DummyGoogleJob::class,
            'subscription_in_grace_period' => DummyGoogleJob::class,
            'subscription_restarted' => DummyGoogleJob::class,
            'subscription_price_change_confirmed' => DummyGoogleJob::class,
            'subscription_deferred' => DummyGoogleJob::class,
            'subscription_paused' => DummyGoogleJob::class,
            'subscription_pause_schedule_changed' => DummyGoogleJob::class,
            'subscription_revoked' => DummyGoogleJob::class,
            'subscription_expired' => DummyGoogleJob::class,
        ]);
    }
}
