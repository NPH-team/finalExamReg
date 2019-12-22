<?php

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

/*
Route::get('/', function() {
    return view('index');
});*/

Route::get('/', 'access\ControllerHome@getHome');

/** access */
//login
Route::get('/login', 'access\ControllerLogin@getLogin');
Route::post('/login', 'access\ControllerLogin@checkLogin')-> name('checkLogin');

//logout
Route::get('/logout', 'access\ControllerLogin@logout');

//home
//Route::get('/home', 'access\ControllerHome@getHome');


/** admin */

/**importStudentList */
Route::get('/student', 'admin\ControllerStudent@getImport');
Route::post('/student', 'admin\ControllerStudent@importData');

/**importSubject */
//getSubjectView
Route::get('/subject', 'admin\ControllerSubject@getImport');
//importSubjectList
Route::post('/subject/list', 'admin\ControllerSubject@importData');
//importTestedList
Route::post('/subject/tested', 'admin\ControllerSubjectSelection@importTestedData');
//importNoTestedList
Route::post('/subject/notested', 'admin\ControllerSubjectSelection@importNoTestedData');


/**create exam */
Route::get('/exam', 'admin\ControllerExam@getCreateExam');
Route::post('/exam', 'admin\ControllerExam@createExam');
Route::get('/exam/{maky}', 'admin\ControllerExam@showExam');
Route::post('/exam/makeup', 'admin\ControllerExam@makeupExam') -> name('makeup');
Route::post('/exam/addtest', 'admin\ControllerExam@importTestsData') -> name('createTest');
Route::post('/exam/addexam', 'admin\ControllerExam@importExam') -> name('createExam');

/** student */

Route::get('/home', function () {
    return view('templates.home');
});
Route::get('/inlich', function () {
    return view('templates.inlich');
});
Route::get('/loadata','UserController@index');
Route::get('/pdf','UserController@generate');
Route::get('/print','UserController@print');
Route::get('/demo', function () {
    return view('templates.pdf');
});
Route::post('/store', 'UserController@store');
Route::group(['prefix' => 'schedule'], function () {
    Route::get('/', ['as' => 'schedule.show', 'uses' => 'UserController@index1']);
    Route::get('/checkSameSchedule', ['as' => 'schedule.checkSameSchedule', 'uses' => 'UserController@checkSameSchedule']);
});
