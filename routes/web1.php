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

   // Route::get('/', 'DashboardController@index')->name('dashboard.index');
   Route::get('/forms', 'PageController@index')->name('forms');
   Route::get('/tables', 'PageController@tables')->name('tables');
   Route::get('/chartjs', 'PageController@chartjs')->name('chartjs');
   Route::get('/typography', 'PageController@typography')->name('typography');
   Route::get('/dropdowns', 'PageController@dropdowns')->name('dropdowns');
   Route::get('/buttons', 'PageController@buttons')->name('buttons');

   Route::get('/', function () {
      return redirect(route('login'));
  });

   Auth::routes();

  Route::get('/home', 'DashboardController@index')->name('dashboard.index');
  //company settings
  Route::get('/company', 'CompanyController@index')->name('company');
  Route::post('/company/store', 'CompanyController@store')->name('company.store');
  //agegroup
  Route::get('/agegroup', 'AgegroupController@index')->name('agegroup');
  Route::get('/agegroup/create', 'AgegroupController@create')->name('agegroup.create');
  Route::post('/agegroup/store', 'AgegroupController@store')->
  name('agegroup.store');

  Route::get('/agegroup/delete/{id}','AgegroupController@delete');
  Route::get('/agegroup/edit/{id}','AgegroupController@edit');
  Route::post('/agegroup/update/{id}','AgegroupController@update')->name('update');


