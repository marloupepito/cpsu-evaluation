<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Evaluator;
use App\Models\User;

class FacultySubjectLoadingController extends Controller
{
    public function get_all_admin_dashboard_data(Request $request){

        $sy = $request->session()->get('school_year');
        $campus = User::where('academic_rank','<>','Main Administrator Campus')->get();
         $faculty = Faculty::where('sy','=',$sy)->get();
         $evaluator = Evaluator::where('sy','=',$sy)->get();
         $active = Evaluator::where([['sy','=',$sy],['status','=','active']])->get();
         $notactive = Evaluator::where([['sy','=',$sy],['status','=',null]])->get();

         $active2 = Faculty::where([['sy','=',$sy],['status','=','active']])->get();
         $notactive2 = Faculty::where([['sy','=',$sy],['status','=',null]])->get();
         return response()->json([
            'campus' => $campus,
            'faculty' => $faculty,
            'evaluator' => $evaluator,
            'active' => $active,
            'notactive' => $notactive,
            'active2' => $active2,
            'notactive2' => $notactive2,
        ]);
    }

    public function get_every_campuses(Request $request){
        $sy = $request->session()->get('school_year');
         $active = Evaluator::where([['sy','=',$sy],['status','=','active'],['campusid','=',$request->campusid]])->get();
         $notactive = Evaluator::where([['sy','=',$sy],['status','=',null],['campusid','=',$request->campusid]])->get();
         $student = Evaluator::where([['sy','=',$sy],['campusid','=',$request->campusid]])->get();

         $active2 = Faculty::where([['sy','=',$sy],['status','=','active'],['campusid','=',$request->campusid]])->get();
         $notactive2 = Faculty::where([['sy','=',$sy],['status','=',null],['campusid','=',$request->campusid]])->get();
         $faculty = Faculty::where([['sy','=',$sy],['campusid','=',$request->campusid]])->get();

             return response()->json([
                'active' => $active,
                'active2' => $active2,
                'notactive' => $notactive,
                'notactive2' => $notactive2,
                'student' => $student,
                'faculty' => $faculty,
            ]);
    }


    public function get_school_year(Request $request){
        $request->session()->put('school_year',$request->sy);
         $aa = $request->session()->get('school_year');
        $sy = $aa;
         return response()->json([
                'status' => $sy,
            ]);
    }
}
