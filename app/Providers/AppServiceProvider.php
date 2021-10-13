<?php

namespace App\Providers;

use App\Services\Stripe as StripeService;
use App\Repositories\Subscription as SubscriptionRepository;
use App\Services\Subscription as SubscriptionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\Service\SubscriptionService', function () {
            return new SubscriptionService(new SubscriptionRepository(new StripeService));
        });
    }
}
