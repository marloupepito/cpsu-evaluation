<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/{vue?}',function(){
    return view('welcome');
})->where('vue','[\/\w\.-]*');



Route::post('/logout','App\http\Controllers\UsersController@logout');//check
Route::post('/get_admin','App\http\Controllers\UsersController@get_admin');
Route::post('/get_evaluators','App\http\Controllers\EvaluatorController@get_evaluators'); //check
Route::post('/logout_evaluator','App\http\Controllers\EvaluatorController@logout_evaluator');

Route::post('/get_faculty','App\http\Controllers\FacultyController@get_faculty');//check
Route::post('/get_all_faculty','App\http\Controllers\FacultyController@get_all_faculty');
Route::post('/add_faculty','App\http\Controllers\FacultyController@add_faculty');//check

Route::post('/scan_qrcode','App\http\Controllers\EvaluatorController@scan_qrcode');
Route::post('/evaluator_session','App\http\Controllers\EvaluatorController@evaluator_session');
Route::post('/add_student','App\http\Controllers\EvaluatorController@add_student');

Route::post('/get_questionaire','App\http\Controllers\QuestionaireController@get_questionaire');
Route::put('/edit_questionaire1','App\http\Controllers\QuestionaireController@edit_questionaire1');
Route::put('/edit_questionaire2','App\http\Controllers\QuestionaireController@edit_questionaire2');
Route::put('/edit_questionaire3','App\http\Controllers\QuestionaireController@edit_questionaire3');
Route::put('/edit_questionaire4','App\http\Controllers\QuestionaireController@edit_questionaire4');

Route::post('/submit_form','App\http\Controllers\ResultsController@submit_form');
Route::post('/verify_evaluate','App\http\Controllers\ResultsController@verify_evaluate');
Route::post('/get_all_results','App\http\Controllers\ResultsController@get_all_results');
Route::post('/get_all_results2','App\http\Controllers\ResultsController@get_all_results2'); // check
Route::post('/goto_overall','App\http\Controllers\ResultsController@goto_overall'); // check
Route::post('/get_all_overall','App\http\Controllers\ResultsController@get_all_overall');
Route::post('/counting_data','App\http\Controllers\ResultsController@counting_data');

Route::post('/get_schedule','App\http\Controllers\ScheduleController@get_schedule'); // check
Route::put('/update_schedule','App\http\Controllers\ScheduleController@update_schedule');
Route::put('/change_sem','App\http\Controllers\ScheduleController@change_sem');

Route::post('/user_login','App\http\Controllers\UsersController@user_login');//check
Route::post('/get_all_users','App\http\Controllers\UsersController@get_all_users'); //check
Route::post('/get_all_users2','App\http\Controllers\UsersController@get_all_users2');
Route::post('/add_campus','App\http\Controllers\UsersController@add_campus');

Route::post('/get_subject_loading','App\http\Controllers\SubjectLoadingController@get_subject_loading');//check
Route::post('/add_subject_loaded','App\http\Controllers\SubjectLoadingController@add_subject_loaded');//check
Route::post('/select_course_year','App\http\Controllers\SubjectLoadingController@select_course_year');
Route::post('/get_student_subject_loading','App\http\Controllers\SubjectLoadingController@get_student_subject_loading');//check


Route::post('/qrscanner','App\http\Controllers\ScannerController@qrscanner'); //check

