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
Route::get('/exam/{maky}', 'admin\ControllerExam@showExam');



/** student */