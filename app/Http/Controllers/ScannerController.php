<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluator;
use App\Models\Faculty;
use App\Models\User;
use App\Models\StudentSubjectLoading;
use App\Models\FacultySubjectLoading;
use App\Models\Schedule;
class ScannerController extends Controller
{
     public function qrscanner(Request $request){
         $request->validate([
            'evaluatorid'=>['required'],
            'username'=>['required'],
            'password'=>['required'],
            'campus'=>['required'],
            'campusid'=>['required'],
            'type'=>['required'],
        ]);

         $date = date("Y");
         if($request->type === 'student'){
             $schedule = Schedule::where('campusid','=',$request->campusid)->first();
             $subjectLoadingStudent = StudentSubjectLoading::where([['evaluator_id','=',$request->evaluatorid],['year','=',$date],['semester','=', $schedule->semester],['program', '=' ,null],])->get();

             $loading = FacultySubjectLoading::where([['department','=',$users->course],['year','=',$users->school_year],['semester','=',$users->semester]])->get();

                  // $request->session()->put('evaluator',[
                  //  'evaluatorid' => $request->evaluatorid,
                  //  'username' => $request->username,
                  //  'password' => $request->password,
                  //  'campus' => $request->campus,
                  //  'campusid' => $request->campusid,
                  //  'type' => $request->type,
                  //  'semester' => $schedule->semester,
                  //  'year' => $date,
                  // ]);

                  if(count($subjectLoadingStudent) === 0){
                     foreach ($loading as $load) {
                        StudentSubjectLoading::create([
                            'evaluator_id' => $users->id,
                            'id_number' => $users->id_number,
                            'campusid' => $users->campusid,
                            'subject' => $load->subject,
                            'semester' => $schedule->semester,
                            'department' => $load->department,
                            'section' => $load->section,
                            'year' => $year,
                        ]);
                    }
                   
                }

                return response()->json([
                    'status' => $subjectLoadingStudent
                ]);
         }
        





     }
}
