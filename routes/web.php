<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminuserController;
use App\Http\Controllers\Super\SuperuserController;
use App\Http\Controllers\Locaton\CountryController;
use App\Http\Controllers\Locaton\DivisionController;
use App\Http\Controllers\Locaton\DistrictController;
use App\Http\Controllers\Locaton\PolicestationController;
use App\Http\Controllers\Locaton\IssueController;
use App\Http\Controllers\Locaton\CityController;
use App\Http\Controllers\Locaton\AdminCountryController;
use App\Http\Controllers\Locaton\AdminDivisionController;
use App\Http\Controllers\Locaton\AdminDistrictController;
use App\Http\Controllers\Locaton\AdminPolicestationController;
use App\Http\Controllers\Locaton\AdminIssueController;
use App\Http\Controllers\Locaton\AdminCityController;
use App\Http\Controllers\Visa\VisaController;
use App\Http\Controllers\Visa\VisatradeController;
use App\Http\Controllers\Visa\VisatypeController;
use App\Http\Controllers\Visa\VisapdfController;
use App\Http\Controllers\Visa\LinkController;
use App\Http\Controllers\Client\AgeCalculatorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

// Location Page Area Start

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


// Country Area Start
Route::group(['middleware' => 'super'], function() {
    // Country Home Page
    Route::get('/super/country', [CountryController::class, 'index'])->name('super.country');

    Route::get('/super/country/create', [CountryController::class, 'create'])->name('super.country.create');
    Route::post('/super/country/store', [CountryController::class, 'store'])->name('super.country.store');

    Route::get('/super/country/show/{id}', [CountryController::class, 'show'])->name('super.country.show');

    // Country Name Update
    Route::get('/super/country/edit/{id}', [CountryController::class, 'edit'])->name('super.country.edit');
    Route::post('/super/country/update/{id}', [CountryController::class, 'update'])->name('super.country.update');

    // Country Nationality Update
    Route::get('/super/country/editnative/{id}', [CountryController::class, 'editNationality'])->name('super.country.editnative');
    Route::post('/super/country/updateNationality/{id}', [CountryController::class, 'updateNationality'])->name('super.country.updateNationality');

    // Country Currency Update
    Route::get('/super/country/editCurrency/{id}', [CountryController::class, 'editCurrency'])->name('super.country.editCurrency');
    Route::post('/super/country/updateCurrency/{id}', [CountryController::class, 'updateCurrency'])->name('super.country.updateCurrency');

    // Country Delete
    Route::get('/super/country/destroy/{id}', [CountryController::class, 'destroy'])->name('super.country.destroy');

    // Country Inactive
    Route::post('/super/country/inactive/{id}', [CountryController::class, 'inactive'])->name('super.country.inactive');

    // Country Active
    Route::post('/super/country/active/{id}', [CountryController::class, 'active'])->name('super.country.active');
});
// Country Area End

// Division Area Start
Route::group(['middleware' => 'super'], function() {
    // Division Home Page
    Route::get('/super/division', [DivisionController::class, 'index'])->name('super.division');

    // Division Create
    Route::get('/super/division/create', [DivisionController::class, 'create'])->name('super.division.create');
    Route::post('/super/division/store', [DivisionController::class, 'store'])->name('super.division.store');

    Route::get('/super/division/show/{id}', [DivisionController::class, 'show'])->name('super.division.show');

    // Division Name Update
    Route::get('/super/division/edit/{id}', [DivisionController::class, 'edit'])->name('super.division.edit');
    Route::post('/super/division/update/{id}', [DivisionController::class, 'update'])->name('super.division.update');

    // Division Info Update
    Route::get('/super/division/editInfo/{id}', [DivisionController::class, 'editInfo'])->name('super.division.editInfo');
    Route::post('/super/division/updateInfo/{id}', [DivisionController::class, 'updateInfo'])->name('super.division.updateInfo');

    // Division Delete
    Route::get('/super/division/destroy/{id}', [DivisionController::class, 'destroy'])->name('super.division.destroy');

    // Division Inactive
    Route::post('/super/division/inactive/{id}', [DivisionController::class, 'inactive'])->name('super.division.inactive');

    // Division Active
    Route::post('/super/division/active/{id}', [DivisionController::class, 'active'])->name('super.division.active');
});
// Division Area End

// District Area Start
Route::group(['middleware' => 'super'], function() {
    // District Home Page
    Route::get('/super/district', [DistrictController::class, 'index'])->name('super.district');

    // District Create
    Route::get('/super/district/create', [DistrictController::class, 'create'])->name('super.district.create');
    Route::post('/super/district/store', [DistrictController::class, 'store'])->name('super.district.store');

    Route::get('/super/district/get', [DistrictController::class, 'getDivision'])->name('super.district.get');

    Route::get('/super/district/show/{id}', [DistrictController::class, 'show'])->name('super.district.show');

    // District Name Update
    Route::get('/super/district/edit/{id}', [DistrictController::class, 'edit'])->name('super.district.edit');
    Route::post('/super/district/update/{id}', [DistrictController::class, 'update'])->name('super.district.update');

    // District Info Update
    Route::get('/super/district/editInfo/{id}', [DistrictController::class, 'editInfo'])->name('super.district.editInfo');
    Route::post('/super/district/updateInfo/{id}', [DistrictController::class, 'updateInfo'])->name('super.district.updateInfo');

    // District Delete
    Route::get('/super/district/destroy/{id}', [DistrictController::class, 'destroy'])->name('super.district.destroy');

    // District Inactive
    Route::post('/super/district/inactive/{id}', [DistrictController::class, 'inactive'])->name('super.district.inactive');

    // District Active
    Route::post('/super/district/active/{id}', [DistrictController::class, 'active'])->name('super.district.active');
});
// District Area End

// Police Station Area Start
Route::group(['middleware' => 'super'], function() {
    // Police Station Home Page
    Route::get('/super/upzila', [PolicestationController::class, 'index'])->name('super.policestation');

    // Police Station Create
    Route::get('/super/upzila/create', [PolicestationController::class, 'create'])->name('super.policestation.create');
    Route::post('/super/upzila/store', [PolicestationController::class, 'store'])->name('super.policestation.store');

    Route::get('/super/upzila/get', [PolicestationController::class, 'getDivision'])->name('super.policestation.get');
    Route::get('/super/upzila/getDistrict', [PolicestationController::class, 'getDistrict'])->name('super.policestation.getDistrict');

    Route::get('/super/upzila/show/{id}', [PolicestationController::class, 'show'])->name('super.policestation.show');

    // Police Station Name Update
    Route::get('/super/upzila/edit/{id}', [PolicestationController::class, 'edit'])->name('super.policestation.edit');
    Route::post('/super/upzila/update/{id}', [PolicestationController::class, 'update'])->name('super.policestation.update');

    // Police Station Info Update
    Route::get('/super/upzila/editInfo/{id}', [PolicestationController::class, 'editInfo'])->name('super.policestation.editInfo');
    Route::post('/super/upzila/updateInfo/{id}', [PolicestationController::class, 'updateInfo'])->name('super.policestation.updateInfo');

    // Police Station Delete
    Route::get('/super/upzila/destroy/{id}', [PolicestationController::class, 'destroy'])->name('super.policestation.destroy');

    // Police Station Inactive
    Route::post('/super/upzila/inactive/{id}', [PolicestationController::class, 'inactive'])->name('super.policestation.inactive');

    // Police Station Active
    Route::post('/super/upzila/active/{id}', [PolicestationController::class, 'active'])->name('super.policestation.active');
});
// Police Station Area End

// Issue Place Area Start
Route::group(['middleware' => 'super'], function() {
    // Issue Place Home Page
    Route::get('/super/issue', [IssueController::class, 'index'])->name('super.issue');

    // Issue Place Create
    Route::get('/super/issue/create', [IssueController::class, 'create'])->name('super.issue.create');
    Route::post('/super/issue/store', [IssueController::class, 'store'])->name('super.issue.store');

    Route::get('/super/issue/show/{id}', [IssueController::class, 'show'])->name('super.issue.show');

    // Issue Place Name Update
    Route::get('/super/issue/edit/{id}', [IssueController::class, 'edit'])->name('super.issue.edit');
    Route::post('/super/issue/update/{id}', [IssueController::class, 'update'])->name('super.issue.update');

    // Issue Place Info Update
    Route::get('/super/issue/editInfo/{id}', [IssueController::class, 'editInfo'])->name('super.issue.editInfo');
    Route::post('/super/issue/updateInfo/{id}', [IssueController::class, 'updateInfo'])->name('super.issue.updateInfo');

    // Issue Place Delete
    Route::get('/super/issue/destroy/{id}', [IssueController::class, 'destroy'])->name('super.issue.destroy');

    // Issue Place Inactive
    Route::post('/super/issue/inactive/{id}', [IssueController::class, 'inactive'])->name('super.issue.inactive');

    // Issue Place Active
    Route::post('/super/issue/active/{id}', [IssueController::class, 'active'])->name('super.issue.active');
});
// Issue Place Area End

// City Area Start
Route::group(['middleware' => 'super'], function() {
    // City Home Page
    Route::get('/super/city', [CityController::class, 'index'])->name('super.city');

    // City Create
    Route::get('/super/city/create', [CityController::class, 'create'])->name('super.city.create');
    Route::post('/super/city/store', [CityController::class, 'store'])->name('super.city.store');

    Route::get('/super/city/get', [CityController::class, 'getDivision'])->name('super.city.get');
    Route::get('/super/city/getDistrict', [CityController::class, 'getDistrict'])->name('super.city.getDistrict');

    Route::get('/super/city/show/{id}', [CityController::class, 'show'])->name('super.city.show');

    // City Name Update
    Route::get('/super/city/edit/{id}', [CityController::class, 'edit'])->name('super.city.edit');
    Route::post('/super/city/update/{id}', [CityController::class, 'update'])->name('super.city.update');

    // City Info Update
    Route::get('/super/city/editInfo/{id}', [CityController::class, 'editInfo'])->name('super.city.editInfo');
    Route::post('/city/updateInfo/{id}', [CityController::class, 'updateInfo'])->name('super.city.updateInfo');

    // City Delete
    Route::get('/super/city/destroy/{id}', [CityController::class, 'destroy'])->name('super.city.destroy');

    // City Inactive
    Route::post('/super/city/inactive/{id}', [CityController::class, 'inactive'])->name('super.city.inactive');

    // City Active
    Route::post('/super/city/active/{id}', [CityController::class, 'active'])->name('super.city.active');
});
// City Area End
// Location Page Area End

// Admin Location Page Area Start
// Country Area Start
Route::group(['middleware' => 'admin'], function() {
    // Country Home Page
    Route::get('/country', [AdminCountryController::class, 'index'])->name('admin.country');

     Route::get('/country/create', [AdminCountryController::class, 'create'])->name('admin.country.create');
    Route::post('/country/store', [AdminCountryController::class, 'store'])->name('admin.country.store');

    Route::get('/country/show/{id}', [AdminCountryController::class, 'show'])->name('admin.country.show');

    // Country Name Update
    Route::get('/country/edit/{id}', [AdminCountryController::class, 'edit'])->name('admin.country.edit');
    Route::post('/country/update/{id}', [AdminCountryController::class, 'update'])->name('admin.country.update');

    // Country Nationality Update
    Route::get('/country/editnative/{id}', [AdminCountryController::class, 'editNationality'])->name('admin.country.editnative');
    Route::post('/country/updateNationality/{id}', [AdminCountryController::class, 'updateNationality'])->name('admin.country.updateNationality');

    // Country Currency Update
    Route::get('/country/editCurrency/{id}', [AdminCountryController::class, 'editCurrency'])->name('admin.country.editCurrency');
    Route::post('/country/updateCurrency/{id}', [AdminCountryController::class, 'updateCurrency'])->name('admin.country.updateCurrency');

    // Country Delete
    Route::get('/country/destroy/{id}', [AdminCountryController::class, 'destroy'])->name('admin.country.destroy');

    // Country Inactive
    Route::post('/country/inactive/{id}', [AdminCountryController::class, 'inactive'])->name('admin.country.inactive');

    // Country Active
    Route::post('/country/active/{id}', [AdminCountryController::class, 'active'])->name('admin.country.active');
});
// Country Area End

// Division Area Start
Route::group(['middleware' => 'admin'], function() {
    // Division Home Page
    Route::get('/division', [AdminDivisionController::class, 'index'])->name('admin.division');

    // Division Create
    Route::get('/division/create', [AdminDivisionController::class, 'create'])->name('admin.division.create');
    Route::post('/division/store', [AdminDivisionController::class, 'store'])->name('admin.division.store');

    Route::get('/division/show/{id}', [AdminDivisionController::class, 'show'])->name('admin.division.show');

    // Division Name Update
    Route::get('/division/edit/{id}', [AdminDivisionController::class, 'edit'])->name('admin.division.edit');
    Route::post('/division/update/{id}', [AdminDivisionController::class, 'update'])->name('admin.division.update');

    // Division Info Update
    Route::get('/division/editInfo/{id}', [AdminDivisionController::class, 'editInfo'])->name('admin.division.editInfo');
    Route::post('/division/updateInfo/{id}', [AdminDivisionController::class, 'updateInfo'])->name('admin.division.updateInfo');

    // Division Delete
    Route::get('/division/destroy/{id}', [AdminDivisionController::class, 'destroy'])->name('admin.division.destroy');

    // Division Inactive
    Route::post('/division/inactive/{id}', [AdminDivisionController::class, 'inactive'])->name('admin.division.inactive');

    // Division Active
    Route::post('/division/active/{id}', [AdminDivisionController::class, 'active'])->name('admin.division.active');
});
// Division Area End

// District Area Start
Route::group(['middleware' => 'admin'], function() {
    // District Home Page
    Route::get('/district', [AdminDistrictController::class, 'index'])->name('admin.district');

    // District Create
    Route::get('/district/create', [AdminDistrictController::class, 'create'])->name('admin.district.create');
    Route::post('/district/store', [AdminDistrictController::class, 'store'])->name('admin.district.store');

    Route::get('/district/get', [AdminDistrictController::class, 'getDivision'])->name('admin.district.get');

    Route::get('/district/show/{id}', [AdminDistrictController::class, 'show'])->name('admin.district.show');

    // District Name Update
    Route::get('/district/edit/{id}', [AdminDistrictController::class, 'edit'])->name('admin.district.edit');
    Route::post('/district/update/{id}', [AdminDistrictController::class, 'update'])->name('admin.district.update');

    // District Info Update
    Route::get('/district/editInfo/{id}', [AdminDistrictController::class, 'editInfo'])->name('admin.district.editInfo');
    Route::post('/district/updateInfo/{id}', [AdminDistrictController::class, 'updateInfo'])->name('admin.district.updateInfo');

    // District Delete
    Route::get('/district/destroy/{id}', [AdminDistrictController::class, 'destroy'])->name('admin.district.destroy');

    // District Inactive
    Route::post('/district/inactive/{id}', [AdminDistrictController::class, 'inactive'])->name('admin.district.inactive');

    // District Active
    Route::post('/district/active/{id}', [AdminDistrictController::class, 'active'])->name('admin.district.active');
});
// District Area End

// Police Station Area Start
Route::group(['middleware' => 'admin'], function() {
    // Police Station Home Page
    Route::get('/upzila', [AdminPolicestationController::class, 'index'])->name('admin.policestation');

    // Police Station Create
    Route::get('/upzila/create', [AdminPolicestationController::class, 'create'])->name('admin.policestation.create');
    Route::post('/upzila/store', [AdminPolicestationController::class, 'store'])->name('admin.policestation.store');

    Route::get('/upzila/get', [AdminPolicestationController::class, 'getDivision'])->name('admin.policestation.get');
    Route::get('/upzila/getDistrict', [AdminPolicestationController::class, 'getDistrict'])->name('admin.policestation.getDistrict');

    Route::get('/upzila/show/{id}', [AdminPolicestationController::class, 'show'])->name('admin.policestation.show');

    // Police Station Name Update
    Route::get('/upzila/edit/{id}', [AdminPolicestationController::class, 'edit'])->name('admin.policestation.edit');
    Route::post('/upzila/update/{id}', [AdminPolicestationController::class, 'update'])->name('admin.policestation.update');

    // Police Station Info Update
    Route::get('/upzila/editInfo/{id}', [AdminPolicestationController::class, 'editInfo'])->name('admin.policestation.editInfo');
    Route::post('/upzila/updateInfo/{id}', [AdminPolicestationController::class, 'updateInfo'])->name('admin.policestation.updateInfo');

    // Police Station Delete
    Route::get('/upzila/destroy/{id}', [AdminPolicestationController::class, 'destroy'])->name('admin.policestation.destroy');

    // Police Station Inactive
    Route::post('/upzila/inactive/{id}', [AdminPolicestationController::class, 'inactive'])->name('admin.policestation.inactive');

    // Police Station Active
    Route::post('/upzila/active/{id}', [AdminPolicestationController::class, 'active'])->name('admin.policestation.active');
});
// Police Station Area End

// Issue Place Area Start
Route::group(['middleware' => 'admin'], function() {
    // Issue Place Home Page
    Route::get('/issue', [AdminIssueController::class, 'index'])->name('admin.issue');

    // Issue Place Create
    Route::get('/issue/create', [AdminIssueController::class, 'create'])->name('admin.issue.create');
    Route::post('/issue/store', [AdminIssueController::class, 'store'])->name('admin.issue.store');

    Route::get('/issue/show/{id}', [AdminIssueController::class, 'show'])->name('admin.issue.show');

    // Issue Place Name Update
    Route::get('/issue/edit/{id}', [AdminIssueController::class, 'edit'])->name('admin.issue.edit');
    Route::post('/issue/update/{id}', [AdminIssueController::class, 'update'])->name('admin.issue.update');

    // Issue Place Info Update
    Route::get('/issue/editInfo/{id}', [AdminIssueController::class, 'editInfo'])->name('admin.issue.editInfo');
    Route::post('/issue/updateInfo/{id}', [AdminIssueController::class, 'updateInfo'])->name('admin.issue.updateInfo');

    // Issue Place Delete
    Route::get('/issue/destroy/{id}', [AdminIssueController::class, 'destroy'])->name('admin.issue.destroy');

    // Issue Place Inactive
    Route::post('/issue/inactive/{id}', [AdminIssueController::class, 'inactive'])->name('admin.issue.inactive');

    // Issue Place Active
    Route::post('/issue/active/{id}', [AdminIssueController::class, 'active'])->name('admin.issue.active');
});
// Issue Place Area End

// City Area Start
Route::group(['middleware' => 'admin'], function() {
    // City Home Page
    Route::get('/city', [AdminCityController::class, 'index'])->name('admin.city');

    // City Create
    Route::get('/city/create', [AdminCityController::class, 'create'])->name('admin.city.create');
    Route::post('/city/store', [AdminCityController::class, 'store'])->name('admin.city.store');

    Route::get('/city/get', [AdminCityController::class, 'getDivision'])->name('admin.city.get');
    Route::get('/city/getDistrict', [AdminCityController::class, 'getDistrict'])->name('admin.city.getDistrict');

    Route::get('/city/show/{id}', [AdminCityController::class, 'show'])->name('admin.city.show');

    // City Name Update
    Route::get('/city/edit/{id}', [AdminCityController::class, 'edit'])->name('admin.city.edit');
    Route::post('/city/update/{id}', [AdminCityController::class, 'update'])->name('admin.city.update');

    // City Info Update
    Route::get('/city/editInfo/{id}', [AdminCityController::class, 'editInfo'])->name('admin.city.editInfo');
    Route::post('/city/updateInfo/{id}', [AdminCityController::class, 'updateInfo'])->name('admin.city.updateInfo');

    // City Delete
    Route::get('/city/destroy/{id}', [AdminCityController::class, 'destroy'])->name('admin.city.destroy');

    // City Inactive
    Route::post('/city/inactive/{id}', [AdminCityController::class, 'inactive'])->name('admin.city.inactive');

    // City Active
    Route::post('/city/active/{id}', [AdminCityController::class, 'active'])->name('admin.city.active');
});
// City Area End

// Visa Type Area Start
Route::group(['middleware' => 'admin'], function() {
    // Visa Type Home Page
    Route::get('/visaType', [VisatypeController::class, 'index'])->name('admin.visaType');

    // Visa Type Create
    Route::post('/visaType/store', [VisatypeController::class, 'store'])->name('admin.visaType.store');

    Route::get('/visaType/show/{id}', [VisatypeController::class, 'show'])->name('admin.visaType.show');

    // Visa Type Name Update
    Route::get('/visaType/edit/{id}', [VisatypeController::class, 'edit'])->name('admin.visaType.edit');
    Route::post('/visaType/update/{id}', [VisatypeController::class, 'update'])->name('admin.visaType.update');

    // Visa Type Delete
    Route::get('/visaType/destroy/{id}', [VisatypeController::class, 'destroy'])->name('admin.visaType.destroy');

    // Visa Type Inactive
    Route::post('/visaType/inactive/{id}', [VisatypeController::class, 'inactive'])->name('admin.visaType.inactive');

    // Visa Type Active
    Route::post('/visaType/active/{id}', [VisatypeController::class, 'active'])->name('admin.visaType.active');
});
// Visa Type Area End

// Visa Trade Area Start
Route::group(['middleware' => 'admin'], function() {
    // Visa Trade Home Page
    Route::get('/visaTrade', [VisatradeController::class, 'index'])->name('admin.visaTrade');

    // Visa Trade Create
    Route::post('/visaTrade/store', [VisatradeController::class, 'store'])->name('admin.visaTrade.store');

    Route::get('/visaTrade/show/{id}', [VisatradeController::class, 'show'])->name('admin.visaTrade.show');

    // Visa Trade Name Update
    Route::get('/visaTrade/edit/{id}', [VisatradeController::class, 'edit'])->name('admin.visaTrade.edit');
    Route::post('/visaTrade/update/{id}', [VisatradeController::class, 'update'])->name('admin.visaTrade.update');

    // Visa Trade Delete
    Route::get('/visaTrade/destroy/{id}', [VisatradeController::class, 'destroy'])->name('admin.visaTrade.destroy');

    // Visa Trade Inactive
    Route::post('/visaTrade/inactive/{id}', [VisatradeController::class, 'inactive'])->name('admin.visaTrade.inactive');

    // Visa Trade Active
    Route::post('/visaTrade/active/{id}', [VisatradeController::class, 'active'])->name('admin.visaTrade.active');
});
// Visa Trade Area End

// Visa Area Start
Route::group(['middleware' => 'admin'], function() {
    // Visa Home Page
    Route::get('/visa', [VisaController::class, 'index'])->name('admin.visa');

    // Visa Create
    Route::get('/visa/create', [VisaController::class, 'create'])->name('admin.visa.create');
    Route::post('/visa/store', [VisaController::class, 'store'])->name('admin.visa.store');

    Route::get('/visa/show/{id}', [VisaController::class, 'show'])->name('admin.visa.show');

    // Visa Update
    Route::get('/visa/edit/{id}', [VisaController::class, 'edit'])->name('admin.visa.edit');
    Route::post('/visa/update/{id}', [VisaController::class, 'update'])->name('admin.visa.update');

    // Visa Number Update
    Route::get('/visa/editVisa/{id}', [VisaController::class, 'editVisa'])->name('admin.visa.editVisa');
    Route::post('/visa/updateVisa/{id}', [VisaController::class, 'updateVisa'])->name('admin.visa.updateVisa');

    // Visa Delete
    Route::get('/visa/destroy/{id}', [VisaController::class, 'destroy'])->name('admin.visa.destroy');

    // Visa Inactive
    Route::post('/visa/inactive/{id}', [VisaController::class, 'inactive'])->name('admin.visa.inactive');

    // Visa Active
    Route::post('/visa/active/{id}', [VisaController::class, 'active'])->name('admin.visa.active');

    Route::get('/visa/pdf', [VisapdfController::class, 'getpdf'])->name('admin.visa.pdf');

    Route::get('/visa/Details/{id}', [VisapdfController::class, 'getVisaPdf'])->name('admin.visa.Details');
});
// Visa Area End

// Important Links Area Start
Route::group(['middleware' => 'admin'], function() {
    // Link Home Page
    Route::get('/link', [LinkController::class, 'index'])->name('admin.link');

    // Link Create
    Route::get('/link/create', [LinkController::class, 'create'])->name('admin.link.create');
    Route::post('/link/store', [LinkController::class, 'store'])->name('admin.link.store');

    Route::get('/link/show/{id}', [LinkController::class, 'show'])->name('admin.link.show');

    // Link Info Update
    Route::get('/link/edit/{id}', [LinkController::class, 'edit'])->name('admin.link.edit');
    Route::post('/link/update/{id}', [LinkController::class, 'update'])->name('admin.link.update');

    // Link Url Update
    Route::get('/link/editUrl/{id}', [LinkController::class, 'editUrl'])->name('admin.link.editUrl');
    Route::post('/link/updateUrl/{id}', [LinkController::class, 'updateUrl'])->name('admin.link.updateUrl');

    // Link Delete
    Route::get('/link/destroy/{id}', [LinkController::class, 'destroy'])->name('admin.link.destroy');

    // Link Inactive
    Route::post('/link/inactive/{id}', [LinkController::class, 'inactive'])->name('admin.link.inactive');

    // Link Active
    Route::post('/link/active/{id}', [LinkController::class, 'active'])->name('admin.link.active');

    // Age Calculator Page
    Route::get('/calculateAge', [AgeCalculatorController::class, 'calculateAge'])->name('admin.calculateAge');
});
// Important Links Area End

// Admin Location Page Area End





// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
