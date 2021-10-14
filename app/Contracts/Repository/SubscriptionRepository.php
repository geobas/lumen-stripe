<?php

/**
 * Contract to specify a set of repository methods for subscription billing services.
 */

namespace App\Contracts\Repository;

use Illuminate\Http\Request;

interface SubscriptionRepository
{
    /**
     * Return all available subscription plans.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function plans(Request $request): array;

    /**
     * Create subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     * @throws \App\Exceptions\StripeServiceException
     * @throws \App\Exceptions\InvalidValuesException
     */
    public function create(Request $request): array;

    /**
     * Check if User is subscribed to a specific plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function subscribedTo(Request $request): array;

    /**
     * Cancel User's subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     * @throws \App\Exceptions\SubscriptionNotFound
     */
    public function cancelSubscription(Request $request): array;
}
