<?php

/**
 * Service to abstract retrieval & persistence logic of subscription billing.
 */

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Contracts\Service\SubscriptionService as SubscriptionServiceContract;
use App\Contracts\Repository\SubscriptionRepository as SubscriptionRepositoryContract;

class Subscription implements SubscriptionServiceContract
{
    /**
     * Repository instance.
     *
     * @var object
     */
    protected $repository;

    /**
     * Create a new service instance.
     *
     * @param \App\Contracts\Repository\SubscriptionRepository  $subscriptionRepository
     */
    public function __construct(SubscriptionRepositoryContract $subscriptionRepository)
    {
        $this->repository = $subscriptionRepository;
    }

    public function plans(Request $request): JsonResponse
    {
        return $this->repository->plans($request);
    }

    public function create(Request $request): JsonResponse
    {
        return $this->repository->create($request);
    }

    public function subscribedTo(Request $request): JsonResponse
    {
        return $this->repository->subscribedTo($request);
    }

    public function cancelSubscription(Request $request): JsonResponse
    {
        return $this->repository->cancelSubscription($request);
    }
}
