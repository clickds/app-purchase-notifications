<?php

namespace ClickDs\AppPurchaseNotifications\Database\Factories;

use ClickDs\AppPurchaseNotifications\Models\AppleNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppleNotificationFactory extends Factory
{
    protected $model = AppleNotification::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(array_keys(AppleNotification::NOTIFICATION_JOB_CONFIG)),
            'payload' => $this->payload(),
        ];
    }

    private function payload(): array
    {
        return json_decode(
            '{
                "environment": "Sandbox",
                "notification_type": "INITIAL_BUY",
                "password": "TEST_SHARED_SECRET",
                "cancellation_date": "2018-03-27 07:11:12 Etc/GMT",
                "cancellation_date_pst": "2018-03-27 00:11:12 America/Los_Angeles",
                "cancellation_date_ms": "1522134672000",
                "web_order_line_item_id": "1000000047417113",
                "latest_receipt": "BASE64ENCODED_RECEIPT_INFO",
                "latest_receipt_info": {},
                "latest_expired_receipt" : "BASE64ENCODED_LATEST_RECEIPT_INFO",
                "latest_expired_receipt_info": {
                    "purchase_date_ms": "1521893342000",
                    "original_transaction_id": "1000000577061006",
                    "web_order_line_item_id": "1000000047417113",
                    "product_id": "PRODUCT_ID",
                    "purchase_date": "2018-03-24 12:09:02 Etc/GMT",
                    "purchase_date_pst": "2018-03-24 05:09:02 America/Los_Angeles",
                    "original_purchase_date": "2018-03-17 12:09:03 Etc/GMT",
                    "original_purchase_date_ms": "1521288543000",
                    "original_purchase_date_pst": "2018-03-17 05:09:03 America/Los_Angeles",
                    "cancellation_reason": "0",
                    "cancellation_date": "2018-03-27 07:11:12 Etc/GMT",
                    "cancellation_date_ms": "1522134672000",
                    "cancellation_date_pst": "2018-03-27 00:11:12 America/Los_Angeles",
                    "expires_date": "2019-10-09 07:43:26 Etc/GMT",
                    "expires_date_ms": "1570607006000",
                    "expires_date_formatted": "2019-03-24 12:09:02 Etc/GMT",
                    "expires_date_formatted_pst": "2019-03-24 05:09:02 America/Los_Angeles",
                    "quantity": "1",
                    "unique_identifier": "UNIQUE_IDENTIFIER",
                    "unique_vendor_identifier": "UNIQUE_VENDOR_IDENTIFIER",
                    "is_in_intro_offer_period": "false",
                    "is_trial_period": "false",
                    "item_id": "ITEM_ID",
                    "app_item_id": "APP_ITEM_ID",
                    "version_external_identifier": "VERSION_EXTERNAL_IDENTIFIER",
                    "transaction_id": "1000000577069202",
                    "bvrs": "2",
                    "bid": "com.example.app.ios"
                },
                "auto_renew_status": "false",
                "auto_renew_product_id": "PRODUCT_ID",
                "auto_renew_status_change_date": "",
                "auto_renew_status_change_date_pst": "",
                "auto_renew_status_change_date_ms": "",
                "pending_renewal_info": [
                    {
                        "auto_renew_product_id": "PRODUCT_ID",
                        "auto_renew_status": "1",
                        "expiration_intent": "",
                        "original_transaction_id": "1000000577061006",
                        "is_in_billing_retry_period": "1",
                        "product_id": "PRODUCT_ID",
                        "price_consent_status": "0",
                        "grace_period_expires_date": "",
                        "grace_period_expires_date_ms": "",
                        "grace_period_expires_date_pst": ""
                    }
                ]
            }',
            true
        );
    }
}
