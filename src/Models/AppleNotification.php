<?php

namespace ClickDs\AppPurchaseNotifications\Models;

use ClickDs\AppPurchaseNotifications\Database\Factories\AppleNotificationFactory;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppleNotification extends Model
{
    /**
     * An array of Apple Notification types => Job configuration name
     */
    public const NOTIFICATION_JOB_CONFIG = [
        'INITIAL_BUY' => 'initial_buy',
        'CANCEL' => 'cancel',
        'RENEWAL' => 'renewal',
        'INTERACTIVE_RENEWAL' => 'interactive_renewal',
        'DID_CHANGE_RENEWAL_PREF' => 'did_change_renewal_pref',
        'DID_CHANGE_RENEWAL_STATUS' => 'did_change_renewal_status',
        'DID_FAIL_TO_RENEW' => 'did_fail_to_renew',
        'DID_RECOVER' => 'did_recover',
        'PRICE_INCREASE_CONSENT' => 'price_increase_consent',
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

    public function jobClass(): ?string
    {
        $jobKey = static::NOTIFICATION_JOB_CONFIG[$this->type];
        if (is_null($jobKey)) {
            return null;
        }
        $key = 'app-purchase-notifications.apple.' . $jobKey;
        return config($key, null);
    }
}
