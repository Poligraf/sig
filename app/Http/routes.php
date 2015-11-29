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

//Query is started at /start
Route::get('start', 'PagesController@start');
Route::post('start', 'PagesController@storeNhi');

//Delivery status found under /status
Route::get('status', 'PagesController@deliveryStatus');

//Chart completion under /chart_update
Route::get('chart_update', 'PagesController@stop');
Route::post('chart_update', 'PagesController@updateNhi');

//Query under /query
Route::get('query', 'PagesController@query');
Route::post('query', 'PagesController@queryChart');

/* Export to excel under /export_excel. 
|  Note this exports to csv-Because php is not typed its easier to dump data as a csv
|  and do manipulations in excel as csv. 	
*/
Route::get('excel_export', 'PagesController@ExcelExport');