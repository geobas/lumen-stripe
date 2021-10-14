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
     * @OA\Get(
     *     path="/subscriptions/plans",
     *     summary="Get all available plans",
     *     operationId="all_plans",
     *     tags={"Subscriptions"},
     *
     *     @OA\Response(
     *         response="200",
     *         description="Return all available plans"
     *     ),
     * )
     */

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
     * @OA\Post(
     *     path="/subscriptions/create",
     *     summary="Create new subscription",
     *     operationId="create_subscription",
     *     tags={"Subscriptions"},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="payment_method",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="plan",
     *                     type="string"
     *                 ),
     *                 example={"payment_method": "pm_1Jk79BI5BO8N9pLMR0629QvU", 
     *                          "plan": "price_1JAY4eI5BO8N9pLMX2r6aCgj"}
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Create new subscription"
     *     ),
     *
     *     @OA\Response(
     *         response="400",
     *         description="Invalid input data"
     *     )
     * )
     */

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
     * @OA\Get(
     *     path="/subscriptions/user/plan/{planId}",
     *     summary="Check to see if User is subscribed to a specific plan",
     *     operationId="is_subscribed",
     *     tags={"Subscriptions"},
     *
     *     @OA\Parameter(
     *         name="planId",
     *         in="path",
     *         description="Plan ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="User is subscribed to a specific plan"
     *     )
     * )
     */

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
     * @OA\Get(
     *     path="/subscriptions/user/cancel/subscription",
     *     summary="Cancel a User subscription",
     *     operationId="cancel_subscription",
     *     tags={"Subscriptions"},
     *
     *     @OA\Response(
     *         response="200",
     *         description="Cancel a User subscription"
     *     ),
     *
     *     @OA\Response(
     *         response="404",
     *         description="No such subscription",
     *     )
     * )
     */

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
