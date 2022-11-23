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
    	 $request->validate([
            'status'=>['required'],
            'campus'=>['required'],
            'campusid'=>['required'],
        ]);
       
        if($request->year === null ||  $request->section === null ||  $request->section === null){
             $users = Evaluator::where([['class_status', '=' ,$request->status],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])
                    ->get();
                    return response()->json([
                        'status' => $users
                    ]);
        }else{
             $users = Evaluator::where([['course', '=' ,$request->department],['section', '=' ,$request->section],['school_year', '=' ,$request->year],['class_status', '=' ,$request->status],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])
                    ->get();
                    return response()->json([
                        'status' => $users
                    ]);
        }
    }
    public function scan_qrcode(Request $request){
         $request->validate([
            'username'=>['required'],
            'password'=>['required'],
            'campus'=>['required'],
            'campusid'=>['required'],
            'type'=>['required'],
        ]);

         if($request->type === 'student'){

                    $aaa = StudentSubjectLoading::where([['campusid', '=' ,$request->campusid],['program', '=' ,null],['evaluator_id', '=' ,$request->evaluatorid]])
                        ->orWhere([['program', '<>' ,'active'],['evaluator_id', '=' ,$request->evaluatorid]])
                        ->get();

                    $users = Evaluator::where([['id_number','=',$request->username],['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus],['id', '=' ,$request->evaluatorid],['password','=',$request->password]])
                    ->get();

                  
                    if(count($users) !== 0){
                        if(count($aaa) === 0 && $users[0]->status === 'active'){
                            return response()->json([
                                'status' => 'done'
                            ]);
                        }else{
                             $request->session()->put('evaluator_type', 'student');
                                $request->session()->put('username', $request->username);
                                $request->session()->put('password', $request->password);
                                return response()->json([
                                    'status' => 'success'
                                ]);
                        }
                    }else{
                         return response()->json([
                            'status' => 'error'
                        ]);
                    }


         }else if($request->type === 'peer'){
            
             $aaa = StudentSubjectLoading::where([['campusid', '=' ,$request->campusid],['program', '=' ,null],['evaluator_id', '=' ,$request->evaluatorid]])
                        ->orWhere([['program', '<>' ,'active'],['evaluator_id', '=' ,$request->evaluatorid]])
                        ->get();

                    $users = Faculty::where([['id_number','=',$request->username],['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus],['id', '=' ,$request->evaluatorid],['password','=',$request->password]])
                    ->get();

                   
                  
                    if(count($users) !== 0){

                        if(count($aaa) === 0 && $users[0]->status === 'active'){
                            return response()->json([
                                'status' => 'done'
                            ]);

                        }else{
                             $request->session()->put('evaluator_type', 'peer');
                                $request->session()->put('username', $request->username);
                                $request->session()->put('password', $request->password);
                                return response()->json([
                                    'status' => 'success'
                                ]);
                        }
                    }else{
                         return response()->json([
                            'status' => 'error'
                        ]);
                    }

         }else if($request->type === 'self'){
             
                 $aaa = StudentSubjectLoading::where([['campusid', '=' ,$request->campusid],['program', '=' ,null],['evaluator_id', '=' ,$request->evaluatorid]])
                        ->orWhere([['program', '<>' ,'active'],['evaluator_id', '=' ,$request->evaluatorid]])
                        ->get();

                    $users = Faculty::where([['id_number','=',$request->username],['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus],['id', '=' ,$request->evaluatorid],['password','=',$request->password]])
                    ->get();

                   $user = User::where([['self','=',null],['id','=',$request->campusid]])->get();
                   if(count($user) !== 0){

                         if(count($aaa) === 0 && $user[0]->self === 'active'){
                            return response()->json([
                                'status' => 'done'
                            ]);

                        }else{
                                $request->session()->put('evaluator_type', 'self');
                                $request->session()->put('username', $request->username);
                                $request->session()->put('password', $request->password);
                                return response()->json([
                                    'status' => 'success'
                                ]);
                        }
                   }else if(count($users) !== 0){

                        if(count($aaa) === 0 && $users[0]->year === 'active'){
                            return response()->json([
                                'status' => 'done'
                            ]);

                        }else{
                                $request->session()->put('evaluator_type', 'self');
                                $request->session()->put('username', $request->username);
                                $request->session()->put('password', $request->password);
                                return response()->json([
                                    'status' => 'success'
                                ]);
                        }
                    }else{

                        if(count($user) === 0){
                            return response()->json([
                                'status' => 'done'
                            ]);
                        }else{
                              return response()->json([
                                'status' => 'error'
                            ]);
                        }
                       
                    }

         }else if($request->type === 'supervisor'){
            
        // evaluatorid =academic_rank
        // username = campus
        // password = campusid


                    $aaa = StudentSubjectLoading::where([['campusid', '=' ,$request->campusid],['program', '=' ,null],['evaluator_id', '=' ,$request->evaluatorid]])
                        ->orWhere([['program', '<>' ,'active'],['evaluator_id', '=' ,$request->evaluatorid]])
                        ->get();

                    $users = User::where([['id','=',$request->evaluatorid],['academic_rank', '=' ,$request->username],['password', '=' ,$request->password]])
                    ->get();

                  
                    if(count($users) !== 0){

                        if(count($aaa) === 0 && $users[0]->year === 'active'){
                            return response()->json([
                                'status' => 'done'
                            ]);

                        }else{
                                $request->session()->put('evaluator_type', 'supervisor');
                                $request->session()->put('username', $request->username);
                                $request->session()->put('password', $request->password);
                                return response()->json([
                                    'status' => 'success'
                                ]);
                        }

                    }else{
                         return response()->json([
                            'status' => $request->password
                        ]);
                    }


         }

      
       
    }

    public function evaluator_session(Request $request){
        $username = $request->session()->get('username');
        $password = $request->session()->get('password');


         if($request->session()->get('evaluator_type') === 'student'){
            $users = Evaluator::where([['id_number', '=' ,$username],['password','=',$password]])
                ->get();
                if(count($users) !== 0){
                    return response()->json([
                        'status' => 'success',
                        'id' => $users[0]->id_number,
                        'info' => $users
                    ]);
                }else{
                     return response()->json([
                        'status' => 'error'
                    ]);
                }
        }else if($request->session()->get('evaluator_type') === 'peer'){
                 $users = Faculty::where([['id_number', '=' ,$username],['password','=',$password]])
                    ->get();
                    if(count($users) !== 0){
                        return response()->json([
                            'status' => 'success',
                            'id' => $users[0]->id,
                            'info' => $users
                        ]);
                    }else{
                         return response()->json([
                            'status' => 'error'
                        ]);
                     }
        }else if($request->session()->get('evaluator_type') === 'self'){

                 $users = Faculty::where([['id_number', '=' ,$username],['password','=',$password]])
                    ->get();


                    if(count($users) !== 0){
                        return response()->json([
                            'status' => 'success',
                            'id' => $users[0]->id,
                            'info' => $users
                        ]);
                    }else{

                        $user = User::where([['self', '=', null],['password','=',$password]])
                         ->get();

                         if(count($user) !== 0){

                            return response()->json([
                                'status' => 'success',
                                'id' => $user[0]->id,
                                'info' => $user
                            ]);
                         }else{
                              return response()->json([
                                    'status' => $users
                                ]);
                         }
                       
                     }
        }
        else if($request->session()->get('evaluator_type') === 'supervisor'){

                 $users = User::where([['academic_rank', '=' ,$username],['password','=',$password]])
                    ->get();
                    if(count($users) !== 0){
                        return response()->json([
                            'status' => 'success',
                            'id' => $users[0]->id,
                            'info' => $users
                        ]);
                    }else{
                         return response()->json([
                            'status' => $users
                        ]);
                     }
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
        
        $request->validate([
            'campus'=>['required'],
            'campusid'=>['required'],
            'name'=>['required'],
            'studentid'=>['required'],
            'course'=>['required'],
            'year'=>['required'],
            'section'=>['required'],
            'sem'=>['required'],
            'status'=>['required'],
        ]);

          $user = new Evaluator;
        $user->id_number = $request->studentid;
        $user->campusid = $request->campusid;
        $user->campus = $request->campus;
        $user->name = $request->name;
        $user->password = Hash::make($request->studentid.$request->campusid.$request->campus.$request->name);
        $user->course = $request->course;
        $user->school_year = $request->year;
        $user->section = $request->section;
        $user->class_status = $request->status;
        $user->semester = $request->sem;
        $user->save();

        $users = Evaluator::where([['class_status', '=' ,$request->status],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])
        ->get();
        return response()->json([
            'status' => $users
        ]);

    }
    
}
