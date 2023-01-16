<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Results;
use App\Models\Evaluator;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Faculty;
use App\Models\StudentSubjectLoading;
use Illuminate\Support\Facades\DB;
class ResultsController extends Controller
{
     public function submit_form(Request $request){


         $request->validate([
            'evaluator'=>['required'],
            'evaluatee'=>['required'],
            'commitment'=>['required'],
            'name'=>['required'],
            'campus'=>['required'],
            'kos'=>['required'],
            'til'=>['required'],
            'mol'=>['required'],
            'type'=>['required'],
        ]);
        $total = ($request->commitment+$request->kos+$request->til+$request->mol) / 4;
        
        
        StudentSubjectLoading::where('id', $request->id2)
      ->update(['program' => 'active']);


        if($request->type === 'student'){
            
            Evaluator::where('id', $request->evaluator)
                ->update(['status' => 'active']);
                 $aa= Evaluator::where('id', $request->evaluator)->first();
            StudentSubjectLoading::where('id', $request->id)
            ->update(['program' => 'done','program2'=>$request->question,'comment'=>$request->comment]);
            
            
                $user = new Results;
                $user->evaluatee_id = $request->evaluatee;
                $user->evaluator_id = $request->evaluator;
                $user->commitment = $request->commitment;
                $user->kos = $request->kos;
                $user->name = $request->name;
                $user->campus = $request->campus;
                $user->campusid = $aa->campusid;
                $user->til = $request->til;
                $user->mol = $request->mol;
                $user->total = $total;
                $user->comment = $request->comment;
                $user->school_year = date('Y');
                $user->section = $aa->section;
                $user->semester = $aa->semester;
                $user->sy = $aa->sy;
                $user->department = $aa->course;
                $user->academic_rank = $aa->academic_rank;
                $user->save();


        }else{

             Faculty::where('id', $request->evaluator)
                ->update(['status' => 'active']);
               $aa= Faculty::where('id', $request->evaluator)->first();
                StudentSubjectLoading::where('id', $request->id)
                ->update(['program' => 'done','program2'=>$request->question,'comment'=>$request->comment]);


                $user = new Results;
                $user->evaluatee_id = $request->evaluatee;
                $user->evaluator_id = $request->evaluator;
                $user->commitment = $request->commitment;
                $user->kos = $request->kos;
                $user->name = $request->name;
                $user->campus = $request->campus;
                $user->school_year = date('Y');
                $user->campusid = $aa->campusid;
                $user->til = $request->til;
                $user->mol = $request->mol;
                $user->total = $total;
                $user->comment = $request->comment;
                $user->semester = $aa->semester;
                $user->sy = $aa->sy;
                $user->department = $aa->department;
                $user->academic_rank = $aa->academic_rank;
                $user->save();

        } 


        $zz= Faculty::where('id', $request->evaluator)->first();

        if($user){
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

        $count1 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Computer Study'],['semester','=',$zz->semester]])->get();
         $count2 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Teachers Education'],['semester','=',$zz->semester]])->get();

        $count3 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Business Management'],['semester','=',$zz->semester]])->get();

        $count4 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Agriculture and Forestry'],['semester','=',$zz->semester]])->get();

        $count5 = Results::where([['evaluatee_id','=',$request->evaluatee],['department','=','College of Criminal Justice Education'],['semester','=',$zz->semester]])->get();

        Results::where('evaluatee_id','=',$request->evaluatee)
      ->update([
        'a' => $a / count($f),
        'b' => $b / count($f),
        'c' => $c / count($f),
        'd' => $d / count($f),
        'e' => $e / count($f),
        'ccs' => $ccs !== 0 && count($count1) !== 0? $ccs / count($count1):null,
        'cte' => $cte !== 0 && count($count2) !== 0? $cte / count($count2):null,
        'cbm' => $cbm !== 0 && count($count3) !== 0? $cbm / count($count3):null,
        'caf' => $caf !== 0 && count($count4) !== 0? $caf / count($count4):null,
        'ccje' =>$ccje !== 0 && count($count5) !== 0? $ccje / count($count5):null,

        ]);

            return response()->json([
                'status' => 'success',
                'x1' => count($count5),
                'x2' => $ccje,
                'x3' => $ccs
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
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
       public function get_all_results2(Request $request){
        $sy = $request->session()->get('school_year');
        $request->validate([
            'status'=>['required'],
        ]);

        $users = Results::where('sy','=',$sy)->get()->unique('evaluatee_id');
        return response()->json([
                'status' => $users
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
        $faculty=Faculty::where('id_number','=',$request->session()->get('evaluateeid'))->first();

        $pdf =  StudentSubjectLoading::where([['type','=','Student'],['program','=','done'],['sy','=',$sy],['id_number', '=' ,$faculty->id]])
        ->get();
        return response()->json([
            'status' => $pdf,
        ]);
    }
    public function get_all_overall2(Request $request){
        $sy = $request->session()->get('school_year');
        $faculty=Faculty::where('id_number','=',$request->session()->get('evaluateeid'))->first();

        $pdf =  StudentSubjectLoading::where([['type','=','Peer'],['program','=','done'],['sy','=',$sy],['id_number', '=' ,$faculty->id]])
        ->get();
        return response()->json([
            'status' => $pdf,
        ]);
    }
    public function get_all_overall3(Request $request){
        $sy = $request->session()->get('school_year');
        $faculty=Faculty::where('id_number','=',$request->session()->get('evaluateeid'))->first();

        $pdf =  StudentSubjectLoading::where([['type','=','Supervisor'],['program','=','done'],['sy','=',$sy],['id_number', '=' ,$faculty->id]])
        ->get();
        return response()->json([
            'status' => $pdf,
        ]);
    }
    public function get_all_overall4(Request $request){
        $sy = $request->session()->get('school_year');
        $faculty=Faculty::where('id_number','=',$request->session()->get('evaluateeid'))->first();

        $pdf =  StudentSubjectLoading::where([['type','=','Self'],['program','=','done'],['sy','=',$sy],['id_number', '=' ,$faculty->id]])
        ->get();
        return response()->json([
            'status' => $pdf,
        ]);
    }
     public function get_all_overall(Request $request){

        $sy = $request->session()->get('school_year');
       $users = Results::where([['sy','=',$sy],['evaluatee_id', '=' ,$request->session()->get('evaluateeid')]])
        ->get();

        
        $users2 = Results::where([['sy','=',$sy],['evaluatee_id', '=' ,$request->session()->get('evaluateeid')]])
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

    public function get_every_result(Request $request){

         $result =  StudentSubjectLoading::where('id','=',$request->id)
            ->first();

        return response()->json([
            'status' =>$result,
        ]);
    }
     public function counting_data(Request $request){

        $sy = $request->session()->get('school_year');
          $schedule = Schedule::where([['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])->first();


           $active = Evaluator::where([['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['status', '=' ,'active']])
        ->get();

        $notactive = Evaluator::where([['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['status', '=' ,null]])
        ->get();
        $evaluators = Evaluator::where([['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus],['sy','=',$sy]])->get();
         $evaluatee = Faculty::where([['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus],['sy','=',$sy]])->get();

         $a = Evaluator::where([['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['course', '=' ,'College of Computer Studies']])->get();
         $b = Evaluator::where([['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['course', '=' ,'College of Business Management']])->get();
         $c = Evaluator::where([['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['course', '=' ,'College of Teachers Education']])->get();
         $d = Evaluator::where([['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['course', '=' ,'College of Agriculture and Forestry']])->get();
         $e = Evaluator::where([['sy','=',$sy],['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid],['course', '=' ,'College of Criminal Justice Education']])->get();



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
            ]);
     }
}
