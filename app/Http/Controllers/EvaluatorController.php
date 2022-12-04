<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluator;
use App\Models\Faculty;
use App\Models\User;
use App\Models\StudentSubjectLoading;
use Illuminate\Support\Facades\Hash;
class EvaluatorController extends Controller
{
    public function get_evaluators(Request $request){

        $sy = $request->session()->get('school_year');
    	 $request->validate([
            'status'=>['required'],
            'campus'=>['required'],
            'campusid'=>['required'],
        ]);
       
        if($request->year === null ||  $request->section === null ||  $request->section === null){
             $users = Evaluator::where([['sy', '=' ,$sy],['class_status', '=' ,$request->status],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])
                    ->get();
                    return response()->json([
                        'status' => $users
                    ]);
        }else{
             $users = Evaluator::where([['sy', '=' ,$sy],['course', '=' ,$request->department],['section', '=' ,$request->section],['school_year', '=' ,$request->year],['class_status', '=' ,$request->status],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])
                    ->get();
                    return response()->json([
                        'status' => $users
                    ]);
        }
    }
  

    public function evaluator_session(Request $request){
        $evaluatorid = $request->session()->get('evaluatorid');
        $type = $request->session()->get('type');
        $campusid = $request->session()->get('campusid');

        if($type === 'student'){
             $all = StudentSubjectLoading::where([['program','=',null],['subject','<>',null],['evaluator_id','=',$evaluatorid],['campusid','=',$campusid]])->get();

             $name=Faculty::where('id','=',$all[0]->id_number)->first();
             return response()->json([
                'status' => $all[0],
                'name' => $name
            ]);
        }else if($type === 'peer'){
             $all = StudentSubjectLoading::where([['program2','=',null],['subject','=',null],['evaluator_id','=',$evaluatorid],['campusid','=',$campusid]])->get();
            $name=Faculty::where('id_number','=',$all[0]->id_number)->first();
             return response()->json([
                'status' => $all[0],
                'name' => $name
            ]);
        }else{
            $all = StudentSubjectLoading::where([['program','=',null],['subject','=',null],['evaluator_id','=',$evaluatorid],['campusid','=',$campusid]])->get();
            $name=Faculty::where('id_number','=',$all[0]->id_number)->first();
             return response()->json([
                'status' => $all[0],
                'name' => $name
            ]);
        }
        
       
    }

    public function logout_evaluator(Request $request){

        $request->session()->forget('username');
        $request->session()->forget('password');
        $request->session()->forget('keyadmin');


        if($request->session()->get('username') === null && $request->session()->get('password') === null){
          return response()->json([
                    'status' => 'success'
          ]);
        }else{
          return response()->json([
                    'status' => 'error'
          ]);
        }
        

    }

    public function add_student(Request $request){
        $sy = $request->session()->get('school_year');
        $request->validate([
            'campus'=>['required'],
            'campusid'=>['required'],
            // 'name'=>['required'],
            'studentid'=>['required'],
            'course'=>['required'],
            'year'=>['required'],
            'section'=>['required'],
            'sem'=>['required'],
            'status'=>['required'],
            'sy'=>['required'],
        ]);

          $user = new Evaluator;
        $user->id_number = $request->studentid;
        $user->campusid = $request->campusid;
        $user->campus = $request->campus;
        // $user->name = $request->name;
        $user->password = Hash::make($request->studentid.$request->campusid.$request->campus.$request->name);
        $user->course = $request->course;
        $user->school_year = $request->year;
        $user->section = $request->section;
        $user->class_status = $request->status;
        $user->semester = $request->sem;
        $user->sy = $request->sy;
        $user->save();

        $users = Evaluator::where([['sy', '=' ,$request->sy],['class_status', '=' ,$request->status],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])
        ->get();
        return response()->json([
            'status' => $users
        ]);

    }
    
     public function get_every_evaluator(Request $request){
        $sy = $request->session()->get('school_year');
       
        $users = Evaluator::where([['sy', '=' ,$sy],['id', '=' ,$request->id]])->first();
        return response()->json([
            'status' => $users
        ]);
     }
}
