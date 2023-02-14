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
         $sy = $request->session()->get('school_year');
         $sem = $request->session()->get('school_sem');
    	 $request->validate([
            'status'=>['required'],
            'campusid'=>['required'],
            'campus'=>['required'],
        ]);
        $users = Faculty::where([['department', '=' ,$request->department],['semester', '=' ,$sem],['sy', '=' ,$sy],['campusid', '=' ,$request->campusid],['campus', '=' ,$request->campus]])
        ->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => $users
        ]);
    }



 public function faculty_add_signature(Request $request){

        Faculty::where('id',$request->session()->get('evid'))
        ->update(['signature' => $request->signature]);
         $request->session()->put('department',$request->department);
         $request->session()->put('campusid',$request->campusid);
         $request->session()->put('key',rand(1000000,9999999));
        return response()->json([
            'status' =>'success'
        ]);
    }


 public function get_every_faculty2(Request $request){

        $users = Faculty::where([['semester', '=' ,$request->session()->get('semester')],['sy', '=' ,$request->session()->get('sy')],['id', '=' ,$request->session()->get('evid')]])->first();

        return response()->json([
            'status' => $users
        ]);
    }

     public function get_every_faculty(Request $request){
         $sy = $request->session()->get('school_year');
         $sem = $request->session()->get('school_sem');
        $users = Faculty::where([['semester', '=' ,$sem],['sy', '=' ,$sy],['id', '=' ,$request->id]])->first();
        return response()->json([
            'status' => $users
        ]);
    }
   
     public function add_faculty(Request $request){
        $sy = $request->session()->get('school_year');
        $sem = $request->session()->get('school_sem');
         $request->validate([
            'idNumber'=>['required'],
            'campusid'=>['required'],
            'campus'=>['required'],
            'name'=>['required'],
            'department'=>['required'],
            'rank'=>['required'],
            'sy'=>['required'],
        ]);
         $user = new Faculty;
        $user->id_number = $request->idNumber;
        $user->password = Hash::make($request->idNumber.$request->campusid.$request->campus.$request->name);
        $user->campusid = $request->campusid;
        $user->campus = $request->campus;
        $user->name = $request->name;
        $user->semester = $request->session()->get('school_sem');
        $user->department = $request->department;
        $user->academic_rank = $request->type === "Administrator"?'admin':$request->rank;
        $user->sy = $request->sy;
        $user->save();

        

        if($request->status === 'Faculty'){
            $users = Faculty::where([['semester', '=' ,$sem],['sy', '=' ,$sy],['status','=',$request->status],['campus','=',$request->campus],['campusid','=',$request->campusid]])->get();
            return response()->json([
                'status' => $users
            ]);
        }else{
                $users = Faculty::where([['semester', '=' ,$sem],['sy', '=' ,$sy],['status','=',$request->status],['campus','=',$request->campus],['campusid','=',$request->campusid]])->get();
                 return response()->json([
                    'status' => $users
                ]);
        }
       
    }
}
