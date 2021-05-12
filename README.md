# Relevant Documentation
## Apple
https://developer.apple.com/documentation/appstoreservernotifications

## Google
https://developer.android.com/google/play/billing/rtdn-reference
https://developer.android.com/google/play/developer-api.html#subscriptions_api_overview
http://googleapis.github.io/google-cloud-php/#/
https://github.com/googleapis/google-api-php-client/issues/1529
https://github.com/googleapis/google-api-php-client-services/tree/master/src/Google/Service/AndroidPublisher
https://developers.google.com/android-publisher/api-ref/rest

# Useful Resources
[Laravel Package](https://laravelpackage.com)
[Laravel Docs](https://laravel.com/docs/8.x/packages)

# Publishing config
```sh
php artisan vendor:publish --provider="ClickDs\AppPurchaseNotifications\AppPurchaseNotificationsServiceProvider" --tag="config"
```