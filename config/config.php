<?php
return [
    /**
     * Apple App Store Notifications
     */
    'apple' => [
        'cancel' => null,
        'consumption_request' => null,
        'did_change_renewal_pref' => null,
        'did_change_renewal_status' => null,
        'did_fail_to_renew' => null,
        'did_renew' => null,
        'did_recover' => null,
        'initial_buy' => null,
        'refund' => null,
        'revoke' => null,
        'interactive_renewal' => null,
        'price_increase_consent' => null,
    ],

    /**
     * Google App Store Notifications
     */
    'google' => [
        'subscription_recovered' => null,
        'subscription_renewed' => null,
        'subscription_cancelled' => null,
        'subscription_purchased' => null,
        'subscription_on_hold' => null,
        'subscription_in_grace_period' => null,
        'subscription_restarted' => null,
        'subscription_price_change_confirmed' => null,
        'subscription_deferred' => null,
        'subscription_paused' => null,
        'subscription_pause_schedule_changed' => null,
        'subscription_revoked' => null,
        'subscription_expired' => null,
    ],
];
