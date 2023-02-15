<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Results;
use App\Models\Evaluator;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Students;
use App\Models\FinalResult;
use App\Models\StudentSubjectLoading;
use Illuminate\Support\Facades\DB;
class ResultsController extends Controller
{
     public function submit_form(Request $request){


        $total = ($request->commitment+$request->kos+$request->til+$request->mol) / 4;
        

        if($request->session()->get('type') === 'student'){
            
            StudentSubjectLoading::where('id', $request->id)
            ->update(['total' => $request->total/20,'program' => 'done','program2'=>$request->question,'comment'=>$request->comment]);
           
            
                $user = new Results;
                $user->evaluatee_id = $request->evaluatee;
                $user->evaluator_id = $request->evaluator;
                $user->commitment = $request->commitment;
                $user->kos = $request->kos;
                $user->name = $request->name;
                $user->campus = $request->session()->get('e_campus');
                $user->campusid = $request->session()->get('e_campusid');
                $user->til = $request->til;
                $user->mol = $request->mol;
                $user->total = $total;
                $user->comment = $request->comment;
                $user->school_year = date('Y');
                $user->section = $request->session()->get('e_section');
                $user->semester = $request->session()->get('e_sem');
                $user->sy =$request->session()->get('e_sy');
                $user->department = $request->session()->get('department');
                $user->status = $request->type;
                $user->save();


        }else{

             Faculty::where('id','=', $request->evaluatee)
                ->update(['status' => 'active']);
      
                StudentSubjectLoading::where('id', $request->id)
                ->update(['total' => $request->total/20,'program' => 'done','program2'=>$request->question,'comment'=>$request->comment]);


                $user = new Results;
                $user->evaluatee_id = $request->evaluatee;
                $user->evaluator_id = $request->evaluator;
                $user->commitment = $request->commitment;
                $user->kos = $request->kos;
                $user->name = $request->name;
                $user->campus = $request->session()->get('campus');;
                $user->school_year = date('Y');
                $user->campusid = $request->session()->get('campusid');;
                $user->til = $request->til;
                $user->mol = $request->mol;
                $user->total = $total;
                $user->comment = $request->comment;
                $user->semester = $request->session()->get('school_sem');
                $user->sy = $request->session()->get('school_year');
                $user->department = $request->session()->get('department');
                $user->academic_rank = $request->session()->get('rank');
                $user->status = $request->type;
                $user->save();

        } 

     
      
        $ccs = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Computer Study']])->get()->sum('total');

         $cte = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Teachers Education']])->get()->sum('total');

         $cbm = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Business Management']])->get()->sum('total');
         $caf = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Agriculture and Forestry']])->get()->sum('total');

         $ccje = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Criminal Justice Education']])->get()->sum('total');

 
        $a = Results::where('evaluatee_id','=',$request->evaluatee)->get()->sum('commitment');
        $b = Results::where('evaluatee_id','=',$request->evaluatee)->get()->sum('kos');
        $c = Results::where('evaluatee_id','=',$request->evaluatee)->get()->sum('til');
        $d = Results::where('evaluatee_id','=',$request->evaluatee)->get()->sum('mol');
        $e = Results::where('evaluatee_id','=',$request->evaluatee)->get()->sum('total');

        $f = Results::where('evaluatee_id','=',$request->evaluatee)->get();

        $count1 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Computer Study'],['semester','=', $request->session()->get('e_sem')]])->get();
         $count2 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Teachers Education'],['semester','=', $request->session()->get('e_sem')]])->get();

        $count3 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Business Management'],['semester','=', $request->session()->get('e_sem')]])->get();

        $count4 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Agriculture and Forestry'],['semester','=', $request->session()->get('e_sem')]])->get();

        $count5 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Criminal Justice Education'],['semester','=', $request->session()->get('e_sem')]])->get();

        Results::where('evaluatee_id','=',$request->evaluatee)
      ->update([
        'a' => $a / count($f),
        'b' => $b / count($f),
        'c' => $c / count($f),
        'd' => $d / count($f),
        'e' => $e / count($f),
        // 'ccs' => $ccs !== 0 && count($count1) !== 0? $ccs / count($count1):null,
        // 'cte' => $cte !== 0 && count($count2) !== 0? $cte / count($count2):null,
        // 'cbm' => $cbm !== 0 && count($count3) !== 0? $cbm / count($count3):null,
        // 'caf' => $caf !== 0 && count($count4) !== 0? $caf / count($count4):null,
        // 'ccje' =>$ccje !== 0 && count($count5) !== 0? $ccje / count($count5):null,

        ]);

            return response()->json([
                'status' => 'success',
                'x1' => count($count5),
                'x2' => $ccje,
                'x3' => $ccs
            ]);
       
        
    }

    public function verify_evaluate(Request $request){
         $request->validate([
            'evaluator'=>['required'],
            'evaluatee'=>['required'],
        ]);
         $user = Results::where([['evaluatee_id', '=' ,$request->evaluatee],['evaluator_id','=',$request->evaluator]])
        ->first();
        if($user === null){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
         
    }

    public function get_all_results(Request $request){
        $request->validate([
            'status'=>['required'],
            'campus'=>['required'],
            'campusid'=>['required'],
        ]);

        $users = Results::where([['campus','=',$request->campus],['campusid','=',$request->campusid]])
        ->get()->unique('name');;
        return response()->json([
                'status' => $users
            ]);
    }

    public function get_all_results3(Request $request){

  $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');


           for ($i=0; $i < count($request->data); $i++) { 
             $exist[$i] =FinalResult::where('faculty_id','=',$request->data[$i]['evaluatee_id'])->first();


                 $student[$i]= Results::where([['status','=','Student'],['evaluatee_id','=',$request->data[$i]['evaluatee_id']],['semester','=',$sem],['sy','=',$sy]])->sum('total');


                   $sdc[$i]= Results::where([['status','=','Student'],['evaluatee_id','=',$request->data[$i]['evaluatee_id']],['semester','=',$sem],['sy','=',$sy]])->limit(30)->get();

                    $peer[$i]= Results::where([['status','=','Peer'],['evaluatee_id','=',$request->data[$i]['evaluatee_id']],['semester','=',$sem],['sy','=',$sy]])->sum('total');

                    $pc[$i]= Results::where([['status','=','Peer'],['evaluatee_id','=',$request->data[$i]['evaluatee_id']],['semester','=',$sem],['sy','=',$sy]])->limit(30)->get();

                    $self[$i]= Results::where([['status','=','Self'],['evaluatee_id','=',$request->data[$i]['evaluatee_id']],['semester','=',$sem],['sy','=',$sy]])->sum('total');

                    $sc[$i]= Results::where([['status','=','Self'],['evaluatee_id','=',$request->data[$i]['evaluatee_id']],['semester','=',$sem],['sy','=',$sy]])->limit(30)->get();

                    $admin[$i]= Results::where([['status','=','Admin'],['evaluatee_id','=',$request->data[$i]['evaluatee_id']],['semester','=',$sem],['sy','=',$sy]])->sum('total');

                    $ac[$i]= Results::where([['status','=','Admin'],['evaluatee_id','=',$request->data[$i]['evaluatee_id']],['semester','=',$sem],['sy','=',$sy]])->limit(30)->get();

                if($exist[$i] === null){
                 
                      $user = new FinalResult;
                      $user->campusid = $request->data[$i]['campusid'];
                        $user->faculty_id = $request->data[$i]['evaluatee_id'];
                        $user->faculty_name=$request->data[$i]['name'];
                        $user->student=count($sdc[$i]) === 0?0:$student[$i] / count($sdc[$i]);
                        $user->peer=count($pc[$i]) === 0?0:$peer[$i] /count($pc[$i]);
                        $user->self=count($sc[$i]) === 0?0:$self[$i] /count($sc[$i]);
                        $user->supervisor=count($ac[$i]) === 0?0:$admin[$i] /count($ac[$i]);
                        $user->sy=$request->data[$i]['sy'];
                        $user->sem=$request->data[$i]['semester'];
                        $user->save();
                }else{

                    FinalResult::where([['faculty_id','=',$request->data[$i]['evaluatee_id']],['campusid','=',$request->data[$i]['campusid']]])
                    ->update([
                        'student' =>count($sdc[$i]) === 0?0:$student[$i] / count($sdc[$i]),
                        'peer' =>count($pc[$i]) === 0?0:$peer[$i] /count($pc[$i]),
                        'self' =>count($sc[$i]) === 0?0:$self[$i] /count($sc[$i]),
                        'supervisor' =>count($ac[$i]) === 0?0:$admin[$i] /count($ac[$i]),
                    ]);

                }

           }

         $FinalResult = FinalResult::where([['sem','=',$request->data[0]['semester']],['sy','=',$request->data[0]['sy']],['campusid','=',$request->data[0]['campusid']]])->get();
        return response()->json([
                'status' => $FinalResult,
            ]);

    }
       public function get_all_results2(Request $request){
        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
   
        $users = Results::where([['campusid','=',$request->campusid],['department','=',$request->department],['semester','=',$sem],['sy','=',$sy]])->get()->unique('evaluatee_id');

        
           // for ($i=0; $i < count($users); $i++) { 
           //   // $exist[$i] =FinalResult::where('faculty_id','=',$users[$i]['evaluatee_id'])->first();

           //      // if($exist[$i] === null){
           //      //    // $student[$i]= Results::where([['academic_rank','=',null],['evaluatee_id','=',$users[$i]->evaluatee_id],['semester','=',$sem],['sy','=',$sy]])->sum('total');

           //      //    // $peer[$i]= Results::where([['academic_rank','=',null],['evaluatee_id','=',$users[$i]->evaluatee_id],['semester','=',$sem],['sy','=',$sy]])->sum('total');

           //      //    // $sc[$i]= Results::where([['academic_rank','=',null],['evaluatee_id','=',$users[$i]->evaluatee_id],['semester','=',$sem],['sy','=',$sy]])->limit(30)->get();

           //      //    //    $user = new FinalResult;
           //      //    //      $user->faculty_id = $users[$i]->evaluatee_id;
           //      //    //      $user->faculty_name=$users[$i]->name;
           //      //    //      $user->student=$student[$i] /count($sc[$i]);
           //      //    //      $user->student=$peer[$i] /count($sc[$i]);
           //      //    //      $user->save();
           //      // }else{



           //      // }

           // }
        return response()->json([
                'status' => $users,
                'console' =>[$request->campusid,$request->department,$sem,$sy]
            ]);
    }

     public function goto_overall(Request $request){
        $request->validate([
            'id'=>['required'],
        ]);
        $request->session()->put('evaluateeid', $request->id);
        $request->session()->put('campus', $request->campus);
        $request->session()->put('campusid', $request->campusid);
    }
    public function get_all_overall1(Request $request){
        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
        $faculty=Faculty::where('id','=',$request->session()->get('evaluateeid'))->first();

        // $pdf =  StudentSubjectLoading::where([['semester','=',$sem],['type','=','Student'],['program','=','done'],['sy','=',$sy],['id_number', '=' ,$faculty->id]])
        // ->get();

         $pdf = DB::table('student_subject_loading')
            ->join('students', 'student_subject_loading.unique_id', '=', 'students.password')
            ->where([['student_subject_loading.semester','=',$sem],['student_subject_loading.type','=','Student'],['student_subject_loading.program','=','done'],['student_subject_loading.sy','=',$sy],['student_subject_loading.id_number', '=' ,$faculty->id]])
            ->get();

        return response()->json([
            'status' => $pdf,
        ]);
    }
    public function get_all_overall2(Request $request){
        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
        $faculty=Faculty::where('id','=',$request->session()->get('evaluateeid'))->first();

        // $pdf =  StudentSubjectLoading::where([['id_number','=',$request->session()->get('evaluateeid')],['semester','=',$sem],['type','=','Peer'],['program','=','done'],['sy','=',$sy]])
        // ->get();

        $pdf = DB::table('student_subject_loading')
            ->join('faculty', 'student_subject_loading.evaluator_id', '=', 'faculty.id')
            ->where([['student_subject_loading.id_number','=',$request->session()->get('evaluateeid')],['student_subject_loading.semester','=',$sem],['student_subject_loading.type','=','Peer'],['student_subject_loading.program','=','done'],['student_subject_loading.sy','=',$sy]])
            ->select('faculty.department','faculty.name','faculty.academic_rank','faculty.semester','faculty.sy','faculty.campus','student_subject_loading.id')
            ->get();

        return response()->json([
            'status' => $pdf,
            'console' =>$faculty
        ]);
    }
    public function get_all_overall3(Request $request){
          $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
        $faculty=Faculty::where('id','=',$request->session()->get('evaluateeid'))->first();

        // $pdf =  StudentSubjectLoading::where([['id_number','=',$request->session()->get('evaluateeid')],['semester','=',$sem],['type','=','Peer'],['program','=','done'],['sy','=',$sy]])
        // ->get();

        $pdf = DB::table('student_subject_loading')
            ->join('faculty', 'student_subject_loading.evaluator_id', '=', 'faculty.id')
            ->where([['student_subject_loading.id_number','=',$request->session()->get('evaluateeid')],['student_subject_loading.semester','=',$sem],['student_subject_loading.type','=','Admin'],['student_subject_loading.program','=','done'],['student_subject_loading.sy','=',$sy]])
            ->select('faculty.department','faculty.name','faculty.academic_rank','faculty.semester','faculty.sy','faculty.campus','student_subject_loading.id')
            ->get();

        return response()->json([
            'status' => $pdf,
            'console' =>$faculty
        ]);
    }
    public function get_all_overall4(Request $request){
        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
        $faculty=Faculty::where('id_number','=',$request->session()->get('evaluateeid'))->first();

        // $pdf =  StudentSubjectLoading::where([['id_number','=',$request->session()->get('evaluateeid')],['semester','=',$sem],['type','=','Self'],['program','=','done'],['sy','=',$sy]])
        // ->get();

         $pdf = DB::table('student_subject_loading')
            ->join('faculty', 'student_subject_loading.evaluator_id', '=', 'faculty.id')
            ->where([['student_subject_loading.id_number','=',$request->session()->get('evaluateeid')],['student_subject_loading.semester','=',$sem],['student_subject_loading.type','=','Self'],['student_subject_loading.program','=','done'],['student_subject_loading.sy','=',$sy]])
            ->get();
        return response()->json([
            'status' => $pdf,
        ]);
    }
     public function get_all_overall(Request $request){

        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
       $users = Results::where([['semester','=',$sem],['sy','=',$sy],['evaluatee_id', '=' ,$request->session()->get('evaluateeid')]])
        ->get();

        
        $users2 = Results::where([['semester','=',$sem],['sy','=',$sy],['evaluatee_id', '=' ,$request->session()->get('evaluateeid')]])
        ->select('evaluatee_id','a','b','c','d','e','year','semester')->distinct()->first();


        $faculty=Faculty::where('id_number','=',$request->session()->get('evaluateeid'))->first();
        

        // $pdf =  StudentSubjectLoading::where([['program','=','done'],['sy','=',$sy],['id_number', '=' ,$faculty->id]])
        // ->get();
     
            

        $ccs = Results::where([['evaluatee_id', '=' ,$request->session()->get('evaluateeid')],['department', '=' ,'College of Computer Study'],['semester','=',$users2->semester]])
        ->select('ccs')->distinct()->get();

        $cte = Results::where([['evaluatee_id', '=' ,$request->session()->get('evaluateeid')],['department', '=' ,'College of Teachers Education'],['semester','=',$users2->semester]])
        ->select('cte')->distinct()->get();
        
        $cbm = Results::where([['evaluatee_id', '=' ,$request->session()->get('evaluateeid')],['department', '=' ,'College of Business Management'],['semester','=',$users2->semester]])
        ->select('cbm')->distinct()->get();

        $caf = Results::where([['evaluatee_id', '=' ,$request->session()->get('evaluateeid')],['department', '=' ,'College of Agriculture and Forestry'],['semester','=',$users2->semester]])
        ->select('caf')->distinct()->get();

        $ccje = Results::where([['evaluatee_id', '=' ,$request->session()->get('evaluateeid')],['department', '=' ,'College of Criminal Justice Education'],['semester','=',$users2->semester]])
        ->select('ccje')->distinct()->get();


         return response()->json([
                'status' => $users,
                'status2' => $users2,
                'ccs' => $ccs,
                'cte' => $cte,
                'cbm' => $cbm,
                'caf' => $caf,
                'ccje' => $ccje,
            ]);
    }


  public function get_every_result3(Request $request){

            $result = Faculty::where('id',$request->id)->first();


            $evaluator=StudentSubjectLoading::where('id_number',$request->id)->first();

                 return response()->json([
                    'status' =>$result,
                    'evaluator' =>$evaluator,
                ]);
                
    }


     public function get_every_result2(Request $request){

            $result = DB::table('faculty')
             ->where('student_subject_loading.id','=',$request->id)
            ->join('student_subject_loading', 'faculty.id', '=', 'student_subject_loading.evaluator_id')
            ->select('student_subject_loading.evaluator_id','student_subject_loading.semester','student_subject_loading.faculty_name','student_subject_loading.id_number',
                'student_subject_loading.academic_rank','student_subject_loading.program2','student_subject_loading.type')
            ->first();


            $evaluator=Faculty::where('id',$result->evaluator_id)->first();

                 return response()->json([
                    'status' =>$result,
                    'evaluator' =>$evaluator,
                ]);
                
    }

    public function get_every_result(Request $request){

            $result = DB::table('students')
            ->join('student_subject_loading', 'students.password', '=', 'student_subject_loading.unique_id')
             ->where([['student_subject_loading.subject','=',$request->subject],['students.id','=',$request->id]])
            ->first();

                $student = Students::where('password','=',$result->unique_id)
                ->first();

                $faculty=Faculty::where('id',$result->id_number)->first();

                  return response()->json([
                    'status' =>$result,
                    'student' =>$student,
                    'faculty' =>$faculty
                ]);
           

       
    }
     public function counting_data(Request $request){

        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
          $schedule = Schedule::where([['semester','=',$sem],['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])->first();


           $active = Evaluator::where([['semester','=',$sem],['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['status', '=' ,'active']])
        ->get();

        $notactive = Evaluator::where([['semester','=',$sem],['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['status', '=' ,null]])
        ->get();
        $evaluators = Evaluator::where([['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus],['sy','=',$sy]])->get();
         $evaluatee = Faculty::where([['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus],['sy','=',$sy]])->get();

         $a = Results::where([['semester','=',$sem],['sy','=',$sy],['campusid', '=' ,$request->campusid],['department', '=' ,'College of Computer Studies']])->get();
         $b = Results::where([['semester','=',$sem],['sy','=',$sy],['campusid', '=' ,$request->campusid],['department', '=' ,'College of Business Management']])->get();
         $c = Results::where([['semester','=',$sem],['sy','=',$sy],['campusid', '=' ,$request->campusid],['department', '=' ,'College of Teachers Education']])->get();
         $d = Results::where([['semester','=',$sem],['sy','=',$sy],['campusid', '=' ,$request->campusid],['department', '=' ,'College of Agriculture and Forestry']])->get();
         $e = Results::where([['semester','=',$sem],['sy','=',$sy],['campusid', '=' ,$request->campusid],['department', '=' ,'College of Criminal Justice Education']])->get();

         $else1= Students::where([['semester','=',$sem],['sy','=',$sy],['campusid', '=' ,$request->campusid]])->get();
         $else2= Faculty::where([['semester','=',$sem],['sy','=',$sy],['campusid', '=' ,$request->campusid]])->get();

        return response()->json([
                'evaluators' => $evaluators,
                'evaluatee' => $evaluatee,
                'active' => $active,
                'notactive' => $notactive,
                'a' => $a,
                'b' => $b,
                'c' => $c,
                'd' => $d,
                'e' => $e,
                'else1' =>$else1,
                'else2' =>$else2
            ]);
     }
}
