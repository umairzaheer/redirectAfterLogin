<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\BillingController;

Route::middleware(['verify.shopify'])->group(function () {
    Route::get('/', [RuleController::class, 'billingPlan'])->name('home');
    Route::get('settings', [RuleController::class, 'index'])->name('settings');
    Route::get('/get-all-customers-login', [RuleController::class, 'getAllCustomersTags']); 
    Route::get('/get-all-products', [RuleController::class, 'getAllProducts']);
    Route::post('save-login', [RuleController::class, 'store']);
    Route::get('edit-login/{id}', [RuleController::class, 'edit']); 
    Route::post('update-login/{id}', [RuleController::class, 'update']); 
    Route::delete('delete-login-rule/{id}', [RuleController::class, 'destroy']);
    Route::get('/pagination', [RuleController::class, 'pagination']);

    Route::get('/first-login-record', [RuleController::class, 'loginData']);
    Route::get('/first-logout-record', [RuleController::class, 'logoutData']);
    Route::get('/first-registration-record', [RuleController::class, 'registrationData']);

     //billing plans
    Route::get('plans',[BillingController::class, 'index'])->name('billing.index');
    Route::get('changeplan{plan}', [BillingController::class, 'billingPlan'])->name('change.plan');

    //user guide
    Route::get('/user-guide',function () {
        return view('userguide.index');
    })->name('guide.index');

     //installation guide
     Route::get('/installation-guide',function () {
        return view('installationguide.index');
      })->name('installationGuide.index');
});

