<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CoponController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;

/*
|--------------------------------------------------------------------------
| Admin  Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin-login', [LoginController::class, 'admin_login'])->name('admin.login');

// Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');




Route::group(['middleware' => 'is_admin'], function () {

    Route::get('/admin/home', [AdminController::class, 'admin'])->name('admin.home');
    Route::post('/admin/logout', [AdminController::class, 'admin_logout'])->name('admin.logout');
    Route::get('/admin/password/change', [AdminController::class, 'password_change'])->name('password.change');
    Route::post('/admin/password/update', [AdminController::class, 'admin_password_update'])->name('admin.password.update');

    //CATEGORY ROUTES
    Route::group(['prefix' => 'category'], function () {
        Route::get('/index', [CategoryController::class, 'category_index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'category_store'])->name('category.store');
        Route::delete('/delete/{id}', [CategoryController::class, 'category_delete'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'category_edit']);

        Route::post('/update', [CategoryController::class, 'category_update'])->name('category.update');
    });

    //Sub CATEGORY ROUTES
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/index', [SubcategoryController::class, 'subcategory_index'])->name('subcategory.index');
        Route::post('/store', [SubcategoryController::class, 'subcategory_store'])->name('subcategory.store');
        Route::delete('/destroy/{id}', [SubcategoryController::class, 'subcategory_destroy'])->name('subcategory.destroy');
        Route::get('/edit/{id}', [SubcategoryController::class, 'subcategory_edit']);

        Route::post('/update', [SubcategoryController::class, 'subcategory_update'])->name('subcategory.update');
    });

    //CHILD CATEGORY ROUTE

    Route::group(['prefix' => 'childcategory'], function () {
        Route::get('/index', [ChildCategoryController::class, 'childcategory_index'])->name('childcategory.index');

        Route::post('/store', [ChildCategoryController::class, 'childcategory_store'])->name('childcategory.store');
        Route::get('/destroy/{id}', [ChildCategoryController::class, 'childcategory_destroy'])->name('childcategory.destroy');
        Route::get('/edit/{id}', [ChildCategoryController::class, 'childcategory_edit']);

        Route::post('/update', [ChildCategoryController::class, 'childcategory_update'])->name('childcategory.update');
    });

    //BRAND ROUTE

    Route::group(['prefix' => 'brand'], function () {
        Route::get('/index', [BrandController::class, 'brand_index'])->name('brand.index');

        Route::post('/store', [BrandController::class, 'brand_store'])->name('brand.store');
        Route::get('/destroy/{id}', [BrandController::class, 'brand_destroy'])->name('brand.destroy');
        Route::get('/edit/{id}', [BrandController::class, 'brand_edit']);

        Route::post('/update', [BrandController::class, 'brand_update'])->name('brand.update');
    });

    //WARE HOUSE ROUTE
    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/index', [WarehouseController::class, 'warehouse_index'])->name('warehouse.index');
         Route::post('/store', [WarehouseController::class, 'warehouse_store'])->name('warehouse.store');

        Route::get('/destroy/{id}', [WarehouseController::class, 'warehouse_destroy'])->name('warehouse.destroy');

        Route::get('/edit/{id}', [WarehouseController::class, 'warehouse_edit']);
        Route::post('/update/{id}', [WarehouseController::class, 'warehouse_update'])->name('warehouse.update');

    });

    //SETTING ROUTE
    Route::group(['prefix' => 'setting'], function () {

        //SEOS SETTING ROUTE
        Route::group(['prefix' => 'seos'], function () {
            Route::get('/', [SettingController::class, 'setting_seo_index'])->name('setting.seo.index');
            Route::post('/update/{id}', [SettingController::class, 'setting_seo_update'])->name('setting.seo.update');
        });

        //SMTP SETTING ROUTE
        Route::group(['prefix' => 'smtp'], function () {
            Route::get('/', [SettingController::class, 'setting_smtp'])->name('setting.smtp');
             Route::post('/update/{id}', [SettingController::class, 'setting_smtp_update'])->name('setting.smtp.update');
        });

        //PAGE CREATE ROUTE
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', [PagesController::class, 'create_index_page'])->name('create.index.page');
            Route::get('/create', [PagesController::class, 'setting_create_page'])->name('setting.create.page');
            Route::post('/store',[PagesController::class, 'page_store'])->name('page.store');
            Route::delete('/destroy/{id}', [PagesController::class, 'page_destroy'])->name('page.destroy');
            Route::get('/edit/{id}', [PagesController::class, 'page_edit'])->name('page.edit');
            Route::post('/update/{id}', [PagesController::class, 'page_update'])->name('page.update');
        });

        //PAGE CREATE ROUTE
        Route::group(['prefix' => 'website'], function () {
            Route::get('/', [WebsiteController::class, 'website_setting'])->name('website.setting');
            //Route::get('/create', [PagesController::class, 'setting_create_page'])->name('setting.create.page');
            Route::post('/update/{id}', [WebsiteController::class, 'website_update'])->name('website.update');
        });
    });

    //COPON ROUTE
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/index', [CoponController::class, 'coupon_index'])->name('coupon.index');
        Route::post('/store', [CoponController::class, 'coupon_store'])->name('coupon.store');
        Route::get('/delete/{id}', [CoponController::class, 'coupon_delete'])->name('coupon.delete');
        Route::get('/edit/{id}', [CoponController::class, 'coupon_edit']);
        Route::post('/update', [CoponController::class, 'coupon_update'])->name('coupon.update');
    });

    //PICK UP POINT
    Route::group(['prefix' => 'pickup'], function () {
        Route::get('/index', [PickupController::class, 'pickup_point_index'])->name('pickuppoint.index');
        Route::post('/store', [PickupController::class, 'pickup_point_store'])->name('pickuppoint.store');
        Route::get('/delete/{id}', [PickupController::class, 'pickup_point_delete'])->name('pickuppoint.delete');
        Route::get('/edit/{id}', [PickupController::class, 'pickuppoint_edit']);
        Route::post('/update/{id}', [PickupController::class, 'pickup_point_update'])->name('pickuppoint.update');
    });

});
