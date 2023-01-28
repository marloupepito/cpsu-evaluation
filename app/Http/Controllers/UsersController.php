<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Faculty;
class UsersController extends Controller
{
    
     public function add_campus(Request $request){
         $request->validate([
            'campusname'=>['required'],
            'campusadmin'=>['required'],
            'campusrank'=>['required'],
            'campususername'=>['required'],
            'campuspassword'=>['required'],
        ]);

        $user = new User;
        $user->name = $request->campusadmin;
        $user->username = $request->campususername;
        $user->assigned_person = $request->assignedPerson;
        $user->password = Hash::make($request->campuspassword);
        $user->campus = $request->campusname;
        $user->academic_rank = $request->campusrank;
        $user->save();

            $ab = User::orderBy('id', 'DESC')->first();
            $user = new Faculty;
            $user->id_number = $request->campususername;
            $user->campusid = $ab->id;
            $user->password = Hash::make($request->campuspassword);
            $user->campus = $request->campusname;
            $user->photos = 'sample.jpg';
            $user->name = $request->assignedPerson;
            $user->department = 'admin';
            $user->academic_rank = 'admin';
            $user->save();
       
     }
   public function user_login(Request $request){
        $request->validate([
            'username'=>['required'],
            'password'=>['required'],
        ]);

        if(Auth::attempt($request->only('username','password'))){
            return response()->json([
                'status' => Auth::user(),
                'console' =>'success'
            ]);
        }else{
            return response()->json([
                'status' => 'Incorrect username or password!',
                'console' =>'error'
            ]);
        }
        throw ValidationException::withMessages([
            'username' => ['Incorrect username or password!'],
            'console' =>'error'
        ]);
        
    }
    public function get_all_users(Request $request){
        $users = User::orderBy('id', 'DESC')
        ->get();


        return response()->json([
            'status' => $users,
        ]);


    }
    public function logout(){
      Auth::logout();
    }
     public function get_all_users2(Request $request){

         $users = DB::table('users')
        ->where('academic_rank', '<>' ,'Main Administrator Campus')
        ->get();
        return response()->json([
            'status' => $users
        ]);
    }


     public function get_admin(Request $request){


        $users = DB::table('users')
        ->where([['campus', '=' ,$request->campus],['id', '=' ,$request->campusid],['academic_rank', '=' ,$request->academic_rank]])
        ->first();
        return response()->json([
            'status' => $users
        ]);
    }
}
