<?php

namespace ClickDs\AppPurchaseNotifications\Models;

use ClickDs\AppPurchaseNotifications\Database\Factories\AppleNotificationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppleNotification extends Model
{
    /**
     * An array of Apple Notification types => Job configuration name
     */
    public const NOTIFICATION_JOB_CONFIG = [
        'INITIAL_BUY' => 'apple_initial_buy',
        'CANCEL' => 'apple_cancel',
        'RENEWAL' => 'apple_renewal',
        'INTERACTIVE_RENEWAL' => 'apple_interactive_renewal',
        'DID_CHANGE_RENEWAL_PREF' => 'apple_did_change_renewal_pref',
        'DID_CHANGE_RENEWAL_STATUS' => 'apple_did_change_renewal_status',
        'DID_FAIL_TO_RENEW' => 'apple_did_fail_to_renew',
        'DID_RECOVER' => 'apple_did_recover',
        'PRICE_INCREASE_CONSENT' => 'apple_price_increase_consent',
    ];

    use HasFactory;

    protected static function newFactory()
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
}
