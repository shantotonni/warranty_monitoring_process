<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/', function () {
    return redirect(route('login.index'));
});

Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::resource('/home', 'DashboardController');
    Route::resource('/admin-dashboard', 'AdminDashboardController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/users', 'UserController');
    Route::resource('/products', 'ProductController');
    Route::resource('/regions', 'RegionController');
    Route::resource('/areas', 'AreaController');
    Route::resource('/user-areas', 'UserAreaController');
    Route::resource('/claim-warranty', 'WarrantyClaimInfoController');
    Route::post('/unlock-engineer-warranty-btn', 'WarrantyClaimInfoController@unlockEngineerWarrantyBtn')->name('unlock.engineer.warranty.submit.btn');
    Route::get('/parts', 'PartsController@index')->name('parts.index');
    Route::get('/parts/create', 'PartsController@create');
    Route::post('/parts/store', 'PartsController@store')->name('parts.store');
    Route::get('/parts/edit/{id}', 'PartsController@edit')->name('parts.edit');
    Route::post('/parts/update/{id}', 'PartsController@update')->name('parts.update');
    Route::post('/import-parts', 'PartsController@import')->name('parts.import');
    Route::post('/search-parts', 'PartsController@search')->name('parts.search');
    Route::post('/parts/search-by-parts-number', 'WarrantyClaimInfoController@searchByPartsNumber');
    Route::get('/parts/get-by-parts-code/{selectedParts}', 'WarrantyClaimInfoController@getPartsByCode');
    Route::post('/admin/upload-approval', 'AdminDashboardController@uploadApprovalImage')->name('upload.approval');
    Route::post('/admin/download-approval', 'AdminDashboardController@downloadApprovalImage')->name('download.approval');
    Route::post('/admin/download-engineer-files', 'AdminDashboardController@downloadEngineerFiles')->name('download.eng.files');
    Route::post('/admin/additional-info-need', 'AdminDashboardController@additionalInfoNeed')->name('admin.additional.info');
    Route::get('/user-area/get-areas-by-region', 'UserAreaController@getAreasByRegion')->name('get.areas.by.region');
    Route::get('/user/change-password-form', 'UserController@changePasswordForm')->name('user.change.password.form');
    Route::post('/store-change-password', 'UserController@changePassword')->name('store.change.password');

    Route::resource('/engineer-warranty-claims', 'EngineerWarrantyClaimController');

    Route::post('/export-warranty-claim-info-list', [App\Http\Controllers\WarrantyClaimInfoController::class, 'exportWarrantyClaimInfoTable'])->name('export.warranty.claim.info.table');
    Route::get('/search-warranty-claim-info-by-status', [App\Http\Controllers\WarrantyClaimInfoController::class, 'searchWarrantyClaimInfoByStatus'])->name('search.warranty.claim.info.by.status');
    //Route::get('/search-warranty-claim-info-by-chassis-no', [App\Http\Controllers\WarrantyClaimInfoController::class, 'searchWarrantyClaimInfoByChassisNo'])->name('search.warranty.claim.info.by.chassis.no');
    // Route::get('/search-warranty-claim-info-by-product', [App\Http\Controllers\WarrantyClaimInfoController::class, 'searchWarrantyClaimInfoByProduct'])->name('search.warranty.claim.info.by.product');
    Route::get('/admin-warranty-claim-done/{id}', 'WarrantyClaimInfoController@AdminWarrantyClaimDone');
    Route::get('/spo-invoice-claim-done/{id}', 'WarrantyClaimInfoController@SpoInvoiceClaimDone');
    Route::get('/admin-asking-parts-to-spo/{id}', 'WarrantyClaimInfoController@AdminAskingPartsToSpo');
    Route::get('/warranty-claim-lock/{id}', 'WarrantyClaimInfoController@warrantyClaimLockUnlock')->name('warranty.claim.lock');
    Route::get('inactive-claim-warranty-list', 'WarrantyClaimInfoController@inactiveWarrentyClaimList')->name('inactive-claim-warranty.list');

});

