<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::get('/users/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');
Route::post('/users/profile/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.profile.update');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::get('/users/view/{id}', [App\Http\Controllers\UserController::class, 'view'])->name('users.view');

Route::get('/parking-list', [App\Http\Controllers\ParkingsController::class, 'index'])->name('parking-list');
Route::get('/parking-list/show/{id}', [App\Http\Controllers\ParkingsController::class, 'show'])->name('parking-list.show');
Route::get('/parking-list/save/{id?}', [App\Http\Controllers\ParkingsController::class, 'save'])->name('parking-list.save');

Route::get('/parking-facilities', [App\Http\Controllers\ParkingFacilitiesController::class, 'index'])->name('parking-facilities');
Route::get('/parking-facilities/save/{id?}', [App\Http\Controllers\ParkingFacilitiesController::class, 'save'])->name('parking-facilities.save');


Route::get('/chargers-list', [App\Http\Controllers\ParkingsController::class, 'index'])->name('chargers-list');
Route::get('/chargers-list/show/{id}', [App\Http\Controllers\ParkingsController::class, 'show'])->name('chargers-list.show');
Route::get('/chargers-list/save/{id?}', [App\Http\Controllers\ParkingsController::class, 'save'])->name('chargers-list.save');

Route::get('/charging-facilities', [App\Http\Controllers\ChargingFacilitiesController::class, 'index'])->name('charging-facilities');
Route::get('/charging-facilities/save/{id?}', [App\Http\Controllers\ChargingFacilitiesController::class, 'save'])->name('charging-facilities.save');


Route::get('/parking-bookings/{id?}', [App\Http\Controllers\BookingsController::class, 'index'])->name('parking-bookings');
Route::get('/parking-bookings/show/{id}', [App\Http\Controllers\BookingsController::class, 'show'])->name('parking-bookings.show');

Route::get('/tax', [App\Http\Controllers\TaxController::class, 'index'])->name('tax');
Route::get('/tax/edit/{id}', [App\Http\Controllers\TaxController::class, 'edit'])->name('tax.edit');
Route::get('/tax/create', [App\Http\Controllers\TaxController::class, 'create'])->name('tax.create');


Route::get('/currency', [App\Http\Controllers\CurrencyController::class, 'index'])->name('currency');
Route::get('/currency/edit/{id}', [App\Http\Controllers\CurrencyController::class, 'edit'])->name('currency.edit');
Route::get('/currency/create', [App\Http\Controllers\CurrencyController::class, 'create'])->name('currency.create');

Route::get('/reports/{type}', [ReportController::class, 'reportGenerate'])->name('reports');

Route::get('brand', [App\Http\Controllers\BrandController::class, 'index'])->name('brand.index');
Route::get('brand/save/{id?}', [App\Http\Controllers\BrandController::class, 'save'])->name('brand.save');

Route::get('model', [App\Http\Controllers\ModelController::class, 'index'])->name('model.index');
Route::get('model/save/{id?}', [App\Http\Controllers\ModelController::class, 'save'])->name('model.save');

Route::get('cms', [App\Http\Controllers\CmsController::class, 'index'])->name('cms');
Route::get('/cms/edit/{id}', [App\Http\Controllers\CmsController::class, 'edit'])->name('cms.edit');
Route::get('/cms/create', [App\Http\Controllers\CmsController::class, 'create'])->name('cms.create');

Route::get('/coupons', [App\Http\Controllers\CouponController::class, 'index'])->name('coupons');
Route::get('/coupons/save/{id}', [App\Http\Controllers\CouponController::class, 'save'])->name('coupons.save');

Route::get('/on-board', [App\Http\Controllers\OnBoardController::class, 'index'])->name('on-board');
Route::get('/on-board/save/{id}', [App\Http\Controllers\OnBoardController::class, 'show'])->name('on-board.save');

Route::get('/payoutRequest', [App\Http\Controllers\PayoutRequestController::class, 'index'])->name('payoutRequest.index');
Route::get('/walletTransaction/user', [App\Http\Controllers\TransactionController::class, 'userWalletTransaction'])->name('walletTransaction.user');

Route::get('/faq', [App\Http\Controllers\FAQController::class, 'index'])->name('faq');
Route::get('/faq/save/{id?}', [App\Http\Controllers\FAQController::class, 'save'])->name('faq.save');


Route::post('send-notification', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->name('send-notification');


Route::prefix('settings')->group(function () {
    Route::get('globals', [App\Http\Controllers\SettingsController::class, 'globals'])->name('settings.globals');
    Route::get('adminCommission', [App\Http\Controllers\SettingsController::class, 'adminCommission'])->name('settings.adminCommission');
    Route::get('payments/stripe', [App\Http\Controllers\SettingsController::class, 'stripe'])->name('settings.payments.stripe');
    Route::get('payments/applepay', [App\Http\Controllers\SettingsController::class, 'applepay'])->name('settings.payments.applepay');
    Route::get('payments/razorpay', [App\Http\Controllers\SettingsController::class, 'razorpay'])->name('settings.payments.razorpay');
    Route::get('payments/cod', [App\Http\Controllers\SettingsController::class, 'cod'])->name('settings.payments.cod');
    Route::get('payments/paypal', [App\Http\Controllers\SettingsController::class, 'paypal'])->name('settings.payments.paypal');
    Route::get('payments/paytm', [App\Http\Controllers\SettingsController::class, 'paytm'])->name('settings.payments.paytm');
    Route::get('payments/wallet', [App\Http\Controllers\SettingsController::class, 'wallet'])->name('settings.payments.wallet');
    Route::get('payments/payfast', [App\Http\Controllers\SettingsController::class, 'payfast'])->name('settings.payments.payfast');
    Route::get('payments/paystack', [App\Http\Controllers\SettingsController::class, 'paystack'])->name('settings.payments.paystack');
    Route::get('payments/flutterwave', [App\Http\Controllers\SettingsController::class, 'flutterwave'])->name('settings.payments.flutterwave');
    Route::get('payments/mercadopago', [App\Http\Controllers\SettingsController::class, 'mercadopago'])->name('settings.payments.mercadopago');
    Route::get('/landingPageTemplate', [App\Http\Controllers\SettingsController::class, 'landingPageTemplate'])->name('settings.landingPageTemplate');
    Route::get('/headerTemplate', [App\Http\Controllers\SettingsController::class, 'headerTemplate'])->name('settings.headerTemplate');
    Route::get('/footerTemplate', [App\Http\Controllers\SettingsController::class, 'footerTemplate'])->name('settings.footerTemplate');
    Route::get('/privacyPolicy', [App\Http\Controllers\SettingsController::class, 'privacyPolicy'])->name('settings.privacyPolicy');
    Route::get('/termsAndConditions', [App\Http\Controllers\SettingsController::class, 'termsAndConditions'])->name('settings.termsAndConditions');
    Route::get('/languages', [App\Http\Controllers\SettingsController::class, 'languages'])->name('settings.languages');
    Route::get('/languages/save/{id?}', [App\Http\Controllers\SettingsController::class, 'saveLanguage'])->name('settings.languages.save');
    Route::get('/inquiry', [App\Http\Controllers\SettingsController::class, 'inquiry'])->name('settings.inquiry');
    Route::get('/inquiry/show/{id}', [App\Http\Controllers\SettingsController::class, 'showInquiry'])->name('settings.inquiry.show');

});

Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map');
Route::post('/map/get_ride_info', [App\Http\Controllers\MapController::class, 'getRideInfo'])->name('map.getrideinfo');

//API Url for app
Route::post('payments/getpaytmchecksum', [App\Http\Controllers\PaymentController::class, 'getPaytmChecksum']);
Route::post('payments/validatechecksum', [App\Http\Controllers\PaymentController::class, 'validateChecksum']);
Route::post('payments/initiatepaytmpayment', [App\Http\Controllers\PaymentController::class, 'initiatePaytmPayment']);
Route::get('payments/paytmpaymentcallback', [App\Http\Controllers\PaymentController::class, 'paytmPaymentcallback']);
Route::post('payments/paypalclientid', [App\Http\Controllers\PaymentController::class, 'getPaypalClienttoken']);
Route::post('payments/paypaltransaction', [App\Http\Controllers\PaymentController::class, 'createBraintreePayment']);
Route::post('payments/stripepaymentintent', [App\Http\Controllers\PaymentController::class, 'createStripePaymentIntent']);
Route::get('payment/success', [App\Http\Controllers\PaymentController::class, 'paymentsuccess'])->name('payment.success');
Route::get('payment/failed', [App\Http\Controllers\PaymentController::class, 'paymentfailed'])->name('payment.failed');
Route::get('payment/pending', [App\Http\Controllers\PaymentController::class, 'paymentpending'])->name('payment.pending');

