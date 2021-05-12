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
        'SUBSCRIPTION_RECOVERED' => 'google_subscription_recovered',
        'SUBSCRIPTION_RENEWED' => 'google_subscription_renewed',
        'SUBSCRIPTION_CANCELED' => 'google_subscription_cancelled',
        'SUBSCRIPTION_PURCHASED' => 'google_subscription_purchased',
        'SUBSCRIPTION_ON_HOLD' => 'google_subscription_on_hold',
        'SUBSCRIPTION_IN_GRACE_PERIOD' => 'google_subscription_in_grace_period',
        'SUBSCRIPTION_RESTARTED' => 'google_subscription_restarted',
        'SUBSCRIPTION_PRICE_CHANGE_CONFIRMED' => 'google_subscription_price_change_confirmed',
        'SUBSCRIPTION_DEFERRED' => 'google_subscription_deferred',
        'SUBSCRIPTION_PAUSED' => 'google_subscription_paused',
        'SUBSCRIPTION_PAUSE_SCHEDULE_CHANGED' => 'google_subscription_pause_schedule_changed',
        'SUBSCRIPTION_REVOKED' => 'google_subscription_revoked',
        'SUBSCRIPTION_EXPIRED' => 'google_subscription_expired',
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
}
