<?php

/**
 * Repository to abstract persistence of subscriptions billing services.
 */

namespace App\Repositories;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\StripeServiceException;
use Stripe\Exception\InvalidRequestException;
use App\Exceptions\InvalidValuesException;
use App\Contracts\Service\PaymentProcessingService as PaymentProcessingServiceContract;
use App\Contracts\Repository\SubscriptionRepository as SubscriptionRepositoryContract;

class Subscription implements SubscriptionRepositoryContract
{
    /**
     * Instance of PaymentProcessingService concrete implementation.
     *
     * @var object
     */
    private $paymentService;

    /**
     * Create a new repository instance.
     */
    public function __construct(PaymentProcessingServiceContract $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function plans(Request $request): array
    {
        try {
            return $this->paymentService->getPlans();
        } catch (Throwable $t) {
            Log::error($t->getMessage());
        }
    }

    public function create(Request $request): array
    {
        try {
            if (!empty($request->payment_method) && !empty($request->plan)) {
                return $this->paymentService->createSubscription($request);
            } else {
                throw new InvalidValuesException('Invalid parameters sent.');
            }
        } catch (InvalidRequestException $e) {
            throw new StripeServiceException($e->getMessage());
        } catch (Throwable $t) {
            Log::error($t->getMessage());

            throw $t;
        }
    }

    public function subscribedTo(Request $request): array
    {
        try {
            return [
                'subscribed' => $this->paymentService->isSubscribedTo($request),
            ];
        } catch (Throwable $t) {
            Log::error($t->getMessage());
        }
    }

    public function cancelSubscription(Request $request): array
    {
        try {
            $this->paymentService->cancelSubscription();

            return [];
        } catch (Throwable $t) {
            Log::error($t->getMessage());
        }
    }
}
