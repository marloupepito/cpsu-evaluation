<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\http\Controllers\EvaluatorController;
use App\http\Controllers\FacultyController;
use App\http\Controllers\QuestionaireController;
use App\http\Controllers\ResultsController;
use App\http\Controllers\ScheduleController;
use App\http\Controllers\UsersController;
use App\http\Controllers\StudentsController;
use App\http\Controllers\SubjectLoadingController;
use App\http\Controllers\StudentSubjectLoadingController;
use App\http\Controllers\FacultySubjectLoadingController;

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



Route::post('/logout','UsersController@logout');//check
Route::post('/get_admin','UsersController@get_admin');
Route::post('/get_evaluators','EvaluatorController@get_evaluators'); //check
Route::post('/logout_evaluator','EvaluatorController@logout_evaluator');
Route::post('/get_every_evaluator','EvaluatorController@get_every_evaluator');

Route::post('/get_faculty','FacultyController@get_faculty');//check
Route::post('/add_faculty','FacultyController@add_faculty');//check
Route::post('/get_every_faculty','FacultyController@get_every_faculty');//check
Route::post('/get_every_faculty2','FacultyController@get_every_faculty2');//check
Route::post('/faculty_add_signature','FacultyController@faculty_add_signature');//check

Route::post('/evaluator_session','EvaluatorController@evaluator_session');
Route::post('/add_student','EvaluatorController@add_student');

Route::post('/get_questionaire','QuestionaireController@get_questionaire'); //check
Route::post('/edit_questionaire1','QuestionaireController@edit_questionaire1');//check
Route::post('/edit_questionaire2','QuestionaireController@edit_questionaire2');//check
Route::post('/edit_questionaire3','QuestionaireController@edit_questionaire3');//check
Route::post('/edit_questionaire4','QuestionaireController@edit_questionaire4');//check

Route::post('/submit_form','ResultsController@submit_form');
Route::post('/verify_evaluate','ResultsController@verify_evaluate');
Route::post('/get_all_results','ResultsController@get_all_results');
Route::post('/get_all_results2','ResultsController@get_all_results2'); // check
Route::post('/goto_overall','ResultsController@goto_overall'); // check
Route::post('/get_all_overall','ResultsController@get_all_overall'); // check
Route::post('/get_all_overall1','ResultsController@get_all_overall1'); // check
Route::post('/get_all_overall2','ResultsController@get_all_overall2'); // check
Route::post('/get_all_overall3','ResultsController@get_all_overall3'); // check
Route::post('/get_all_overall4','ResultsController@get_all_overall4'); // check
Route::post('/counting_data','ResultsController@counting_data');// check
Route::post('/get_every_result','ResultsController@get_every_result');// check
Route::post('/get_every_result2','ResultsController@get_every_result2');// check

Route::post('/get_schedule','ScheduleController@get_schedule'); // check
Route::put('/update_schedule','ScheduleController@update_schedule');// check
Route::put('/change_sem','ScheduleController@change_sem');// check

Route::post('/user_login','UsersController@user_login');//check
Route::post('/get_all_users','UsersController@get_all_users'); //check
Route::post('/get_all_users2','UsersController@get_all_users2');
Route::post('/add_campus','UsersController@add_campus');

Route::post('/get_subject_loading','SubjectLoadingController@get_subject_loading');//check
Route::post('/add_subject_loaded','SubjectLoadingController@add_subject_loaded');//check
Route::post('/select_course_year','SubjectLoadingController@select_course_year');
Route::post('/get_student_subject_loading','SubjectLoadingController@get_student_subject_loading');//check


Route::post('/qrscanner','ScannerController@qrscanner'); //check
Route::post('/qrscanner2','ScannerController@qrscanner2'); //check

Route::post('/add_student_info','StudentsController@add_student_info'); //check
Route::post('/get_subject_load_from_teacher','StudentsController@get_subject_load_from_teacher'); 
Route::post('/add_student_subject_loading','StudentsController@add_student_subject_loading'); //check
Route::post('/evaluator_session2','StudentsController@evaluator_session2'); //check


Route::post('/get_all_admin_dashboard_data','FacultySubjectLoadingController@get_all_admin_dashboard_data'); //check
Route::post('/get_every_campuses','FacultySubjectLoadingController@get_every_campuses'); //check


Route::post('/get_school_year','FacultySubjectLoadingController@get_school_year');
Route::post('/option_evaluator','FacultySubjectLoadingController@option_evaluator');


