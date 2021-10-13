<?php

/**
 * Service to handle operations with Stripe's online payment processing.
 */

namespace App\Services;

use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Contracts\Service\PaymentProcessingService as PaymentProcessingContact;

class Stripe implements PaymentProcessingContact
{
    /**
     * Instance of logged-in User.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        $this->user = auth()->user();

        config(['cashier.secret' => config('app.stripe_secret')]);
    }

    public function getPlans(): array
    {
        $stripe = new StripeClient(config('app.stripe_secret'));

        $freePlan = $this->getFreePlan($stripe);

        $paidPlans = $this->getPaidPlans($stripe);

        $paidPlans[] = $freePlan;

        return [
            'plans' => array_reverse($paidPlans),
            'intent' => $this->user->createSetupIntent(),
        ]
        ?? [];
    }

    public function createSubscription(Request $request): array
    {
        $this->user->createOrGetStripeCustomer();

        $this->user->addPaymentMethod($request->payment_method);

        $subscription = $this->user->newSubscription('default', $request->plan)
             ->create($request->payment_method, [
                'email' => $this->user->username,
             ]);

        if (!empty($subscription)) {
            return [
                'user' => $this->user->name,
                'email' => $this->user->username,
                'name' => $subscription->name,
                'stripe_id' => $subscription->stripe_id,
                'stripe_status' => $subscription->stripe_status,
                'stripe_price' => $subscription->stripe_price,
                'quantity' => $subscription->quantity,
                'ends_at' => $subscription->ends_at,
            ];
        } else {
            return [];
        }
    }

    public function isSubscribedTo(Request $request): bool
    {
        return $this->user->subscribedToProduct($request->planId);
    }

    public function cancelSubscription(): void
    {
        $this->user->subscription('default')->cancelNow();
    }

    /**
     * Get free Stripe plan.
     *
     * @param  \Stripe\StripeClient  $stripe
     * @return array
     */
    private function getFreePlan(StripeClient $stripe): array
    {
        $freePlan = array_pop($stripe->products->all()->data);

        return [
            'id' => $freePlan->id,
            'name' => $freePlan->name,
            'price' => 0,
            'currency' => null,
            'billing_period' => null,
        ];
    }

    /**
     * Get paid Stripe plans.
     *
     * @param  \Stripe\StripeClient  $stripe
     * @return array
     */
    private function getPaidPlans(StripeClient $stripe): array
    {
        $paidPlans = $stripe->plans->all()->data;

        foreach ($paidPlans as $plan) {
            $prod = $stripe->products->retrieve(
               $plan->product, []
            );
            $plan->product = $prod;
        }

        $plans = [];

        foreach ($paidPlans as $paidPlan) {
            $plans[] = [
                'product_id' => $paidPlan->product->id,
                'payment_id' => $paidPlan->id,
                'name' => $paidPlan->product->name,
                'price' => number_format($paidPlan->amount / 100, 2, '.', ' '),
                'currency' => $paidPlan->currency,
                'billing_period' => $paidPlan->interval,
            ];
        }

        return $plans;
    }
}
