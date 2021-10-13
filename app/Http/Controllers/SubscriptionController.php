<?php

/**
 * Controller to handle subscription's billing services.
 */

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Contracts\Service\SubscriptionService as SubscriptionServiceContract;

class SubscriptionController extends Controller
{
    /**
     * Subscription service instance.
     *
     * @var \App\Services\Subscription
     */
    protected $subscriptionService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Contracts\Service\SubscriptionService  $subscriptionService
     */
    public function __construct(SubscriptionServiceContract $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Return all plans.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function plans(Request $request): JsonResponse
    {
        try {
            return $this->subscriptionService->plans($request);
        } catch (Throwable $t) {
            $this->logError($t);
        }
    }

    /**
     * Create subscription for registered User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            return $this->subscriptionService->create($request);
        } catch (Throwable $t) {
            $this->logError($t);
        }
    }

    /**
     * Check if User is subscribed to a specific plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribedTo(Request $request): JsonResponse
    {
        try {
            return $this->subscriptionService->subscribedTo($request);
        } catch (Throwable $t) {
            $this->logError($t);
        }
    }

    /**
     * Cancel User's subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelSubscription(Request $request): JsonResponse
    {
        try {
            return $this->subscriptionService->cancelSubscription($request);
        } catch (Throwable $t) {
            $this->logError($t);
        }
    }
}
