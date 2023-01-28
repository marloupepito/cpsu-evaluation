<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\FacultySubjectLoading;
use App\Models\StudentSubjectLoading;

class StudentsController extends Controller
{
    
    public function evaluator_session2(Request $request){
        $data=StudentSubjectLoading::where([['program','=',null],['unique_id','=',$request->session()->get('key')]])->first();
        return response()->json([
            'status' =>$data,
            'evaluator' => $request->session()->get('evaluator')
        ]);
        $request->session()->put('type','student');
    }
    public function add_student_subject_loading(Request $request){

        $date = date('Y');
        for ($i=0; $i < count($request->data); $i++) { 
                StudentSubjectLoading::create([
                'id_number' => $request->data[$i][0],//
                'unique_id' =>  $request->session()->get('key'),//
                'campus' => $request->session()->get('e_campus'),//
                'school_year' => $request->session()->get('e_year'),//
                'campusid' => $request->session()->get('e_campusid'),//
                'subject' => $request->data[$i][2],//
                'semester' =>$request->session()->get('e_sem'), //
                'faculty_name' => $request->data[$i][1],//
                'department' => $request->data[$i][3],
                'section' => $request->session()->get('e_section'),//
                'sy' => $request->session()->get('e_sy'),//
                'type' => 'Student',//
                'year' => $date,//
                ]);
        }
        return response()->json([
            'status' =>$request->data,
        ]);
    }
    
    public function get_subject_load_from_teacher(Request $request){   
       $load= FacultySubjectLoading::where([['campusid','=',$request->session()->get('e_campusid')],
       // ['department','=',$request->session()->get('e_course')],
        ['section','=',$request->session()->get('e_section')],
        ['year','=',$request->session()->get('e_year')],
        ['sy','=',$request->session()->get('e_sy')],
        ['semester','=',$request->session()->get('e_sem')]])->get();
        // StudentSubjectLoading::where('id', $request->id2)
        // ->update(['program' => 'active']);
        return response()->json([
            'status' =>$load,
        ]);
    }
    public function add_student_info(Request $request){                    
       
        $request->session()->put('e_course',$request->course);
        $request->session()->put('e_section',$request->section);
        $request->session()->put('e_year',$request->year);
        $request->session()->put('e_sy',$request->sy);
        $request->session()->put('type','student');

        $m = date("m");
        if($m === '08' || $m === '09' || $m === '10' || $m === '11' || $m === '12'){
            $request->session()->put('e_sem','1st Semester');
        }else if($m === '01' || $m === '02' || $m === '03' || $m === '04' || $m === '05'){
            $request->session()->put('e_sem','2nd Semester');
        }
        $request->session()->put('evaluator',$request->name);
        $request->session()->put('key',rand(1000000,9999999));
        $student = new Students;
        $student->id_number = $request->name; 
        $student->password = $request->session()->get('key'); 
        $student->campusid = $request->session()->get('e_campusid'); 
        $student->campus = $request->session()->get('e_campus'); 
        $student->course = $request->course; 
        $student->school_year = $request->year; 
        $student->section = $request->section; 
        $student->signature = $request->signature;
        $student->semester = $request->session()->get('e_sem');
        $student->sy = $request->sy;
        $student->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
