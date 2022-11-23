<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacultySubjectLoading;
use App\Models\Evaluator;
class StudentSubjectLoadingController extends Controller
{
   
   public function get_student_subject_loading(Request $request){
            $users= Evaluator::where('id','=', $request->id)->first();
            $loading = FacultySubjectLoading::where([['department','=',$users->course],['year','=',$users->school_year],['semester','=',$users->semester]])->get();
            return response()->json([
                'status' => $users,
                'status2' => $loading,
             ]);
   }

}
