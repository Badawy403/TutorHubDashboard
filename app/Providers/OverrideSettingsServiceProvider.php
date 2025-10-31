<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
class OverrideSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
          if (File::exists(storage_path('installed'))) {
            $settings = generalSettings();
     
// ✅ Pusher settings
if (!empty($settings['pusher_app_id'] ?? null)) {
    Config::set('broadcasting.connections.pusher.app_id', $settings['pusher_app_id']);
}
if (!empty($settings['pusher_app_secret'] ?? null)) {
    Config::set('broadcasting.connections.pusher.secret', $settings['pusher_app_secret']);
}
if (!empty($settings['pusher_app_key'] ?? null)) {
    Config::set('broadcasting.connections.pusher.key', $settings['pusher_app_key']);
}
if (!empty($settings['pusher_app_cluster'] ?? null)) {
    Config::set('broadcasting.connections.pusher.options.host', "api-{$settings['pusher_app_cluster']}.pusher.com");
}

// ✅ Stripe
if (!empty($settings['stripe_key'] ?? null)) {
    Config::set('cashier.key', $settings['stripe_key']);
}
if (!empty($settings['stripe_secret'] ?? null)) {
    Config::set('cashier.secret', $settings['stripe_secret']);
}

// ✅ Google & Facebook OAuth
if (!empty($settings['google_client_id'] ?? null)) {
    Config::set('services.google.client_id', $settings['google_client_id']);
}
if (!empty($settings['google_client_secret'] ?? null)) {
    Config::set('services.google.client_secret', $settings['google_client_secret']);
}
if (!empty($settings['facebook_client_id'] ?? null)) {
    Config::set('services.facebook.client_id', $settings['facebook_client_id']);
}
if (!empty($settings['facebook_client_secret'] ?? null)) {
    Config::set('services.facebook.client_secret', $settings['facebook_client_secret']);
}

// ✅ Mail settings
if (!empty($settings['mail_driver'] ?? null)) {
    Config::set('mail.mailers.smtp.transport', $settings['mail_driver']);
}
if (!empty($settings['mail_host'] ?? null)) {
    Config::set('mail.mailers.smtp.host', $settings['mail_host']);
}
if (!empty($settings['mail_port'] ?? null)) {
    Config::set('mail.mailers.smtp.port', $settings['mail_port']);
}
if (!empty($settings['mail_username'] ?? null)) {
    Config::set('mail.mailers.smtp.username', $settings['mail_username']);
}
if (!empty($settings['mail_password'] ?? null)) {
    Config::set('mail.mailers.smtp.password', $settings['mail_password']);
}
if (!empty($settings['mail_encryption'] ?? null)) {
    Config::set('mail.mailers.smtp.encryption', $settings['mail_encryption']);
}
        }

    }
}
