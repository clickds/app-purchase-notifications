<?php

namespace ClickDs\AppPurchaseNotifications\Tests;

use ClickDs\AppPurchaseNotifications\AppPurchaseNotificationsServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            // Package providers here
            AppPurchaseNotificationsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
