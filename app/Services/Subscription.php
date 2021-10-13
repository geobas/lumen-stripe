<?php

/**
 * Service to abstract retrieval & persistence logic of subscription billing.
 */

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\HttpStatus as Status;
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
        return response()->api([
            'status' => Status::OK,
            'data' => $this->repository->plans($request),
        ], Status::OK);
    }

    public function create(Request $request): JsonResponse
    {
        return response()->api([
            'status' => Status::OK,
            'data' => $this->repository->create($request),
        ], Status::OK);
    }

    public function subscribedTo(Request $request): JsonResponse
    {
        return response()->api([
            'status' => Status::OK,
            'data' => $this->repository->subscribedTo($request),
        ], Status::OK);
    }

    public function cancelSubscription(Request $request): JsonResponse
    {
        return response()->api([
            'status' => Status::OK,
            'data' => $this->repository->cancelSubscription($request),
        ], Status::OK);
    }
}
