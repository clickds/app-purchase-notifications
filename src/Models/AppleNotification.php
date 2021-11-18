<?php

namespace ClickDs\AppPurchaseNotifications\Models;

use ClickDs\AppPurchaseNotifications\Database\Factories\AppleNotificationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppleNotification extends Model
{
    use HasFactory;

    /**
     * An array of Apple Notification types => Job configuration name
     *
     * https://developer.apple.com/documentation/appstoreservernotifications/notification_type
     */
    public const NOTIFICATION_JOB_CONFIG = [
        'CANCEL' => 'cancel',
        'CONSUMPTION_REQUEST' => 'consumption_request',
        'DID_CHANGE_RENEWAL_PREF' => 'did_change_renewal_pref',
        'DID_CHANGE_RENEWAL_STATUS' => 'did_change_renewal_status',
        'DID_FAIL_TO_RENEW' => 'did_fail_to_renew',
        'DID_RECOVER' => 'did_recover',
        'DID_RENEW' => 'did_renew',
        'INITIAL_BUY' => 'initial_buy',
        'INTERACTIVE_RENEWAL' => 'interactive_renewal',
        'PRICE_INCREASE_CONSENT' => 'price_increase_consent',
        'REFUND' => 'refund',
        'REVOKE' => 'revoke',
    ];

    /**
     * @return AppleNotificationFactory
     */
    protected static function newFactory(): AppleNotificationFactory
    {
        return AppleNotificationFactory::new();
    }

    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'payload' => 'array',
    ];

    /**
     * @return string|null
     */
    public function jobClass(): ?string
    {
        $jobKey = static::NOTIFICATION_JOB_CONFIG[$this->type] ?? null;

        if (is_null($jobKey)) {
            return null;
        }

        $key = 'app-purchase-notifications.apple.' . $jobKey;

        return config($key, null);
    }
}
