<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluator;
use App\Models\Faculty;
use App\Models\User;
use App\Models\StudentSubjectLoading;
use App\Models\FacultySubjectLoading;
use App\Models\Schedule;
class ScannerController extends Controller
{

     public function qrscanner1(Request $request){

 $evaluator = Faculty::where([['id','=',$request->evaluatorid],['campusid','=',$request->campusid],['password','=',$request->password]])->get();
        if($evaluator !== 0){
             $request->session()->put('evid',$evaluator[0]->id);
             $request->session()->put('evaluator',$evaluator[0]->name );
             $request->session()->put('campus',$evaluator[0]->campus );
             $request->session()->put('campusid',$evaluator[0]->campusid );
             $request->session()->put('semester',$evaluator[0]->semester );
             $request->session()->put('sy',$evaluator[0]->sy );
             $request->session()->put('rank',$evaluator[0]->academic_rank );
                return response()->json([
                    'status' => 'proceed',
                    'type' => $request->type
                ]);
           
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    public function qrscanner2(Request $request){

        if($request->campusid === $request->campusid2){
            $request->session()->put('e_campusid',$request->campusid);
            $request->session()->put('e_campus',$request->campus);
            $request->session()->put('e_type',$request->type);
            return response()->json([
                'status' => 'success',
                'type' => $request->type
            ]);
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }
    }
     public function qrscanner(Request $request){

         $request->validate([
            'evaluator'=>['required'],
            'evaluatorid'=>['required'],
            'password'=>['required'],
            'campus'=>['required'],
            'campusid'=>['required'],
        ]);

        $date = date("Y");
        
        if($request->evaluator === 'student'){
           $evaluator = Evaluator::where([['id','=',$request->evaluatorid],['campusid','=',$request->campusid],['password','=',$request->password]])->first();
           if($evaluator !== null){

            $loaded = FacultySubjectLoading::where([['section','=',$evaluator->section],['campusid','=',$request->campusid],['department','=',$evaluator->course],
            ['sy','=',$evaluator->sy],['semester','=',$evaluator->semester]])->get(); //check subject loaded

            if(count($loaded) !== 0){

                $eForm1=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=',null]])
                 ->orWhere([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=','done']])->get(); //check form exist.

                 $eForm2=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=',null]])->get(); //check remaining form

                 $eForm3=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=','done']])->get(); //check done evaluate

                if(count($eForm1) === 0){
                    foreach ($loaded as $load) {
                        $aa = Faculty::where('id',$load->id_number)->first();
                        StudentSubjectLoading::create([
                            'evaluator_id' => $evaluator->id,
                            'unique_id' =>$evaluator->id_number,
                            'id_number' => $load->id_number,
                            'campus' => $evaluator->campus,
                            'school_year' => $evaluator->school_year,
                            'campusid' => $evaluator->campusid,
                            'subject' => $load->subject,
                            'semester' => $evaluator->semester,
                            'faculty_name' => $aa->name,
                            'academic_rank' => $aa->academic_rank,
                            'department' => $evaluator->department,
                            'section' => $evaluator->section,
                            'sy' => $evaluator->sy,
                            'type' => 'Student',
                            'year' => $date,
                        ]);
                    }

                    $request->session()->put('campusid',$evaluator->campusid);
                    $request->session()->put('evaluatorid',$evaluator->id);
                    $request->session()->put('semester',$evaluator->semester);
                    $request->session()->put('sy',$evaluator->sy);
                    $request->session()->put('type',$request->evaluator);
                    $request->session()->put('course',$evaluator->course);

                    return response()->json([
                        'status' => 'proceed',
                    ]);
                }else{
                    if(count($eForm2) !== 0){
                    $request->session()->put('campusid',$evaluator->campusid);
                    $request->session()->put('evaluatorid',$evaluator->id);
                    $request->session()->put('semester',$evaluator->semester);
                    $request->session()->put('sy',$evaluator->sy);
                    $request->session()->put('type',$request->evaluator);
                    $request->session()->put('course',$evaluator->course);
                        return response()->json([
                            'status' =>'continue'
                        ]);
                    }else if(count($eForm1) === count($eForm3)){
                        return response()->json([
                            'status' =>'done'
                        ]);
                    }
                   
                }
                
            }else{
                return response()->json([
                    'status' =>"No Subject Found!"
                ]);
            }

          }else{
                return response()->json([
                    'status' => 'Incorrect QR Code!'
                ]);
          }
           
        }else if($request->evaluator === 'faculty'){
            $evaluator = Faculty::where([['id','=',$request->evaluatorid],['campusid','=',$request->campusid],['password','=',$request->password]])->first();
            if($evaluator !== null){
                $coWorker = Faculty::where([['campusid','=',$evaluator->campusid],['department','=',$evaluator->department]])
                ->orWhere([['campusid','=',$evaluator->campusid],['department','=','admin']])->get(); //count same faculty,campus


                $eForm1=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=',null]])
                 ->orWhere([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=','done']])->get(); //check form exist.

                 $eForm2=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=',null]])->get(); //check remaining form

                 $eForm3=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=','done']])->get(); //check done evaluate
                 
                 if(count($eForm1) === 0){
                    foreach ($coWorker as $load) {
                        StudentSubjectLoading::create([
                            'evaluator_id' => $evaluator->id,
                            'unique_id' =>$evaluator->id_number,
                            'id_number' => $load->id,
                            'campus' => $evaluator->campus,
                            'school_year' => 'faculty',
                            'campusid' => $evaluator->campusid,
                            'subject' => 'faculty',
                            'semester' => $evaluator->semester,
                            'faculty_name' => $load->name,
                            'academic_rank' => $load->academic_rank,
                            'department' => $evaluator->department,
                            'section' => 'faculty',
                            'sy' => $evaluator->sy,
                            'year' => $date,
                            'type' => $request->evaluatorid == $load->id?'Self':'Peer',
                        ]);
                    }

                    $request->session()->put('campusid',$evaluator->campusid);
                    $request->session()->put('evaluatorid',$evaluator->id);
                    $request->session()->put('semester',$evaluator->semester);
                    $request->session()->put('sy',$evaluator->sy);
                    $request->session()->put('type',$request->evaluator);
                    $request->session()->put('course',$evaluator->department);

                    return response()->json([
                        'status' => 'proceed',
                    ]);
                 }else{
                    if(count($eForm2) !== 0){
                        $request->session()->put('campusid',$evaluator->campusid);
                        $request->session()->put('evaluatorid',$evaluator->id);
                        $request->session()->put('semester',$evaluator->semester);
                        $request->session()->put('sy',$evaluator->sy);
                        $request->session()->put('type',$request->evaluator);
                        $request->session()->put('course',$evaluator->course);
                            return response()->json([
                                'status' =>'continue'
                            ]);
                        }else if(count($eForm1) === count($eForm3)){
                            return response()->json([
                                'status' =>'done'
                            ]);
                        }
                 }

            }else{
                return response()->json([
                    'status' => 'Incorrect QR Code!'
                ]); 
            }
        }else{

            $evaluator = Faculty::where([['id','=',$request->evaluatorid],['campusid','=',$request->campusid],['password','=',$request->password]])->first();
            
            
            if($evaluator !== null){
                $faculty = Faculty::where('campusid','=',$evaluator->campusid)->get();


               $eForm1=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=',null]])
                 ->orWhere([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=','done']])->get(); //check form exist.

               $eForm2=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=',null]])->get(); //check remaining form

               $eForm3=StudentSubjectLoading::where([['campusid','=',$evaluator->campusid],['evaluator_id','=',$evaluator->id],['semester','=', $evaluator->semester],
                 ['sy','=', $evaluator->sy],['program','=','done']])->get();

                
                 if(count($eForm1) === 0){
                    foreach ($faculty as $load) {
                        StudentSubjectLoading::create([
                            'evaluator_id' => $evaluator->id,
                            'unique_id' =>$evaluator->id_number,
                            'id_number' => $load->id,
                            'campus' => $evaluator->campus,
                            'school_year' => 'supervisor',
                            'campusid' => $evaluator->campusid,
                            'subject' => 'supervisor',
                            'semester' => $evaluator->semester,
                            'faculty_name' => $load->name,
                            'academic_rank' => $load->academic_rank,
                            'department' => $evaluator->department,
                            'section' => 'supervisor',
                            'sy' => $evaluator->sy,
                            'year' => $date,
                            'type' => 'Supervisor',
                        ]);
                    }

                    $request->session()->put('campusid',$evaluator->campusid);
                    $request->session()->put('evaluatorid',$evaluator->id);
                    $request->session()->put('semester',$evaluator->semester);
                    $request->session()->put('sy',$evaluator->sy);
                    $request->session()->put('type',$request->evaluator);
                    $request->session()->put('course',$evaluator->department);

                    return response()->json([
                        'status' => 'proceed',
                    ]);
                 }else{
                    if(count($eForm2) !== 0){
                        $request->session()->put('campusid',$evaluator->campusid);
                        $request->session()->put('evaluatorid',$evaluator->id);
                        $request->session()->put('semester',$evaluator->semester);
                        $request->session()->put('sy',$evaluator->sy);
                        $request->session()->put('type',$request->evaluator);
                        $request->session()->put('course',$evaluator->course);
                            return response()->json([
                                'status' =>'continue'
                            ]);
                        }else if(count($eForm1) === count($eForm3)){
                            return response()->json([
                                'status' =>'done'
                            ]);
                        }
                 }



            }else{
                return response()->json([
                    'status' => 'Incorrect QR Code!'
                ]); 
            }
           
        }
       
        
    }
}
