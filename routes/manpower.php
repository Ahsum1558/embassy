<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Admin\AdminuserController;
use App\Http\Controllers\Super\CmspageController;
use App\Http\Controllers\Super\FieldarController;
use App\Http\Controllers\Super\FieldbnController;
use App\Http\Controllers\Super\FieldController;
use App\Http\Controllers\Super\HeaderfooterController;
use App\Http\Controllers\Super\SuperuserController;
use App\Http\Controllers\Visa\VisaController;
use App\Http\Controllers\Visa\VisatradeController;
use App\Http\Controllers\Visa\VisatypeController;
use App\Http\Controllers\Visa\VisapdfController;
use App\Http\Controllers\Visa\LinkController;
use App\Http\Controllers\Manpower\ManpowerSubmissionController;
use App\Http\Controllers\Manpower\CustomerManpowerController;
use App\Http\Controllers\Manpower\BmetPaymentController;
use App\Http\Controllers\Manpower\ManpowerPdfController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Manpower Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Manpower Area Start
Route::group(['middleware' => 'admin'], function() {
    // Manpower Home Page
    Route::get('/manpower', [ManpowerSubmissionController::class, 'index'])->name('admin.manpower');

    // Manpower Create
    Route::get('/manpower/create', [ManpowerSubmissionController::class, 'create'])->name('admin.manpower.create');
    Route::post('/manpower/store', [ManpowerSubmissionController::class, 'store'])->name('admin.manpower.store');

    // Manpower Data Details
    Route::get('/manpower/show/{id}', [ManpowerSubmissionController::class, 'show'])->name('admin.manpower.show');

    // Manpower Update Info
    Route::get('/manpower/edit/{id}', [ManpowerSubmissionController::class, 'edit'])->name('admin.manpower.edit');
    Route::post('/manpower/update/{id}', [ManpowerSubmissionController::class, 'update'])->name('admin.manpower.update');

    // Manpower Update Date
    Route::get('/manpower/editDate/{id}', [ManpowerSubmissionController::class, 'editDate'])->name('admin.manpower.editDate');
    Route::post('/manpower/updateDate/{id}', [ManpowerSubmissionController::class, 'updateDate'])->name('admin.manpower.updateDate');

    // Manpower Update Put Up List Serial
    Route::get('/manpower/editNotesheet/{id}', [ManpowerSubmissionController::class, 'editNotesheet'])->name('admin.manpower.editNotesheet');
    Route::post('/manpower/updateNotesheet/{id}', [ManpowerSubmissionController::class, 'updateNotesheet'])->name('admin.manpower.updateNotesheet');

    // Manpower Delete
    Route::get('/manpower/destroy/{id}', [ManpowerSubmissionController::class, 'destroy'])->name('admin.manpower.destroy');

    // Manpower Inactive
    Route::post('/manpower/inactive/{id}', [ManpowerSubmissionController::class, 'inactive'])->name('admin.manpower.inactive');

    // Manpower Active
    Route::post('/manpower/active/{id}', [ManpowerSubmissionController::class, 'active'])->name('admin.manpower.active');
});
// Manpower Area End

// Manpower Payment Area Start
Route::group(['middleware' => 'admin'], function() {
    // Manpower Payment
    Route::get('/manpower/payment/{id}', [BmetPaymentController::class, 'payment'])->name('admin.manpower.payment');
    Route::post('/manpower/storePayment/{id}', [BmetPaymentController::class, 'storePayment'])->name('admin.manpower.storePayment');

    // Manpower Payment Display
    Route::get('/manpower/showPayment/{id}', [BmetPaymentController::class, 'showPayment'])->name('admin.manpower.showPayment');

    // Manpower Payment Update
    Route::get('/manpower/editPayment/{id}', [BmetPaymentController::class, 'editPayment'])->name('admin.manpower.editPayment');
    Route::post('/manpower/updatePayment/{id}', [BmetPaymentController::class, 'updatePayment'])->name('admin.manpower.updatePayment');

    // Manpower Income Tax Pay Order Number Update
    Route::get('/manpower/editTax/{id}', [BmetPaymentController::class, 'editTax'])->name('admin.manpower.editTax');
    Route::post('/manpower/updateTax/{id}', [BmetPaymentController::class, 'updateTax'])->name('admin.manpower.updateTax');

    // Manpower Welfare Insurance Pay Order Number Update
    Route::get('/manpower/editInsurance/{id}', [BmetPaymentController::class, 'editInsurance'])->name('admin.manpower.editInsurance');
    Route::post('/manpower/updateInsurance/{id}', [BmetPaymentController::class, 'updateInsurance'])->name('admin.manpower.updateInsurance');

    // Manpower Smart Card Pay Order Number Update
    Route::get('/manpower/editCard/{id}', [BmetPaymentController::class, 'editCard'])->name('admin.manpower.editCard');
    Route::post('/manpower/updateCard/{id}', [BmetPaymentController::class, 'updateCard'])->name('admin.manpower.updateCard');

    // Remove Payment From Manpower
    Route::get('/manpower/delete/{id}', [BmetPaymentController::class, 'delete'])->name('admin.manpower.delete');

    // BMET Payment Inactive
    Route::post('/manpower/inactivePayment/{id}', [BmetPaymentController::class, 'inactivePayment'])->name('admin.manpower.inactivePayment');

    // BMET Payment Active
    Route::post('/manpower/activePayment/{id}', [BmetPaymentController::class, 'activePayment'])->name('admin.manpower.activePayment');
});
// Manpower Payment Area End

// Customer Manpower Area Start
Route::group(['middleware' => 'admin'], function() {
    // Customer Stamped Visa Info
    Route::get('/manpower/stampingVisa/{id}', [CustomerManpowerController::class, 'stampingVisa'])->name('admin.manpower.stampingVisa');
    Route::post('/manpower/storeStampingVisa/{id}', [CustomerManpowerController::class, 'storeStampingVisa'])->name('admin.manpower.storeStampingVisa');
    
    // Customer Manpower
    Route::get('/manpower/statement/{id}', [CustomerManpowerController::class, 'statement'])->name('admin.manpower.statement');
    Route::post('/manpower/storeStatement/{id}', [CustomerManpowerController::class, 'storeStatement'])->name('admin.manpower.storeStatement');

    // Customer Manpower Display
    Route::get('/manpower/display/{id}', [CustomerManpowerController::class, 'display'])->name('admin.manpower.display');

    // Customer Manpower Update
    Route::get('/manpower/editStatement/{id}', [CustomerManpowerController::class, 'editStatement'])->name('admin.manpower.editStatement');
    Route::post('/manpower/updateStatement/{id}', [CustomerManpowerController::class, 'updateStatement'])->name('admin.manpower.updateStatement');

    // Customer Manpower Finger Update
    Route::get('/manpower/editFinger/{id}', [CustomerManpowerController::class, 'editFinger'])->name('admin.manpower.editFinger');
    Route::post('/manpower/updateFinger/{id}', [CustomerManpowerController::class, 'updateFinger'])->name('admin.manpower.updateFinger');

    // Remove Customer From Manpower List
    Route::get('/manpower/remove/{id}', [CustomerManpowerController::class, 'remove'])->name('admin.manpower.remove');
});
// Customer Manpower Area End

// Manpower Print Area Start
Route::group(['middleware' => 'admin'], function() {
    // Notesheet
    Route::get('/manpower/printNotesheet/{id}', [ManpowerPdfController::class, 'printNotesheet'])->name('admin.manpower.printNotesheet');

    // Customer Contact Paper
    Route::get('/manpower/printContact/{id}', [ManpowerPdfController::class, 'printContact'])->name('admin.manpower.printContact');

    // Customer Application Letter
    Route::get('/manpower/printLetter/{id}', [ManpowerPdfController::class, 'printLetter'])->name('admin.manpower.printLetter');

    // Customer Undertaking
    Route::get('/manpower/printUndertaking/{id}', [ManpowerPdfController::class, 'printUndertaking'])->name('admin.manpower.printUndertaking');

    // Customer Data Sheet
    Route::get('/manpower/printData/{id}', [ManpowerPdfController::class, 'printData'])->name('admin.manpower.printData');

    // Put Up List
    Route::get('/manpower/printPutup/{id}', [ManpowerPdfController::class, 'printPutup'])->name('admin.manpower.printPutup');

    Route::get('/manpower/printPutupUpdate/{id}', [ManpowerPdfController::class, 'printPutupUpdate'])->name('admin.manpower.printPutupUpdate');
    Route::get('/manpower/printPutupWord/{id}', [ManpowerPdfController::class, 'printPutupWord'])->name('admin.manpower.printPutupWord');

    Route::get('/manpower/printNotesheetUpdate/{id}', [ManpowerPdfController::class, 'printNotesheetUpdate'])->name('admin.manpower.printNotesheetUpdate');
    
    Route::get('/manpower/printLetterUpdate/{id}', [ManpowerPdfController::class, 'printLetterUpdate'])->name('admin.manpower.printLetterUpdate');
});
// Manpower Print Area End