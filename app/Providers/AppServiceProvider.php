<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use URL;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        VerifyEmail::toMailUsing(function ($notifiable) {
              $verifyUrl = URL::temporarySignedRoute(
                  'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
              );

              return (new MailMessage)
                  ->subject('Email Verification!')
                  ->markdown('site.emails.verify', ['url' => $verifyUrl]);
          });
    }
}
