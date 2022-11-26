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
            'password'=>['required'],
            'campus'=>['required'],
            'campusid'=>['required'],
            'type'=>['required'],
        ]);

         $date = date("Y");
         if($request->type === 'student'){

             $schedule = Schedule::where('campusid','=',$request->campusid)->first();

             $subjectLoadingStudent = StudentSubjectLoading::where([['campusid','=',$request->campusid],['evaluator_id','=',$request->evaluatorid],['year','=',$date],['semester','=', $schedule->semester]])->get();

             $users = Evaluator::where([['id','=',$request->evaluatorid],['password','=',$request->password]])->first();

             $loading = FacultySubjectLoading::where([['campusid','=',$request->campusid],['department','=',$users->course],['year','=',$users->school_year],['semester','=',$users->semester]])->get();


             if(count($subjectLoadingStudent) === 0){

                    if(count($loading) === 0){
                         return response()->json([
                            'status' => 'no teacher',
                        ]);
                    }else{
                       foreach ($loading as $load) {
                            StudentSubjectLoading::create([
                                'evaluator_id' => $users->id,
                                'id_number' => $users->id_number,
                                'campus' => $users->campus,
                                'school_year' => $users->school_year,
                                'campusid' => $users->campusid,
                                'subject' => $load->subject,
                                'semester' => $schedule->semester,
                                'department' => $load->department,
                                'section' => $load->section,
                                'year' => $date,
                            ]);
                        }
                        return response()->json([
                            'status' => 'success',
                        ]);
                    }
                
                    
             }else{

                $checkAvailable = StudentSubjectLoading::where([['campusid','=',$request->campusid],['evaluator_id','=',$request->evaluatorid],['year','=',$date],['semester','=', $schedule->semester],['program','=', null]])->get();

                if(count($checkAvailable) === 0){  
                     return response()->json([
                        'status' => 'done',
                    ]);   
                }else{
                   return response()->json([
                        'status' => 'success',
                    ]);
                }

             }
           
        }

        if($request->type === 'self'){
              return response()->json([
                    'status' => 'success',
                ]);
        }




     }
}
