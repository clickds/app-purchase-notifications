<?php

namespace ClickDs\AppPurchaseNotifications\Models;

use ClickDs\AppPurchaseNotifications\Database\Factories\GoogleNotificationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleNotification extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return GoogleNotificationFactory::new();
    }

    /**
     * https://developer.android.com/google/play/billing/rtdn-reference#sub-example
     *
     * Google sends an int as notification type
     */
    public const GOOGLE_SUBSCRIPTION_NOTIFICATION_TYPES = [
        1 => 'SUBSCRIPTION_RECOVERED',
        2 => 'SUBSCRIPTION_RENEWED',
        3 => 'SUBSCRIPTION_CANCELED',
        4 => 'SUBSCRIPTION_PURCHASED',
        5 => 'SUBSCRIPTION_ON_HOLD',
        6 => 'SUBSCRIPTION_IN_GRACE_PERIOD',
        7 => 'SUBSCRIPTION_RESTARTED',
        8 => 'SUBSCRIPTION_PRICE_CHANGE_CONFIRMED',
        9 => 'SUBSCRIPTION_DEFERRED',
        10 => 'SUBSCRIPTION_PAUSED',
        11 => 'SUBSCRIPTION_PAUSE_SCHEDULE_CHANGED',
        12 => 'SUBSCRIPTION_REVOKED',
        13 => 'SUBSCRIPTION_EXPIRED',
    ];

    /**
     * An array of google notification type => job config name
     */
    public const SUBSCRIPTION_NOTIFICATION_JOB_CONFIG = [
        'SUBSCRIPTION_RECOVERED' => 'subscription_recovered',
        'SUBSCRIPTION_RENEWED' => 'subscription_renewed',
        'SUBSCRIPTION_CANCELED' => 'subscription_cancelled',
        'SUBSCRIPTION_PURCHASED' => 'subscription_purchased',
        'SUBSCRIPTION_ON_HOLD' => 'subscription_on_hold',
        'SUBSCRIPTION_IN_GRACE_PERIOD' => 'subscription_in_grace_period',
        'SUBSCRIPTION_RESTARTED' => 'subscription_restarted',
        'SUBSCRIPTION_PRICE_CHANGE_CONFIRMED' => 'subscription_price_change_confirmed',
        'SUBSCRIPTION_DEFERRED' => 'subscription_deferred',
        'SUBSCRIPTION_PAUSED' => 'subscription_paused',
        'SUBSCRIPTION_PAUSE_SCHEDULE_CHANGED' => 'subscription_pause_schedule_changed',
        'SUBSCRIPTION_REVOKED' => 'subscription_revoked',
        'SUBSCRIPTION_EXPIRED' => 'subscription_expired',
    ];

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

    public function jobClass(): ?string
    {
        $jobKey = $this->jobKey();
        if (is_null($jobKey)) {
            return null;
        }
        $key = 'app-purchase-notifications.google.' . $jobKey;
        return config($key, null);
    }

    private function jobKey(): ?string
    {
        if (array_key_exists($this->type, static::SUBSCRIPTION_NOTIFICATION_JOB_CONFIG)) {
            return static::SUBSCRIPTION_NOTIFICATION_JOB_CONFIG[$this->type];
        }
        return null;
    }
}
