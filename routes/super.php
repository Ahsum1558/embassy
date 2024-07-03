<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Super\CmspageController;
use App\Http\Controllers\Super\FieldController;
use App\Http\Controllers\Super\HeaderfooterController;
use App\Http\Controllers\Super\SuperuserController;
use App\Http\Controllers\Super\UserPaymentController;
use App\Http\Controllers\Super\MaintenanceController;
use App\Http\Controllers\Super\SliderController;
use App\Http\Controllers\Super\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Super Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Super Admin Page Start
// Super Admin Area Start
Route::prefix('/super')->group(function () {

    Route::namespace('Auth')->middleware('guest:super')->group(function(){
        Route::match(['get', 'post'], 'login', [SuperController::class, 'login'])->name('super.users.login');
        Route::match(['get', 'post'], 'login/store', [SuperController::class, 'superStore'])->name('super.users.store');
        // Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('super.home.login');
        // Route::post('/store', [AuthenticatedSessionController::class, 'store'])->name('super.home.store');
    });
    
    Route::group(['middleware' => 'super'], function() {
        Route::get('/', [SuperController::class, 'index'])->name('super.home.index');

        // Logout Option
        Route::get('/logout', [SuperController::class, 'superLogout'])->name('super.logout');

        // Super Profile
        Route::get('/profile', [SuperController::class, 'superProfile'])->name('super.profile');

        // Get Division
        Route::get('/profile/get', [SuperController::class, 'getDivision'])->name('super.profile.get');
        // Get District
        Route::get('/profile/getDistrict', [SuperController::class, 'getDistrict'])->name('super.profile.getDistrict');
        // Get City
        Route::get('/profile/getCity', [SuperController::class, 'getCity'])->name('super.profile.getCity');
        // Get Upzila
        Route::get('/profile/getUpzila', [SuperController::class, 'getUpzila'])->name('super.profile.getUpzila');

        // Profile Info Update
        Route::get('/profile/info', [SuperController::class, 'superProfileInfo'])->name('super.profile.info');
        Route::post('/profile/infoUpdate', [SuperController::class, 'superProfileInfoUpdate'])->name('super.profile.infoUpdate');

        // Username Update
        Route::get('/profile/username', [SuperController::class, 'superProfileUsername'])->name('super.profile.username');
        Route::post('/profile/usernameUpdate', [SuperController::class, 'superProfileUsernameUpdate'])->name('super.profile.usernameUpdate');

        // Email Update
        Route::get('/profile/email', [SuperController::class, 'superProfileEmail'])->name('super.profile.email');
        Route::post('/profile/emailUpdate', [SuperController::class, 'superProfileEmailUpdate'])->name('super.profile.emailUpdate');

        // Photo Update
        Route::get('/profile/image', [SuperController::class, 'superProfileImage'])->name('super.profile.image');
        Route::post('/profile/imageUpdate', [SuperController::class, 'superProfileImageUpdate'])->name('super.profile.imageUpdate');

        // Password Update
        Route::get('/profile/password', [SuperController::class, 'superProfilePassword'])->name('super.profile.password');
        Route::post('/profile/passwordUpdate', [SuperController::class, 'superProfilePasswordUpdate'])->name('super.profile.passwordUpdate');

        // Theme Update
        Route::get('/theme', [SuperController::class, 'superProfileTheme'])->name('super.theme');
        Route::post('/themeUpdate', [SuperController::class, 'superProfileThemeUpdate'])->name('super.themeUpdate');
    });
});
// Super Admin Area End

// Meta Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Meta Home Page
    Route::get('/super/meta', [CmspageController::class, 'index'])->name('super.meta');
    Route::post('/super/meta/store', [CmspageController::class, 'store'])->name('super.meta.store');

    // Meta Info Update
    Route::get('/super/meta/edit/{id}', [CmspageController::class, 'edit'])->name('super.meta.edit');
    Route::post('/super/meta/update/{id}', [CmspageController::class, 'update'])->name('super.meta.update');

    // Meta Delete
    Route::get('/super/meta/destroy/{id}', [CmspageController::class, 'destroy'])->name('super.meta.destroy');

    // Meta Inactive
    Route::post('/super/meta/inactive/{id}', [CmspageController::class, 'inactive'])->name('super.meta.inactive');

    // Meta Active
    Route::post('/super/meta/active/{id}', [CmspageController::class, 'active'])->name('super.meta.active');
});
// Meta Area End

// Site Option Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Site Option Home Page
    Route::get('/super/field', [FieldController::class, 'index'])->name('super.field');
    Route::post('/super/field/store', [FieldController::class, 'store'])->name('super.field.store');

    Route::get('/super/field/show/{id}', [FieldController::class, 'show'])->name('super.field.show');

    // Site Option Info Update
    Route::get('/super/field/edit/{id}', [FieldController::class, 'edit'])->name('super.field.edit');
    Route::post('/super/field/update/{id}', [FieldController::class, 'update'])->name('super.field.update');

    // Site Option Title Update
    Route::get('/super/field/editTitle/{id}', [FieldController::class, 'editTitle'])->name('super.field.editTitle');
    Route::post('/super/field/updateTitle/{id}', [FieldController::class, 'updateTitle'])->name('super.field.updateTitle');

    // Site Option Small Title Update
    Route::get('/super/field/editSmallTitle/{id}', [FieldController::class, 'editSmallTitle'])->name('super.field.editSmallTitle');
    Route::post('/super/field/updateSmallTitle/{id}', [FieldController::class, 'updateSmallTitle'])->name('super.field.updateSmallTitle');

    // Site Option License Update
    Route::get('/super/field/editLicense/{id}', [FieldController::class, 'editLicense'])->name('super.field.editLicense');
    Route::post('/super/field/updateLicense/{id}', [FieldController::class, 'updateLicense'])->name('super.field.updateLicense');

    // Site Option Logo Update
    Route::get('/super/field/editLogo/{id}', [FieldController::class, 'editLogo'])->name('super.field.editLogo');
    Route::post('/super/field/updateLogo/{id}', [FieldController::class, 'updateLogo'])->name('super.field.updateLogo');

    // Site Option Delete
    Route::get('/super/field/destroy/{id}', [FieldController::class, 'destroy'])->name('super.field.destroy');

    // Site Option Inactive
    Route::post('/super/field/inactive/{id}', [FieldController::class, 'inactive'])->name('super.field.inactive');

    // Site Option Active
    Route::post('/super/field/active/{id}', [FieldController::class, 'active'])->name('super.field.active');
});
// Site Option Area End

// Header and Footer Setting Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Header and Footer Setting Home Page
    Route::get('/super/setting', [HeaderfooterController::class, 'index'])->name('super.setting');

     // Header and Footer Setting Create
    Route::get('/super/setting/create', [HeaderfooterController::class, 'create'])->name('super.setting.create');
    Route::post('/super/setting/store', [HeaderfooterController::class, 'store'])->name('super.setting.store');

    Route::get('/super/setting/show/{id}', [HeaderfooterController::class, 'show'])->name('super.setting.show');

    // Header and Footer Setting Info Update
    Route::get('/super/setting/edit/{id}', [HeaderfooterController::class, 'edit'])->name('super.setting.edit');
    Route::post('/super/setting/update/{id}', [HeaderfooterController::class, 'update'])->name('super.setting.update');

    // Header and Footer Setting Delete
    Route::get('/super/setting/destroy/{id}', [HeaderfooterController::class, 'destroy'])->name('super.setting.destroy');

    // Header and Footer Setting Inactive
    Route::post('/super/setting/inactive/{id}', [HeaderfooterController::class, 'inactive'])->name('super.setting.inactive');

    // Header and Footer Setting Active
    Route::post('/super/setting/active/{id}', [HeaderfooterController::class, 'active'])->name('super.setting.active');
});
// Header and Footer Setting Area End

// Slider Field Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Slider Field Home Page
    Route::get('/super/slider', [SliderController::class, 'index'])->name('super.slider');

    // Slider Field Create
    Route::get('/super/slider/create', [SliderController::class, 'create'])->name('super.slider.create');
    Route::post('/super/slider/store', [SliderController::class, 'store'])->name('super.slider.store');

    // Slider Field Display
    Route::get('/super/slider/show/{id}', [SliderController::class, 'show'])->name('super.slider.show');

    // Slider Field Info Update
    Route::get('/super/slider/edit/{id}', [SliderController::class, 'edit'])->name('super.slider.edit');
    Route::post('/super/slider/update/{id}', [SliderController::class, 'update'])->name('super.slider.update');

    // Slider Field Image Update
    Route::get('/super/slider/editSlider/{id}', [SliderController::class, 'editSlider'])->name('super.slider.editSlider');
    Route::post('/super/slider/updateSlider/{id}', [SliderController::class, 'updateSlider'])->name('super.slider.updateSlider');

    // Slider Field Delete
    Route::get('/super/slider/destroy/{id}', [SliderController::class, 'destroy'])->name('super.slider.destroy');

    // Slider Field Inactive
    Route::post('/super/slider/inactive/{id}', [SliderController::class, 'inactive'])->name('super.slider.inactive');

    // Slider Field Active
    Route::post('/super/slider/active/{id}', [SliderController::class, 'active'])->name('super.slider.active');
});
// Slider Field Area End

// Super Operator Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Operator Home Page
    Route::get('/super/operator', [SuperuserController::class, 'index'])->name('super.operator');

     // Super Operator Create
    Route::get('/super/operator/create', [SuperuserController::class, 'create'])->name('super.operator.create');
    Route::post('/super/operator/store', [SuperuserController::class, 'store'])->name('super.operator.store');

    // Get Division
    Route::get('/super/operator/get', [SuperuserController::class, 'getDivision'])->name('super.operator.get');
    // Get District
    Route::get('/super/operator/getDistrict', [SuperuserController::class, 'getDistrict'])->name('super.operator.getDistrict');
    // Get City
    Route::get('/super/operator/getCity', [SuperuserController::class, 'getCity'])->name('super.operator.getCity');
    // Get Upzila
    Route::get('/super/operator/getUpzila', [SuperuserController::class, 'getUpzila'])->name('super.operator.getUpzila');

    Route::get('/super/operator/show/{id}', [SuperuserController::class, 'show'])->name('super.operator.show');

    // Super Operator All Info Update
    Route::get('/super/operator/edit/{id}', [SuperuserController::class, 'edit'])->name('super.operator.edit');
    Route::post('/super/operator/update/{id}', [SuperuserController::class, 'update'])->name('super.operator.update');

    // Super Operator Title Update
    Route::get('/super/operator/editTitle/{id}', [SuperuserController::class, 'editTitle'])->name('super.operator.editTitle');
    Route::post('/super/operator/updateTitle/{id}', [SuperuserController::class, 'updateTitle'])->name('super.operator.updateTitle');

    // Super Operator Small Title Update
    Route::get('/super/operator/editShortTitle/{id}', [SuperuserController::class, 'editShortTitle'])->name('super.operator.editShortTitle');
    Route::post('/super/operator/updateShortTitle/{id}', [SuperuserController::class, 'updateShortTitle'])->name('super.operator.updateShortTitle');

    // Super Operator License Update
    Route::get('/super/operator/editLicense/{id}', [SuperuserController::class, 'editLicense'])->name('super.operator.editLicense');
    Route::post('/super/operator/updateLicense/{id}', [SuperuserController::class, 'updateLicense'])->name('super.operator.updateLicense');

    // Super Operator Bengali Title Update
    Route::get('/super/operator/editTitlebn/{id}', [SuperuserController::class, 'editTitlebn'])->name('super.operator.editTitlebn');
    Route::post('/super/operator/updateTitlebn/{id}', [SuperuserController::class, 'updateTitlebn'])->name('super.operator.updateTitlebn');

    // Super Operator Bengali License Update
    Route::get('/super/operator/editLicensebn/{id}', [SuperuserController::class, 'editLicensebn'])->name('super.operator.editLicensebn');
    Route::post('/super/operator/updateLicensebn/{id}', [SuperuserController::class, 'updateLicensebn'])->name('super.operator.updateLicensebn');

    // Super Operator Arabic Title Update
    Route::get('/super/operator/editTitlear/{id}', [SuperuserController::class, 'editTitlear'])->name('super.operator.editTitlear');
    Route::post('/super/operator/updateTitlear/{id}', [SuperuserController::class, 'updateTitlear'])->name('super.operator.updateTitlear');

    // Super Operator Arabic License Update
    Route::get('/super/operator/editLicensear/{id}', [SuperuserController::class, 'editLicensear'])->name('super.operator.editLicensear');
    Route::post('/super/operator/updateLicensear/{id}', [SuperuserController::class, 'updateLicensear'])->name('super.operator.updateLicensear');

    // Super Operator Type Update
    Route::get('/super/operator/editType/{id}', [SuperuserController::class, 'editType'])->name('super.operator.editType');
    Route::post('/super/operator/updateType/{id}', [SuperuserController::class, 'updateType'])->name('super.operator.updateType');

    // Super Operator Logo Update
    Route::get('/super/operator/editLogo/{id}', [SuperuserController::class, 'editLogo'])->name('super.operator.editLogo');
    Route::post('/super/operator/updateLogo/{id}', [SuperuserController::class, 'updateLogo'])->name('super.operator.updateLogo');

    // Super Operator Info Update
    Route::get('/super/operator/editInfo/{id}', [SuperuserController::class, 'editInfo'])->name('super.operator.editInfo');
    Route::post('/super/operator/updateInfo/{id}', [SuperuserController::class, 'updateInfo'])->name('super.operator.updateInfo');

    // Super Operator Info in English Update
    Route::get('/super/operator/editEn/{id}', [SuperuserController::class, 'editEn'])->name('super.operator.editEn');
    Route::post('/super/operator/updateEn/{id}', [SuperuserController::class, 'updateEn'])->name('super.operator.updateEn');

    // Super Operator Info in Bengali Update
    Route::get('/super/operator/editBn/{id}', [SuperuserController::class, 'editBn'])->name('super.operator.editBn');
    Route::post('/super/operator/updateBn/{id}', [SuperuserController::class, 'updateBn'])->name('super.operator.updateBn');

    // Super Operator Info in Arabic Update
    Route::get('/super/operator/editAr/{id}', [SuperuserController::class, 'editAr'])->name('super.operator.editAr');
    Route::post('/super/operator/updateAr/{id}', [SuperuserController::class, 'updateAr'])->name('super.operator.updateAr');

    // Super Operator Delete
    Route::get('/super/operator/destroy/{id}', [SuperuserController::class, 'destroy'])->name('super.operator.destroy');

    // Super Operator Inactive
    Route::post('/super/operator/inactive/{id}', [SuperuserController::class, 'inactive'])->name('super.operator.inactive');

    // Super Operator Active
    Route::post('/super/operator/active/{id}', [SuperuserController::class, 'active'])->name('super.operator.active');
});
// Super Operator Area End

// Maintenance Area Start
Route::group(['middleware' => 'super'], function() {
    // Maintenance Approved
    Route::get('/super/approve', [MaintenanceController::class, 'approvedUser'])->name('super.approve');
    Route::post('/super/operator/approve/{id}', [MaintenanceController::class, 'approve'])->name('super.operator.approve');

    // Maintenance Pending
    Route::get('/super/pending', [MaintenanceController::class, 'pendingUser'])->name('super.pending');
    Route::post('/super/operator/pending/{id}', [MaintenanceController::class, 'pending'])->name('super.operator.pending');

    // Maintenance Disabled
    Route::get('/super/disable', [MaintenanceController::class, 'disabledUser'])->name('super.disable');
    Route::post('/super/operator/disable/{id}', [MaintenanceController::class, 'disable'])->name('super.operator.disable');

    // Maintenance Expired
    Route::get('/super/expired', [MaintenanceController::class, 'expiredUser'])->name('super.expired');

    // Maintenance Near Expiry
    Route::get('/super/near', [MaintenanceController::class, 'nearExpiry'])->name('super.near');
});
// Maintenance Area End

// Operator Payment Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Operator Extension
    Route::get('/super/operator/extension/{id}', [UserPaymentController::class, 'extension'])->name('super.operator.extension');
    Route::post('/super/operator/storeExtension/{id}', [UserPaymentController::class, 'storeExtension'])->name('super.operator.storeExtension');

    // Super Operator Extension Update
    Route::get('/super/operator/editExtension/{id}', [UserPaymentController::class, 'editExtension'])->name('super.operator.editExtension');
    Route::post('/super/operator/updateExtension/{id}', [UserPaymentController::class, 'updateExtension'])->name('super.operator.updateExtension');

    // Super Operator Expansion Update
    Route::get('/super/operator/editExpansion/{id}', [UserPaymentController::class, 'editExpansion'])->name('super.operator.editExpansion');
    Route::post('/super/operator/updateExpansion/{id}', [UserPaymentController::class, 'updateExpansion'])->name('super.operator.updateExpansion');

    // Remove Super Operator Payment
    Route::get('/super/operator/remove/{id}', [UserPaymentController::class, 'remove'])->name('super.operator.remove');
});
// Operator Payment Area End

// Super Admin Page End