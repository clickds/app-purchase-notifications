<?php

namespace ClickDs\AppPurchaseNotifications\Database\Factories;

use ClickDs\AppPurchaseNotifications\Models\GoogleNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoogleNotificationFactory extends Factory
{
    protected $model = GoogleNotification::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(array_keys(GoogleNotification::GOOGLE_SUBSCRIPTION_NOTIFICATION_TYPES)),
            'payload' => $this->payload(),
        ];
    }

    private function payload(): array
    {
        return json_decode(
            '{
                "version":"1.0",
                "packageName":"com.some.thing",
                "eventTimeMillis":"1503349566168",
                "subscriptionNotification":
                {
                    "version":"1.0",
                    "notificationType":4,
                    "purchaseToken":"PURCHASE_TOKEN",
                    "subscriptionId":"my.sku"
                }
            }',
            true
        );
    }
}
