<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\ProductConfigurationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\ShipmentSkdsController;
use App\Http\Controllers\Admin\ShipmentStatusHistoryController;
use App\Http\Controllers\Admin\SkdController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSkdConfigureController;
use App\Http\Controllers\Admin\SkdTypeController;
use App\Http\Controllers\Admin\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(["message" => "Api route up for series"]);
});


Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('series', SeriesController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('skd', SkdController::class)->except(['create', 'edit']);
    Route::resource('products', ProductController::class);
    Route::get('/series-wise-product', [ProductController::class, 'productGroupBySeries']);
    Route::resource('product-configurations', ProductConfigurationController::class);
    Route::resource('product-skd-configurations', ProductSkdConfigureController::class);
    Route::resource('skd', SkdController::class)->except(['create', 'edit']);
    Route::resource('modules', ModuleController::class)->except(['create', 'edit']);
    Route::resource('notifications', NotificationController::class)->only(['index', 'update']);
    Route::prefix('verify-module')->group(function () {
        Route::put('/', [VerificationController::class, 'verify_module']);
        Route::get('history', [VerificationController::class, 'history']);
    });
    Route::resource('purchase-orders', PurchaseOrderController::class)->except(['create', 'edit']);
    Route::put('shipment-skds/{id}', [ShipmentSkdsController::class, 'update']);
    Route::resource('shipment-status-history', ShipmentStatusHistoryController::class)->except(['create', 'edit']);
    Route::prefix('permissions')->group(function () {
        Route::get('verification', [PermissionController::class, 'verification']);
    });
    Route::resource('skd-types', SkdTypeController::class)->only(['index', 'store']);
});
