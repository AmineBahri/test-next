<?php

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
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{

Route::get('/', function () {
    return view('welcome');
});

//customers route

Route::get('/customers', 'CustomerController@index');

Route::post('/customersearch', 'CustomerController@search')->name('customers.search');

Route::get('/addcustomer', 'CustomerController@create');

Route::post('/storecustomer', 'CustomerController@addCustomer');

Route::get('/editcustomer/{id}', 'CustomerController@editCustomer');

Route::post('/updatecustomer/{id}', 'CustomerController@updateCustomer');

Route::get('/deletecustomer/{id}', 'CustomerController@deleteCustomer');

Route::get('/auteurrole', 'CustomerController@auteurCustomer');

Route::get('/importcustomers', 'CustomerController@importCustomers')->name('customers.import');

Route::post('/customersexcel','CustomerController@customersImportedByExcel')->name('customers.excel');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//regions route

Route::resource('regions', 'RegionController');

Route::post('/regionsearch','RegionController@search')->name('regions.search');

Route::get('/auteurregion', 'RegionController@auteurRegion')->name('regions.role');

Route::get('/importregion', 'RegionController@importRegion')->name('regions.import');

Route::post('/regionexcel','RegionController@regionImportedByExcel')->name('regions.excel');

//companies route

Route::resource('companies', 'CompanyController');

Route::post('/companiesearch','CompanyController@search')->name('companies.search');

Route::get('/auteurcompanie', 'CompanyController@auteurCompany')->name('companies.role');

Route::get('/importcompanie', 'CompanyController@importCompany')->name('companies.import');

Route::post('/companieexcel','CompanyController@companyImportedByExcel')->name('companies.excel');

//customerstype route

Route::resource('customerstype', 'CustomerTypeController');

Route::post('/customerstypesearch','CustomerTypeController@search')->name('customerstype.search');

Route::get('/auteurcustomertype', 'CustomerTypeController@auteurCustomerType')->name('customerstype.role');

Route::get('/importcustomertype', 'CustomerTypeController@importCustomerType')->name('customerstype.import');

Route::post('/customertypeexcel','CustomerTypeController@customerTypeImportedByExcel')->name('customerstype.excel');

//municipalites route

Route::resource('municipalites', 'MunicipaliteController');

Route::post('/municipalitesearch','MunicipaliteController@search')->name('municipalites.search');

Route::get('/auteurmunicipalite', 'MunicipaliteController@auteurMunicipalite')->name('municipalites.role');

Route::get('/importmunicipaite', 'MunicipaliteController@importMunicipalite')->name('municipalites.import');

Route::post('/municipaliteexcel','MunicipaliteController@municipaliteImportedByExcel')->name('municipalites.excel');

});

/*Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{ 

});*/