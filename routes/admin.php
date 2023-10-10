<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
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
    Route::group(['prefix'=>'category'], function(){
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
});