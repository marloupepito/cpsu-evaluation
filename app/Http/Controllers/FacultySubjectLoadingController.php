<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Evaluator;
use App\Models\StudentSubjectLoading;
use App\Models\User;

class FacultySubjectLoadingController extends Controller
{
    public function get_all_admin_dashboard_data(Request $request){

        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');

        $campus = User::where('academic_rank','<>','Main Administrator Campus')->get();
         $faculty = Faculty::where([['semester','=',$sem],['sy','=',$sy]])->get();
         $evaluator = StudentSubjectLoading::where([['program','=','done'],['semester','=',$sem],['sy','=',$sy]])->get()->unique('evaluator_id');
         $active = Evaluator::where([['semester','=',$sem],['sy','=',$sy],['status','=','active']])->get();
         $notactive = Evaluator::where([['semester','=',$sem],['sy','=',$sy],['status','=',null]])->get();

         $active2 = Faculty::where([['semester','=',$sem],['sy','=',$sy],['status','=','active']])->get();
         $notactive2 = Faculty::where([['semester','=',$sem],['sy','=',$sy],['status','=',null]])->get();
         return response()->json([
            'campus' => $campus,
            'faculty' => $faculty,
            'evaluator' => count($evaluator),
            'active' => $active,
            'notactive' => $notactive,
            'active2' => $active2,
            'notactive2' => $notactive2,
        ]);
    }

    public function get_every_campuses(Request $request){
        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
         // $active = Evaluator::where([['semester','=',$sem],['sy','=',$sy],['status','=','active'],['campusid','=',$request->campusid]])->get();
         // $notactive = Evaluator::where([['semester','=',$sem],['sy','=',$sy],['status','=',null],['campusid','=',$request->campusid]])->get();
         // $student = Evaluator::where([['semester','=',$sem],['sy','=',$sy],['campusid','=',$request->campusid]])->get();

         // $active2 = Faculty::where([['semester','=',$sem],['sy','=',$sy],['status','=','active'],['campusid','=',$request->campusid]])->get();
         // $notactive2 = Faculty::where([['semester','=',$sem],['sy','=',$sy],['status','=',null],['campusid','=',$request->campusid]])->get();
         // $faculty = Faculty::where([['semester','=',$sem],['sy','=',$sy],['campusid','=',$request->campusid]])->get();

        $active = StudentSubjectLoading::where([['program','=','done'],['semester','=',$sem],['sy','=',$sy],['campusid','=',$request->campusid]])->get();


             return response()->json([
                'status' => $active,
            ]);
    }


    public function get_school_year(Request $request){
        $request->session()->put('school_year',$request->sy);
        $request->session()->put('school_sem',$request->sem);
         $aa = $request->session()->get('school_year');
         $bb = $request->session()->get('school_sem');
        $sy = $aa;
        $sem = $bb;
         return response()->json([
                'status1' => $sy,
                'status2' => $sem,
            ]);
    }

    public function option_evaluator(Request $request){
        if($request->option === 'edit'){
            if($request->type === 'faculty'){
                Faculty::where('id', $request->id)
                  ->update([
                    'name' => $request->name,
                    'department' => $request->department,
                    'academic_rank' => $request->types === "Administrator"?'admin':$request->academic_rank,
                    'id_number' => $request->id_number,
                  ]);
            }else{
                Evaluator::where('id', $request->id)
                  ->update([
                    'id_number' => $request->id_number,
                    'course' => $request->course,
                    'school_year' => $request->school_year,
                    'section' => $request->section,
                    'semester' => $request->semester,
                  ]);
            }
        }else{
             if($request->type === 'faculty'){
                Faculty::where('id', $request->id)->delete();
            }else{
                Evaluator::where('id', $request->id)->delete();
            }
        }
    }
}
