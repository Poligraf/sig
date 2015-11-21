<?php 
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('start', 'PagesController@start');
Route::post('start', 'PagesController@storenhi');

Route::get('status', 'PagesController@deliverystatus');

Route::get('chart_update', 'PagesController@stop');
Route::post('chart_update', 'PagesController@updatenhi');

Route::get('query', 'PagesController@query');
Route::post('query', 'PagesController@queryChart');

Route::get('excel_export', 'PagesController@ExcelExport');