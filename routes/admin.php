<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminuserController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Super\CmspageController;
use App\Http\Controllers\Super\FieldarController;
use App\Http\Controllers\Super\FieldbnController;
use App\Http\Controllers\Super\FieldController;
use App\Http\Controllers\Super\HeaderfooterController;
use App\Http\Controllers\Locaton\CountryController;
use App\Http\Controllers\Locaton\DivisionController;
use App\Http\Controllers\Locaton\DistrictController;
use App\Http\Controllers\Locaton\PolicestationController;
use App\Http\Controllers\Locaton\IssueController;
use App\Http\Controllers\Locaton\CityController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Area Start
// Home Page and Login Area Start
Route::middleware(['guest'])->group(function () {
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login'])->name('admin.users.login');
	Route::match(['get', 'post'], 'login/store', [AdminController::class, 'userStore'])->name('admin.users.store');
	// Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
	// Route::post('/store', [AuthenticatedSessionController::class, 'store'])->name('admin.home.store');

    // User Operator Create
    Route::get('/register', [AdminController::class, 'register'])->name('admin.users.register');
    Route::post('/registerStore', [AdminController::class, 'registerStore'])->name('admin.users.registerStore');
});
Route::group(['middleware' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home.index');

    // Logout Option
    Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
});
// Home Page and Login Area End

// User Profile Area Start
Route::group(['middleware' => 'admin'], function() {
    // User Profile
    Route::get('/profile', [AdminController::class, 'userProfile'])->name('admin.profile');

    // Profile Info Update
    Route::get('/profile/info', [AdminController::class, 'profileInfoEdit'])->name('admin.profile.info');
    Route::post('/profile/infoUpdate', [AdminController::class, 'profileInfoUpdate'])->name('admin.profile.infoUpdate');

    // Get Division
    Route::get('/profile/get', [AdminController::class, 'getDivision'])->name('admin.profile.get');
    // Get District
    Route::get('/profile/getDistrict', [AdminController::class, 'getDistrict'])->name('admin.profile.getDistrict');
    // Get City
    Route::get('/profile/getCity', [AdminController::class, 'getCity'])->name('admin.profile.getCity');
    // Get Upzila
    Route::get('/profile/getUpzila', [AdminController::class, 'getUpzila'])->name('admin.profile.getUpzila');

    // Username Update
    Route::get('/profile/username', [AdminController::class, 'profileUsername'])->name('admin.profile.username');
    Route::post('/profile/usernameUpdate', [AdminController::class, 'profileUsernameUpdate'])->name('admin.profile.usernameUpdate');

    // Email Update
    Route::get('/profile/email', [AdminController::class, 'profileEmail'])->name('admin.profile.email');
    Route::post('/profile/emailUpdate', [AdminController::class, 'profileEmailUpdate'])->name('admin.profile.emailUpdate');

    // Photo Update
    Route::get('/profile/image', [AdminController::class, 'profileImage'])->name('admin.profile.image');
    Route::post('/profile/imageUpdate', [AdminController::class, 'profileImageUpdate'])->name('admin.profile.imageUpdate');

    // Password Update
    Route::get('/profile/password', [AdminController::class, 'profilePassword'])->name('admin.profile.password');
    Route::post('/profile/passwordUpdate', [AdminController::class, 'profilePasswordUpdate'])->name('admin.profile.passwordUpdate');

    // Theme Update
    Route::get('/theme', [AdminController::class, 'userProfileTheme'])->name('admin.theme');
    Route::post('/themeUpdate', [AdminController::class, 'userProfileThemeUpdate'])->name('admin.themeUpdate');
});

// User Password Reset Start
Route::middleware(['guest'])->group(function () {
    // Password Reset
    Route::get('/forgotPassword', [ForgotPasswordController::class, 'forgotPassword'])->name('admin.forgotPassword');
    Route::post('/forgotPasswordStore', [ForgotPasswordController::class, 'forgotPasswordStore'])->name('admin.forgotPasswordStore');
    Route::get('/resetPassword/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('admin.resetPassword');
    Route::post('/resetPasswordStore', [ForgotPasswordController::class, 'resetPasswordStore'])->name('admin.resetPasswordStore');
});

// User Password Reset Area End

// User Profile Area End





// User Operator Area Start
Route::group(['middleware' => 'admin'], function() {
    // Company Info Create
    Route::get('/profile/create', [AdminuserController::class, 'create'])->name('admin.profile.create');
    Route::post('/profile/store', [AdminuserController::class, 'store'])->name('admin.profile.store');
    // User Admin Title Update
    Route::get('/profile/editTitle', [AdminuserController::class, 'editTitle'])->name('admin.profile.editTitle');
    Route::post('/profile/updateTitle', [AdminuserController::class, 'updateTitle'])->name('admin.profile.updateTitle');

    // User Admin Small Title Update
    Route::get('/profile/editShortTitle', [AdminuserController::class, 'editShortTitle'])->name('admin.profile.editShortTitle');
    Route::post('/profile/updateShortTitle', [AdminuserController::class, 'updateShortTitle'])->name('admin.profile.updateShortTitle');

    // User Admin License Update
    Route::get('/profile/editLicense', [AdminuserController::class, 'editLicense'])->name('admin.profile.editLicense');
    Route::post('/profile/updateLicense', [AdminuserController::class, 'updateLicense'])->name('admin.profile.updateLicense');

    // User Admin Bengali Title Update
    Route::get('/profile/editTitlebn', [AdminuserController::class, 'editTitlebn'])->name('admin.profile.editTitlebn');
    Route::post('/profile/updateTitlebn', [AdminuserController::class, 'updateTitlebn'])->name('admin.profile.updateTitlebn');

    // User Admin Bengali License Update
    Route::get('/profile/editLicensebn', [AdminuserController::class, 'editLicensebn'])->name('admin.profile.editLicensebn');
    Route::post('/profile/updateLicensebn', [AdminuserController::class, 'updateLicensebn'])->name('admin.profile.updateLicensebn');

    // User Admin Arabic Title Update
    Route::get('/profile/editTitlear', [AdminuserController::class, 'editTitlear'])->name('admin.profile.editTitlear');
    Route::post('/profile/updateTitlear', [AdminuserController::class, 'updateTitlear'])->name('admin.profile.updateTitlear');

    // User Admin Arabic License Update
    Route::get('/profile/editLicensear', [AdminuserController::class, 'editLicensear'])->name('admin.profile.editLicensear');
    Route::post('/profile/updateLicensear', [AdminuserController::class, 'updateLicensear'])->name('admin.profile.updateLicensear');

    // User Admin Logo Update
    Route::get('/profile/editLogo', [AdminuserController::class, 'editLogo'])->name('admin.profile.editLogo');
    Route::post('/profile/updateLogo', [AdminuserController::class, 'updateLogo'])->name('admin.profile.updateLogo');

    // User Extension
    Route::get('/profile/extension', [AdminuserController::class, 'extension'])->name('admin.profile.extension');
    Route::post('/profile/updateExtension', [AdminuserController::class, 'updateExtension'])->name('admin.profile.updateExtension');
});
// User Operator Area End

// Admin Area End