<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Evaluator;
use App\Models\User;
use App\Models\FacultySubjectLoading;
use App\Models\StudentSubjectLoading;
use Illuminate\Support\Facades\Hash;
class FacultyController extends Controller
{
     public function get_faculty(Request $request){
    	 $request->validate([
            'status'=>['required'],
            'campusid'=>['required'],
            'campus'=>['required'],
        ]);
        $users = Faculty::where([['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus]])
        ->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => $users
        ]);
    }
     public function get_all_faculty(Request $request){
        $username = $request->session()->get('username');
        $password = $request->session()->get('password');
         

        if($request->session()->get('evaluator_type') === 'student'){
            $users = Evaluator::where([['id_number', '=' ,$username],['password','=',$password]])
            ->first();
             $loading = FacultySubjectLoading::where([['department','=',$users->course],['year','=',$users->school_year],['semester','=',$users->semester]])->get();

                $aaa = StudentSubjectLoading::where([['program', '=' ,null],['evaluator_id', '=' ,$users->id]])
                    ->orWhere([['program', '<>' ,'active'],['evaluator_id', '=' ,$users->id]])
                    ->get();
                
                $subjectLoadingStudent = StudentSubjectLoading::where([['program', '=' ,null],['evaluator_id', '=' ,$users->id]])
                ->orWhere([['program', '=' ,'active'],['evaluator_id', '=' ,$users->id]])
                ->get();

                if(count($subjectLoadingStudent) === 0){
                     foreach ($loading as $load) {
                        StudentSubjectLoading::create([
                            'evaluator_id' => $users->id,
                            'id_number' => $load->id_number,
                            'campusid' => $load->campusid,
                            'subject' => $load->subject,
                            'semester' => $load->semester,
                            'department' => $load->department,
                            'section' => $load->section,
                            'year' => $load->year,
                        ]);
                    }

                   
                }else{

                    if(count($aaa) !== 0){
                             $faculty = Faculty::where('id', '=',$aaa[0]->id_number)->first();
                             return response()->json([
                                'status' => $aaa,
                                'faculty' =>$faculty,
                                'console' => $faculty
                            ]);
                    }else{
                             return response()->json([
                                'status' => $aaa,
                                'faculty' =>'done',
                                'console' => 'done'
                            ]);
                    }
                  


                }   

        }else if($request->session()->get('evaluator_type') === 'peer'){
            $users = Faculty::where([['id_number', '=' ,$username],['password','=',$password]])
            ->first();

                $loading = Faculty::where([['id','<>',$users->id],['campusid','=',$users->campusid],['department','=',$users->department]])->get();

                $aaa = StudentSubjectLoading::where([['campus', '=' ,null],['program', '=' ,null],['evaluator_id', '=' ,$users->id]])
                    ->orWhere([['campus', '=' ,null],['program', '<>' ,'active'],['evaluator_id', '=' ,$users->id]])
                    ->get();

                $bbb = StudentSubjectLoading::where([['campusid', '=' ,$users->campusid],['campus', '<>' ,null],['program', '=' ,null],['evaluator_id', '=' ,$users->id]])
                    ->orWhere([['campusid', '=' ,$users->campusid],['campus', '<>' ,null],['program', '<>' ,'active'],['evaluator_id', '=' ,$users->id]])
                    ->get();
                
                $subjectLoadingStudent = StudentSubjectLoading::where([['program', '=' ,null],['evaluator_id', '=' ,$users->id]])
                ->orWhere([['program', '=' ,'active'],['evaluator_id', '=' ,$users->id]])
                ->get();

                $admin = User::where('id',$users->campusid)->first();

                if(count($subjectLoadingStudent) === 0){

                     foreach ($loading as $load) {
                        StudentSubjectLoading::create([
                            'evaluator_id' => $users->id,
                            'id_number' => $load->id,
                            'campusid' => $load->campusid,
                            'department' => $load->department,
                        ]);
                    }

                     StudentSubjectLoading::create([
                            'evaluator_id' => $users->id,
                            'id_number' =>$load->campusid,
                            'campusid' => $load->campusid,
                            'campus' => 'Campus Administrator',
                        ]);

                   
                }else{

                    if(count($bbb) !== 0){
                            $faculty = User::where('id', '=',$users->campusid)->first();
                             return response()->json([
                                'status' => $bbb,
                                'faculty' =>$faculty,
                                'console' => $faculty
                            ]);
                    }else if(count($aaa) !== 0){
                             $faculty = Faculty::where('id', '=',$aaa[0]->id_number)->first();
                             return response()->json([
                                'status' => $aaa,
                                'faculty' =>$faculty,
                                'console' => $faculty
                            ]);
                    }else{
                             return response()->json([
                                'status' => $aaa,
                                'faculty' =>'done',
                                'console' => 'done'
                            ]);
                    }
                  


                }   
        }

        else if($request->session()->get('evaluator_type') === 'self'){

                $users = Faculty::where([['year', '=' ,null],['id_number', '=' ,$username],['password','=',$password]])
               ->get();

                $user = User::where([['self','=',null],['password','=',$password]])->get();

                if(count($user) !== 0){

                    $subjectLoadingStudent = StudentSubjectLoading::where([['id_number', '=' ,$user[0]->id],['program', '=' ,null],['evaluator_id', '=' ,$user[0]->id]])
                      ->get();
                      if(count($subjectLoadingStudent) === 0){
                        $request->session()->put('keyadmin', 'admin');
                         StudentSubjectLoading::create([
                                'evaluator_id' => $user[0]->id,
                                'id_number' => $user[0]->id,
                                'campusid' => $user[0]->id,
                                'campus' => 'admin',
                                'department' => $user[0]->academic_rank,
                            ]);
                         return response()->json([
                                'status' => $user,
                                'faculty' =>'done',
                                'console' => 'done'
                            ]);
                      }else{
                          return response()->json([
                                'status' => $subjectLoadingStudent,
                                'faculty' => $user[0],
                                'console' => 'done'
                            ]);
                      }
                   
                }else if(count($users) !== 0){

                   $subjectLoadingStudent = StudentSubjectLoading::where([['id_number', '=' ,$users[0]->id],['program', '=' ,null],['evaluator_id', '=' ,$users[0]->id]])
                      ->get();

                     if(count($subjectLoadingStudent) === 0){

                          StudentSubjectLoading::create([
                                'evaluator_id' => $users[0]->id,
                                'id_number' => $users[0]->id,
                                'campusid' => $users[0]->campusid,
                                'department' => $users[0]->department,
                            ]);
                        
                        
                           return response()->json([
                                'status' => $users,
                                'faculty' =>'done',
                                'console' => 'done'
                            ]);

                     }else{



                            return response()->json([
                                'status' => $subjectLoadingStudent,
                                'faculty' => $users[0],
                                'console' => 'done'
                            ]);
                     }



               }else{
                     return response()->json([
                        'status' =>$users,
                        'console' =>$user
                    ]);
               }


        }
        else if($request->session()->get('evaluator_type') === 'supervisor'){

            $users = User::where([['academic_rank','=',$username],['password','=',$password]])->first();
         

          $aaa = StudentSubjectLoading::where([['program', '=' ,null],['evaluator_id', '=' ,$users->id]])
                    ->get();

            $subjectLoadingStudent = StudentSubjectLoading::where([['evaluator_id', '=' ,$users->id],['program', '=' ,null]])
                                   ->orWhere([['program', '=' ,'active'],['evaluator_id', '=' ,$users->id]])
                ->get();


                if(count($subjectLoadingStudent) === 0){

                    $loading = Faculty::where('campusid','=',$users->id)->get();

                    foreach ($loading as $load) {
                        StudentSubjectLoading::create([
                            'evaluator_id' => $users->id,
                            'id_number' => $load->id,
                            'campusid' => $load->campusid,
                            'campus' => $load->campus,
                        ]);
                    }
                   return response()->json([
                        'status' => $users,
                    ]);
                }else{

                     if(count($aaa) !== 0){
                             $faculty = Faculty::where('id', '=',$aaa[0]->id_number)->first();
                             return response()->json([
                                'status' => $aaa,
                                'faculty' =>$faculty,
                                'console' => $faculty
                            ]);
                    }else{
                             return response()->json([
                                'status' => $aaa,
                                'faculty' =>'done',
                                'console' => 'done'
                            ]);
                    }

                }
               

        }
        //end
        
    }

     public function add_faculty(Request $request){
        
        
         $request->validate([
            'idNumber'=>['required'],
            'campusid'=>['required'],
            'campus'=>['required'],
            'name'=>['required'],
            'department'=>['required'],
            'rank'=>['required'],
        ]);
         $user = new Faculty;
        $user->id_number = $request->idNumber;
        $user->password = Hash::make($request->idNumber.$request->campusid.$request->campus.$request->name);
        $user->campusid = $request->campusid;
        $user->campus = $request->campus;
        $user->name = $request->name;
        $user->department = $request->department;
        $user->academic_rank = $request->rank;
        $user->save();

        

        if($request->status === 'Faculty'){
            $users = Faculty::where([['status','=',$request->status],['campus','=',$request->campus],['campusid','=',$request->campusid]])->get();
                     return response()->json([
                    'status' => $users
                ]);
        }else{
                $users = Faculty::where([['status','=',$request->status],['campus','=',$request->campus],['campusid','=',$request->campusid]])->get();
                             return response()->json([
                        'status' => $users
                    ]);
        }
       
    }
}
