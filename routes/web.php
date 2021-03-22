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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//regions route

Route::resource('regions', 'RegionController');

Route::post('/regionsearch','RegionController@search')->name('regions.search');

Route::get('/auteurregion', 'RegionController@auteurRegion')->name('regions.role');

//companies route

Route::resource('companies', 'CompanyController');

Route::post('/companiesearch','CompanyController@search')->name('companies.search');

Route::get('/auteurcompanie', 'CompanyController@auteurCompany')->name('companies.role');

//customerstype route

Route::resource('customerstype', 'CustomerTypeController');

Route::post('/customerstypesearch','CustomerTypeController@search')->name('customerstype.search');

Route::get('/auteurcustomertype', 'CustomerTypeController@auteurCustomerType')->name('customerstype.role');

//municipalites route

Route::resource('municipalites', 'MunicipaliteController');

Route::post('/municipalitesearch','MunicipaliteController@search')->name('municipalites.search');

Route::get('/auteurmunicipalite', 'MunicipaliteController@auteurMunicipalite')->name('municipalites.role');