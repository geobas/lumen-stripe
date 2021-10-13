<?php

/**
 * Contract to specify a set of service methods for online payment processing.
 */

namespace App\Contracts\Service;

use Illuminate\Http\Request;

interface PaymentProcessingService
{
    /**
     * Get all available subscription plans.
     *
     * @return array
     */
    public function getPlans(): array;

    /**
     * Create a new subscription.
     *
     * @return array
     */
    public function createSubscription(Request $request): array;

    /**
     * Check if User is subscribed to a specific plan.
     *
     * @return array
     */
    public function isSubscribedTo(Request $request): bool;

    /**
     * Cancel User's subscription.
     *
     * @return void
     */
    public function cancelSubscription(): void;
}
