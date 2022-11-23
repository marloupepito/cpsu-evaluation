<?php

namespace App\Http\Controllers;
use App\Models\Questionaire;
use Illuminate\Http\Request;

class QuestionaireController extends Controller
{
     public function get_questionaire(){
        $users = Questionaire::all();
        return response()->json([
            'status' => $users
        ]);
     }

     public function edit_questionaire1(Request $request){
        $request->validate([
            'q1'=>['required'],
            'q2'=>['required'],
            'q3'=>['required'],
            'q4'=>['required'],
            'q5'=>['required'],
        ]);

        $aa = Questionaire::where('id', '=' ,1)
          ->update([
            'q1' => $request->q1,
            'q2' => $request->q2,
            'q3' => $request->q3,
            'q4' => $request->q4,
            'q5' => $request->q5
            ]);
          if($aa){
            $users = Questionaire::all();
            return response()->json([
                'status' => $users
            ]);
          }
     }
     public function edit_questionaire2(Request $request){
        $request->validate([
            'q6'=>['required'],
            'q7'=>['required'],
            'q8'=>['required'],
            'q9'=>['required'],
            'q10'=>['required'],
        ]);

        $aa = Questionaire::where('id', '=' ,1)
          ->update([
            'q6' => $request->q6,
            'q7' => $request->q7,
            'q8' => $request->q8,
            'q9' => $request->q9,
            'q10' => $request->q10
            ]);
          if($aa){
            $users = Questionaire::all();
            return response()->json([
                'status' => $users
            ]);
          }
     }
     public function edit_questionaire3(Request $request){
        $request->validate([
            'q11'=>['required'],
            'q12'=>['required'],
            'q13'=>['required'],
            'q14'=>['required'],
            'q15'=>['required'],
        ]);

        $aa = Questionaire::where('id', '=' ,1)
          ->update([
            'q11' => $request->q11,
            'q12' => $request->q12,
            'q13' => $request->q13,
            'q14' => $request->q14,
            'q15' => $request->q15
            ]);
          if($aa){
            $users = Questionaire::all();
            return response()->json([
                'status' => $users
            ]);
          }
     }
     public function edit_questionaire4(Request $request){
        $request->validate([
            'q16'=>['required'],
            'q17'=>['required'],
            'q18'=>['required'],
            'q19'=>['required'],
            'q20'=>['required'],
        ]);

        $aa = Questionaire::where('id', '=' ,1)
          ->update([
            'q16' => $request->q16,
            'q17' => $request->q17,
            'q18' => $request->q18,
            'q19' => $request->q19,
            'q20' => $request->q20
            ]);
          if($aa){
            $users = Questionaire::all();
            return response()->json([
                'status' => $users
            ]);
          }
     }
}
