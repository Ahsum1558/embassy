<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Admin\AdminuserController;
use App\Http\Controllers\Super\CmspageController;
use App\Http\Controllers\Super\FieldController;
use App\Http\Controllers\Super\HeaderfooterController;
use App\Http\Controllers\Super\SuperuserController;
use App\Http\Controllers\Visa\VisaController;
use App\Http\Controllers\Visa\VisatradeController;
use App\Http\Controllers\Visa\VisatypeController;
use App\Http\Controllers\Visa\VisapdfController;
use App\Http\Controllers\Visa\LinkController;
use App\Http\Controllers\Client\DelegateController;
use App\Http\Controllers\Client\CustomerController;
use App\Http\Controllers\Client\CustomerDocomentController;
use App\Http\Controllers\Client\CustomerPassportController;
use App\Http\Controllers\Client\CustomerEmbassyController;
use App\Http\Controllers\Client\CustomerVisaController;
use App\Http\Controllers\Client\CustomerRateController;
use App\Http\Controllers\Client\CustomerPdfController;
use App\Http\Controllers\Client\CustomerMedicalController;
use App\Http\Controllers\Client\SubmissionController;
use App\Http\Controllers\Client\SubmissionCustomerController;
use App\Http\Controllers\Client\CustomerOnceController;
use App\Http\Controllers\Client\CustomerShortController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Delegate Area Start
// Route::middleware(['auth'])->group(function () {
Route::group(['middleware' => 'admin'], function() {
    // Delegate Home Page
    Route::get('/delegate', [DelegateController::class, 'index'])->name('admin.delegate');

    // Delegate Create
    Route::get('/delegate/create', [DelegateController::class, 'create'])->name('admin.delegate.create');
    Route::post('/delegate/store', [DelegateController::class, 'store'])->name('admin.delegate.store');

    // Get Division
    Route::get('/delegate/get', [DelegateController::class, 'getDivision'])->name('admin.delegate.get');
    // Get District
    Route::get('/delegate/getDistrict', [DelegateController::class, 'getDistrict'])->name('admin.delegate.getDistrict');
    // Get City
    Route::get('/delegate/getCity', [DelegateController::class, 'getCity'])->name('admin.delegate.getCity');
    // Get Upzila
    Route::get('/delegate/getUpzila', [DelegateController::class, 'getUpzila'])->name('admin.delegate.getUpzila');

    // Delegate Personal Data
    Route::get('/delegate/show/{id}', [DelegateController::class, 'show'])->name('admin.delegate.show');

    // Delegate Update
    Route::get('/delegate/edit/{id}', [DelegateController::class, 'edit'])->name('admin.delegate.edit');
    Route::post('/delegate/update/{id}', [DelegateController::class, 'update'])->name('admin.delegate.update');

    // Delegate Update Book Referance
    Route::get('/delegate/editBook/{id}', [DelegateController::class, 'editBook'])->name('admin.delegate.editBook');
    Route::post('/delegate/updateBook/{id}', [DelegateController::class, 'updateBook'])->name('admin.delegate.updateBook');

    // Delegate Update E-Mail Address
    Route::get('/delegate/editEmail/{id}', [DelegateController::class, 'editEmail'])->name('admin.delegate.editEmail');
    Route::post('/delegate/updateEmail/{id}', [DelegateController::class, 'updateEmail'])->name('admin.delegate.updateEmail');

    // Delegate Update Image
    Route::get('/delegate/editImage/{id}', [DelegateController::class, 'editImage'])->name('admin.delegate.editImage');
    Route::post('/delegate/updateImage/{id}', [DelegateController::class, 'updateImage'])->name('admin.delegate.updateImage');

    // Delegate Delete
    Route::get('/delegate/destroy/{id}', [DelegateController::class, 'destroy'])->name('admin.delegate.destroy');

    // Delegate Inactive
    Route::post('/delegate/inactive/{id}', [DelegateController::class, 'inactive'])->name('admin.delegate.inactive');

    // Delegate Active
    Route::post('/delegate/active/{id}', [DelegateController::class, 'active'])->name('admin.delegate.active');
});
// Delegate Area End

// Customer Page Area Start
// Primary Info Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Home Page
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer');

    // Customer Create
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('admin.customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('admin.customer.store');

    // Customer Personal Data
    Route::get('/customer/show/{id}', [CustomerController::class, 'show'])->name('admin.customer.show');

    // Customer Update
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');

    // Customer Update Book Referance
    Route::get('/customer/editBook/{id}', [CustomerController::class, 'editBook'])->name('admin.customer.editBook');
    Route::post('/customer/updateBook/{id}', [CustomerController::class, 'updateBook'])->name('admin.customer.updateBook');

    // Customer Update Passport Number
    Route::get('/customer/editPassportNo/{id}', [CustomerController::class, 'editPassportNo'])->name('admin.customer.editPassportNo');
    Route::post('/customer/updatePassportNo/{id}', [CustomerController::class, 'updatePassportNo'])->name('admin.customer.updatePassportNo');

    // Customer Update Image
    Route::get('/customer/editImage/{id}', [CustomerController::class, 'editImage'])->name('admin.customer.editImage');
    Route::post('/customer/updateImage/{id}', [CustomerController::class, 'updateImage'])->name('admin.customer.updateImage');

    // Customer Update Passport Copy
    Route::get('/customer/editPassportCopy/{id}', [CustomerController::class, 'editPassportCopy'])->name('admin.customer.editPassportCopy');
    Route::post('/customer/updatePassportCopy/{id}', [CustomerController::class, 'updatePassportCopy'])->name('admin.customer.updatePassportCopy');

    // Customer Delete
    Route::get('/customer/destroy/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');

    // Customer Inactive
    Route::post('/customer/inactive/{id}', [CustomerController::class, 'inactive'])->name('admin.customer.inactive');

    // Customer Active
    Route::post('/customer/active/{id}', [CustomerController::class, 'active'])->name('admin.customer.active');

    // Fille Print
    Route::get('/customer/print/{id}', [CustomerPdfController::class, 'print'])->name('admin.customer.print');
});
// Primary Info Area End

// Customer Documents Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Documents
    Route::get('/customer/document/{id}', [CustomerDocomentController::class, 'document'])->name('admin.customer.document');
    Route::post('/customer/storeDocuments/{id}', [CustomerDocomentController::class, 'storeDocuments'])->name('admin.customer.storeDocuments');

    // Customer Documents Update
    Route::get('/customer/editDocs/{id}', [CustomerDocomentController::class, 'editDocs'])->name('admin.customer.editDocs');
    Route::post('/customer/updateDocs/{id}', [CustomerDocomentController::class, 'updateDocs'])->name('admin.customer.updateDocs');
});
// Customer Documents Area End

// Customer Passport Area Start
Route::group(['middleware' => 'admin'], function() {
    // Get Division
    Route::get('/customer/getDivision', [CustomerPassportController::class, 'getDivision'])->name('admin.customer.getDivision');
    // Get District
    Route::get('/customer/getDistrict', [CustomerPassportController::class, 'getDistrict'])->name('admin.customer.getDistrict');
    // Get Upzila
    Route::get('/customer/getUpzila', [CustomerPassportController::class, 'getUpzila'])->name('admin.customer.getUpzila');

    // Customer Passport Info
    Route::get('/customer/passport/{id}', [CustomerPassportController::class, 'passport'])->name('admin.customer.passport');
    Route::post('/customer/storePassports/{id}', [CustomerPassportController::class, 'storePassports'])->name('admin.customer.storePassports');

    // Customer Passport Info Update
    Route::get('/customer/editPassport/{id}', [CustomerPassportController::class, 'editPassport'])->name('admin.customer.editPassport');
    Route::post('/customer/updatePassport/{id}', [CustomerPassportController::class, 'updatePassport'])->name('admin.customer.updatePassport');
});
// Customer Passport Area End

// Customer Embassy Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Embassy Info
    Route::get('/customer/embassy/{id}', [CustomerEmbassyController::class, 'embassy'])->name('admin.customer.embassy');
    Route::post('/customer/storeEmbassy/{id}', [CustomerEmbassyController::class, 'storeEmbassy'])->name('admin.customer.storeEmbassy');

    // Customer Embassy Info Update
    Route::get('/customer/editEmbassy/{id}', [CustomerEmbassyController::class, 'editEmbassy'])->name('admin.customer.editEmbassy');
    Route::post('/customer/updateEmbassy/{id}', [CustomerEmbassyController::class, 'updateEmbassy'])->name('admin.customer.updateEmbassy');

    // Customer Mofa Number Update
    Route::get('/customer/editVisa/{id}', [CustomerEmbassyController::class, 'editVisa'])->name('admin.customer.editVisa');
    Route::post('/customer/updateVisa/{id}', [CustomerEmbassyController::class, 'updateVisa'])->name('admin.customer.updateVisa');

     // Customer Mofa Number Update
    Route::get('/customer/editMofa/{id}', [CustomerEmbassyController::class, 'editMofa'])->name('admin.customer.editMofa');
    Route::post('/customer/updateMofa/{id}', [CustomerEmbassyController::class, 'updateMofa'])->name('admin.customer.updateMofa');
});
// Customer Embassy Area End

// Customer Stamped Visa Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Stamped Visa Info
    Route::get('/customer/stampingVisa/{id}', [CustomerVisaController::class, 'stampingVisa'])->name('admin.customer.stampingVisa');
    Route::post('/customer/storeStampingVisa/{id}', [CustomerVisaController::class, 'storeStampingVisa'])->name('admin.customer.storeStampingVisa');

    // Customer Stamped Visa Info Update
    Route::get('/customer/editStamping/{id}', [CustomerVisaController::class, 'editStamping'])->name('admin.customer.editStamping');
    Route::post('/customer/updateStamping/{id}', [CustomerVisaController::class, 'updateStamping'])->name('admin.customer.updateStamping');

    // Customer Stamped Visa Number Update
    Route::get('/customer/editVisano/{id}', [CustomerVisaController::class, 'editVisano'])->name('admin.customer.editVisano');
    Route::post('/customer/updateVisano/{id}', [CustomerVisaController::class, 'updateVisano'])->name('admin.customer.updateVisano');
});
// Customer Stamped Visa Area End

// Customer Working Rate Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Working Rate Info
    Route::get('/customer/rate/{id}', [CustomerRateController::class, 'rate'])->name('admin.customer.rate');
    Route::post('/customer/storeRate/{id}', [CustomerRateController::class, 'storeRate'])->name('admin.customer.storeRate');

    // Customer Working Rate Update
    Route::get('/customer/editRate/{id}', [CustomerRateController::class, 'editRate'])->name('admin.customer.editRate');
    Route::post('/customer/updateRate/{id}', [CustomerRateController::class, 'updateRate'])->name('admin.customer.updateRate');
});
// Customer Working Rate Area End

// Customer Medical Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Medical Info
    Route::get('/customer/medical', [CustomerMedicalController::class, 'medical'])->name('admin.customer.medical');

    // Customer Medical Update
    Route::get('/customer/editMedical/{id}', [CustomerMedicalController::class, 'editMedical'])->name('admin.customer.editMedical');
    Route::post('/customer/updateMedical/{id}', [CustomerMedicalController::class, 'updateMedical'])->name('admin.customer.updateMedical');
});
// Customer Medical Area End

// Embassy Submission Area Start
Route::group(['middleware' => 'admin'], function() {
    // Embassy Submission Home Page
    Route::get('/submission', [SubmissionController::class, 'index'])->name('admin.submission');

    // Embassy Submission Create
    Route::get('/submission/create', [SubmissionController::class, 'create'])->name('admin.submission.create');
    Route::post('/submission/store', [SubmissionController::class, 'store'])->name('admin.submission.store');

    // Embassy Submission Data Details
    Route::get('/submission/show/{id}', [SubmissionController::class, 'show'])->name('admin.submission.show');

    // Embassy Submission Update Info
    Route::get('/submission/edit/{id}', [SubmissionController::class, 'edit'])->name('admin.submission.edit');
    Route::post('/submission/update/{id}', [SubmissionController::class, 'update'])->name('admin.submission.update');

    // Embassy Submission Delete
    Route::get('/submission/destroy/{id}', [SubmissionController::class, 'destroy'])->name('admin.submission.destroy');

    // Embassy Submission Inactive
    Route::post('/submission/inactive/{id}', [SubmissionController::class, 'inactive'])->name('admin.submission.inactive');

    // Embassy Submission Active
    Route::post('/submission/active/{id}', [SubmissionController::class, 'active'])->name('admin.submission.active');

    // Fille Print
    Route::get('/submission/print/{id}', [CustomerPdfController::class, 'SubmissionList'])->name('admin.submission.print');
});
// Embassy Submission Area End

// Customer Submission Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Submission
    Route::get('/submission/statement/{id}', [SubmissionCustomerController::class, 'statement'])->name('admin.submission.statement');
    Route::post('/submission/storeStatement/{id}', [SubmissionCustomerController::class, 'storeStatement'])->name('admin.submission.storeStatement');

    // Customer Submission Display
    Route::get('/submission/display/{id}', [SubmissionCustomerController::class, 'display'])->name('admin.submission.display');

    // Customer Submission Update
    Route::get('/submission/editStatement/{id}', [SubmissionCustomerController::class, 'editStatement'])->name('admin.submission.editStatement');
    Route::post('/submission/updateStatement/{id}', [SubmissionCustomerController::class, 'updateStatement'])->name('admin.submission.updateStatement');

    // Remove Customer From Embassy Submission List
    Route::get('/submission/remove/{id}', [SubmissionCustomerController::class, 'remove'])->name('admin.submission.remove');
});
// Customer Submission Area End

// Customer Once Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Once Info
    Route::get('/customer/insertOnce', [CustomerOnceController::class, 'insertOnce'])->name('admin.customer.insertOnce');

    // Get Division
    Route::get('/customer/getDiv', [CustomerOnceController::class, 'getDiv'])->name('admin.customer.getDiv');
    // Get District
    Route::get('/customer/getDist', [CustomerOnceController::class, 'getDist'])->name('admin.customer.getDist');
    // Get Upzila
    Route::get('/customer/getPs', [CustomerOnceController::class, 'getPs'])->name('admin.customer.getPs');

    // Customer Once Create
    Route::get('/customer/createOnce', [CustomerOnceController::class, 'createOnce'])->name('admin.customer.createOnce');
    Route::post('/customer/storeOnce', [CustomerOnceController::class, 'storeOnce'])->name('admin.customer.storeOnce');
});
// Customer Once Area End

// Customer Short Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Short Info
    Route::get('/customer/insertShort', [CustomerShortController::class, 'insertShort'])->name('admin.customer.insertShort');

    // Customer Short Create
    Route::get('/customer/createShort', [CustomerShortController::class, 'createShort'])->name('admin.customer.createShort');
    Route::post('/customer/storeShort', [CustomerShortController::class, 'storeShort'])->name('admin.customer.storeShort');

    // Customer Primary Short Update
    Route::get('/customer/editShort/{id}', [CustomerShortController::class, 'editShort'])->name('admin.customer.editShort');
    Route::post('/customer/updateShort/{id}', [CustomerShortController::class, 'updateShort'])->name('admin.customer.updateShort');

    // Customer Passport Info Short Update
    Route::get('/customer/editInfoShort/{id}', [CustomerShortController::class, 'editInfoShort'])->name('admin.customer.editInfoShort');
    Route::post('/customer/updateInfoShort/{id}', [CustomerShortController::class, 'updateInfoShort'])->name('admin.customer.updateInfoShort');

    // Get Division
    Route::get('/customer/setDiv', [CustomerShortController::class, 'setDiv'])->name('admin.customer.setDiv');
    // Get District
    Route::get('/customer/setDist', [CustomerShortController::class, 'setDist'])->name('admin.customer.setDist');
    // Get Upzila
    Route::get('/customer/setPs', [CustomerShortController::class, 'setPs'])->name('admin.customer.setPs');

    // Customer Passport Address Short Update
    Route::get('/customer/editAddress/{id}', [CustomerShortController::class, 'editAddress'])->name('admin.customer.editAddress');
    Route::post('/customer/updateAddress/{id}', [CustomerShortController::class, 'updateAddress'])->name('admin.customer.updateAddress');
});
// Customer Short Area End

// Customer Page Area End