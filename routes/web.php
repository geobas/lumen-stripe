<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*********************** Routes for Subscription Billing ***********************/
$router->get('subscriptions/plans', [
    'as' => 'subscriptions.plans', 'uses' => 'SubscriptionController@plans',
]);

$router->post('subscriptions/create', [
    'as' => 'subscriptions.create', 'uses' => 'SubscriptionController@create',
]);

$router->get('subscriptions/user/plan/{planId}', [
    'as' => 'subscriptions.user.plan', 'uses' => 'SubscriptionController@subscribedTo',
]);

$router->get('subscriptions/user/cancel/subscription', [
    'as' => 'subscriptions.user.cancel.subscription', 'uses' => 'SubscriptionController@cancelSubscription',
]);
