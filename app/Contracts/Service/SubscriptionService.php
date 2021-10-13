<?php

/**
 * Contract to specify a set of service methods for subscription billing services.
 */

namespace App\Contracts\Service;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface SubscriptionService
{
    /**
     * Return all available subscription plans.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function plans(Request $request): JsonResponse;

    /**
     * Create subscription for registered User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): JsonResponse;

    /**
     * Check if User is subscribed to a specific plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribedTo(Request $request): JsonResponse;

    /**
     * Cancel User's subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelSubscription(Request $request): JsonResponse;
}
