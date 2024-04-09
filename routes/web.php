<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Events\TransactionSuccessfull;
use App\Models\Collection;

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
    return "CreditMe";
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->get('{service}/status/{token}', 'ServiceController@transactionStatus');
    $router->get('balance', 'PaymentController@balance');
    $router->get('fetch-bundles/{provider}', 'ServiceController@fetchBundles');
    $router->get('fetch-providers/{service}', 'ServiceController@fetchProviders');
    $router->get('data/providers', 'DataController@getProviders');
    $router->get('airtime/providers', 'AirtimeController@getProviders');
    $router->get('data/bundles/{network}', 'DataController@getBundles');

    $router->group(['prefix' => 'get', 'middleware' => "auth:api"], function () use ($router) {
        $router->get("dashboard", "DashboardController@getDashboard");
        $router->get('banks', 'RestController@getBanks');
        $router->get('states', 'RestController@getStates');
        $router->get('lgas/{stateId}', 'RestController@getLocalGovts');
    });

    $router->group(["prefix" => "user"], function () use ($router) {
        $router->post('register', 'AuthController@registerUser');
        $router->post('login', 'AuthController@loginUser');
        $router->post("forgot/password", 'AuthController@forgotPassword');
        $router->post("reset/password", 'AuthController@resetPassword');
        $router->get('verify/email', 'AuthController@verifyUser');
        $router->get('verify/otp', 'AuthController@verifyOtp');
        $router->get('resend/email/verification', 'AuthController@resendVerificationCode');
        $router->post("update/password", ["middleware" => "auth", "uses" => 'AuthController@changePassword']);
        $router->get('logout', 'AuthController@logout');
    });

    $router->group(['prefix' => 'profile', 'middleware' => "auth:api"], function () use ($router) {
        $router->post('add', 'UserProfileController@addProfile');
        $router->put('update', 'UserProfileController@updateProfile');
        $router->get('{id}', 'UserProfileController@getProfile');
    });

    $router->group(['prefix' => 'business', 'middleware' => "auth:api"], function () use ($router) {
        $router->post('profile', 'BusinessController@addKycProfile');
        $router->put('profile/{id}', 'BusinessController@updateKycProfile');
        $router->get('profile/{id}', 'BusinessController@getProfile');
        // $router->post('verify/bvn', 'BusinessController@matchBVN');
        // $router->post('update/account', 'BusinessController@addAccountDetails');
        // $router->post('verify/account', 'BusinessController@verifyAccount');
        // $router->post('upgrade/kyc', ["middleware" => ["compliance", 'vendor'], "uses" => 'BusinessController@upgradeKycProfile']);
        // $router->post('update/profile', ["middleware" => ["compliance", "vendor"], "uses" => 'BusinessController@updateMerchantProfile']);
    });


    $router->group(['prefix' => 'user', "middleware" => "auth:api"], function () use ($router) {
        $router->group(['prefix' => 'wallet'], function () use ($router) {
            $router->get('fetch/{user_id}/', 'WalletController@fetchWallet');
            $router->get('balance/{user_id}', 'WalletController@balanceEnquiry');
            $router->post('create', 'WalletController@createWallet');
            $router->post('credit', 'WalletController@creditWallet');
            $router->post('debit', 'WalletController@chargeWallet');
            $router->post('histories', 'WalletController@getHistories');
        });

        $router->group(['prefix' => 'data'], function () use ($router) {
            $router->post('create', 'DataController@createUserTransaction');
            $router->post('purchase', 'DataController@purchaseUserTransaction');
            $router->get('history', 'DataController@getHistories');
        });

        $router->group(['prefix' => 'airtime'], function () use ($router) {
            $router->get('providers', 'AirtimeController@getProviders');
            $router->post('create', 'AirtimeController@createUserTransaction');
            $router->post('purchase', 'AirtimeController@purchaseUserTransaction');
            $router->get('history', 'AirtimeController@getHistories');
        });
    });
    
    $router->group(['prefix' => 'collection'], function () use ($router) {
        $router->group(['middleware' => ["auth:api"]], function () use ($router) {
            $router->post('initiate', 'CollectionController@initiateCollection');
            $router->post('verify', 'CollectionController@transactionStatus');
            $router->get('histories', 'CollectionController@getHistories');
            $router->get('/banks', 'CollectionController@getBanks');
        });
        $router->get('verify/{reference}', 'CollectionController@getLinkInfo');
    });
    
    $router->group(["prefix" => "payment_link"], function () use ($router) {
        $router->group(['middleware' => ["auth:api"]], function () use ($router) {
            $router->post('generate', 'PaymentLinkController@generatePaymentLink');
            $router->get('verify/{reference}', 'PaymentLinkController@getLinkInfo');
        });
    });




    $router->group(['prefix' => 'visitor'], function () use ($router) {
        $router->group(['prefix' => 'data'], function () use ($router) {
            $router->post('create', 'DataController@create');
            $router->post('purchase', 'DataController@purchase');
            $router->get('history', 'DataController@getHistories');
        });

        $router->group(['prefix' => 'transfer'], function () use ($router) {
            $router->get('providers', 'TransferController@getProviders');
            $router->post('create', 'TransferController@create');
            $router->post('purchase', 'TransferController@purchase');
            $router->get('history', 'TransferController@getHistories');
        });

        $router->group(['prefix' => 'airtime'], function () use ($router) {
            $router->post('create', 'AirtimeController@create');
            $router->post('purchase', 'AirtimeController@purchase');
            $router->get('history', 'AirtimeController@getHistories');
        });
    });





    $router->group([
        'prefix' => 'settlement',
        'middleware' => ["role:merchant", "compliance"]
    ], function () use ($router) {
        $router->get('get/histories', 'SettlementController@getHistories');
        $router->get('get/transactions/{id}', 'SettlementController@settlementTransactions');
    });

    $router->group(['prefix' => 'transaction'], function () use ($router) {
        // $router->group(['middleware' => "compliance"], function () use ($router) {
            $router->get('histories', 'TransactionController@getHistories');
            $router->post('initiate', 'TransactionController@initiateTransaction');
            $router->post('verify', 'TransactionController@transactionStatus');
        // });
        $router->get('banks', 'TransactionController@getBanks');
    });

    $router->group(['prefix' => 'auto'], function () use ($router) {
        $router->post('transaction/complete', 'TransactionController@completeCallback');
    });

    $router->get('test_event/{reference}', function ($reference) {
        $transaction = Collection::where("transaction_reference", $reference)->first();
        if ($transaction) {
            // event(new TransactionSuccessfull($transaction));
            return "successfull";
        }
        return "transaction not found";
    });
});
