<?php

use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\AddressGroupController;
use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Frontend\ImportQuoteController;
use App\Http\Controllers\Frontend\OrderSupplyController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\PickupController;
use App\Http\Controllers\Frontend\ShipmentController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Services\Couriers\PurolatorShippingService;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return redirect('index');
// });

Route::get('test-co', function () {

    $fedex = new PurolatorShippingService();
    dd($fedex->createPickup([]));
});

$menu = theme()->getMenu();
array_walk($menu, function ($val) {
    if (isset($val['path'])) {
        $route = Route::get($val['path'], [PagesController::class, 'index']);

        // Exclude documentation from auth middleware
        if (!Str::contains($val['path'], 'documentation')) {
            $route->middleware('auth');
        }

        // Custom page demo for 500 server error
        if (Str::contains($val['path'], 'error-500')) {
            Route::get($val['path'], function () {
                abort(500, 'Something went wrong! Please try again later.');
            });
        }
    }
});


Route::middleware('auth')->group(function () {
    // Account pages
    Route::prefix('account')->group(function () {
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::put('settings/email', [SettingsController::class, 'changeEmail'])->name('settings.changeEmail');
        Route::put('settings/password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
    });
});

Route::resource('users', UsersController::class);
Route::group(['middleware' => 'auth'], function () {

    Route::resource('import-quotes', ImportQuoteController::class);
    Route::resource('pickups', PickupController::class);
    Route::resource('shipments', ShipmentController::class);

    Route::resource('order-supplies', OrderSupplyController::class);
    Route::get('/address-groups/import', [AddressGroupController::class, 'import'])->name('address-groups.import');
    Route::post('/address-groups/import', [AddressGroupController::class, 'storeImport'])->name('address-groups.store-import');

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {

        Route::get('/import', [ProductController::class, 'import'])->name('import');
        Route::post('/import', [ProductController::class, 'storeImport'])->name('store-import');
    });

    Route::get('shipping/quote', [ShipmentController::class, 'qoute']);
    Route::post('convert_qoute', [ShipmentController::class, 'convert_qoute']);
    Route::post('confirm', [ShipmentController::class, 'confirm_shipment']);
    Route::get('shipping/quote_courier', [ShipmentController::class, 'quote_courier']);
    Route::get('shipping/summary', [ShipmentController::class, 'summary']);
    Route::get('shipping/pre_dispatch', [ShipmentController::class, 'pre_dispatch']);
   
    Route::resource('packages', PackageController::class);
    Route::resource('products', ProductController::class);
    Route::resource('address-groups', AddressGroupController::class);
    Route::resource('address-groups.addresses', AddressController::class);
    Route::resource('feedback', FeedbackController::class);
});

/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__.'/auth.php';
