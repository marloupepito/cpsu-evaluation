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
                        $request->session()->put('evaluatorid', $request->evaluatorid);
                        $request->session()->put('type', $request->type);
                        $request->session()->put('campusid', $request->campusid);
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
                    $request->session()->put('evaluatorid', $request->evaluatorid);
                        $request->session()->put('type', $request->type);
                        $request->session()->put('campusid', $request->campusid);
                   return response()->json([
                        'status' => 'success',
                    ]);
                }

             }
           
        } else if($request->type === 'peer' || $request->type === 'supervisor'){
            $schedule = Schedule::where('campusid','=',$request->campusid)->first();

             $subjectLoadingStudent = StudentSubjectLoading::where([['program','=',null],['subject','=',null],['campusid','=',$request->campusid],['evaluator_id','=',$request->evaluatorid]])->get();

             $faculty = Faculty::where([['id','=',$request->evaluatorid],['password','=',$request->password]])->first();

             $faculties = Faculty::where([['id','<>',$request->evaluatorid],['campusid','=',$request->campusid],['department','=', $faculty->department]])->get();

             if($request->campusid == $faculty->campusid){
                if(count($subjectLoadingStudent) === 0){
                        
                        if($faculty->academic_rank === 'admin' && $request->type === 'supervisor'){
                            $allfaculties = Faculty::where([['id','<>',$request->evaluatorid],['campusid','=',$request->campusid]])->get();
                            $request->session()->put('evaluatorid', $request->evaluatorid);
                        $request->session()->put('type', $request->type);
                        $request->session()->put('campusid', $request->campusid);
                            foreach ($allfaculties as $load) {
                                StudentSubjectLoading::create([
                                    'evaluator_id' => $request->evaluatorid,
                                    'id_number' => $load->id_number,
                                    'campus' => $load->campus,
                                    'school_year' => $load->school_year,
                                    'campusid' => $load->campusid,
                                    'subject' => $load->subject,
                                    'semester' => $schedule->semester,
                                    'department' => $load->department,
                                    'section' => $load->section,
                                    'year' => $date,
                                ]);
                            }
                             return response()->json([
                                'status' =>'success',
                            ]);

                         }else{

                            if($request->type === 'supervisor'){
                                return response()->json([
                                    'status' =>'error',
                                ]);
                            }else{
                                $request->session()->put('evaluatorid', $request->evaluatorid);
                        $request->session()->put('type', $request->type);
                        $request->session()->put('campusid', $request->campusid);
                                foreach ($faculties as $load) {
                                    StudentSubjectLoading::create([
                                        'evaluator_id' => $request->evaluatorid,
                                        'id_number' => $load->id_number,
                                        'campus' => $load->campus,
                                        'school_year' => $load->school_year,
                                        'campusid' => $load->campusid,
                                        'subject' => $load->subject,
                                        'semester' => $schedule->semester,
                                        'department' => $load->department,
                                        'section' => $load->section,
                                        'year' => $date,
                                    ]);
                                }
                                 return response()->json([
                                    'status' =>'success',
                                ]);
                            }                                
                         }
                         
                        
                 }else{
                    
                     $checkAvailable = StudentSubjectLoading::where([['program2','=',null],['subject','=',null],['campusid','=',$request->campusid],['evaluator_id','=',$request->evaluatorid],['year','=',$date],['semester','=', $schedule->semester],['program','=', null]])->get();

                    if(count($checkAvailable) === 0){  
                         return response()->json([
                            'status' => 'done',
                        ]);   
                    }else{
                        if($faculty->academic_rank === 'admin' && $request->type === 'supervisor'){
                            $request->session()->put('evaluatorid', $request->evaluatorid);
                            $request->session()->put('type', $request->type);
                            $request->session()->put('campusid', $request->campusid);
                            return response()->json([
                                'status' => 'success',
                            ]);
                        }else if($faculty->academic_rank === 'admin' && $request->type === 'peer'){
                            $request->session()->put('evaluatorid', $request->evaluatorid);
                            $request->session()->put('type', $request->type);
                            $request->session()->put('campusid', $request->campusid);
                            return response()->json([
                                'status' => 'success',
                            ]);
                        }else if($faculty->academic_rank !== 'admin' && $request->type === 'peer'){
                              $request->session()->put('evaluatorid', $request->evaluatorid);
                              $request->session()->put('type', $request->type);
                              $request->session()->put('campusid', $request->campusid);
                            return response()->json([
                                'status' => 'success',
                            ]);
                        }else{
                            return response()->json([
                                'status' => 'error',
                            ]);
                        }
                       
                       
                    }

                 }

             }else{
                return response()->json([
                    'status' => 'incomp',
                ]);
             }


        }
       else if($request->type === 'self'){
             $schedule = Schedule::where('campusid','=',$request->campusid)->first();

             $subjectLoadingStudent = StudentSubjectLoading::where([['program','<>',null],['subject','=',null],['campusid','=',$request->campusid],['evaluator_id','=',$request->evaluatorid]])->get();

             $faculty = Faculty::where([['id','=',$request->evaluatorid],['password','=',$request->password]])->first();

             $faculties = Faculty::where([['id','=',$request->evaluatorid],['campusid','=',$request->campusid],['department','=', $faculty->department]])->get();


             if(count($subjectLoadingStudent) === 0){
                       $request->session()->put('evaluatorid', $request->evaluatorid);
                        $request->session()->put('type', $request->type);
                        $request->session()->put('campusid', $request->campusid);
                     foreach ($faculties as $load) {
                        StudentSubjectLoading::create([
                            'evaluator_id' => $request->evaluatorid,
                            'id_number' => $load->id_number,
                            'campus' => $load->campus,
                            'school_year' => $load->school_year,
                            'campusid' => $load->campusid,
                            'subject' => $load->subject,
                            'semester' => $schedule->semester,
                            'department' => $load->department,
                            'section' => $load->section,
                            'year' => $date,
                        ]);
                    }
                     return response()->json([
                        'status' =>'success',
                    ]);
             }else{

                $checkAvailable = StudentSubjectLoading::where([['program','<>',null],['subject','=',null],['campusid','=',$request->campusid],['evaluator_id','=',$request->evaluatorid],['year','=',$date],['semester','=', $schedule->semester],['program','=', null]])->get();
                     
                if(count($checkAvailable) === 0){  
                     return response()->json([
                        'status' => 'done',
                    ]);   
                }else{
                        $request->session()->put('evaluatorid', $request->evaluatorid);
                        $request->session()->put('type', $request->type);
                        $request->session()->put('campusid', $request->campusid);
                   return response()->json([
                        'status' => 'success',
                    ]);
                }

             }



        }

     }
}
