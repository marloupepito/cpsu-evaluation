<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
class ScheduleController extends Controller
{
    public function get_schedule(Request $request){
        $users = Schedule::where([['campus','=',$request->campus],['campusid','=',$request->campusid]])->get();
        return response()->json([
            'status' => $users
        ]);
    }
     public function update_schedule(Request $request){
        $request->validate([
            'start'=>['required'],
            'end'=>['required'],
        ]);

        $aa = Schedule::where([['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])
          ->update([
            'start' => $request->start,
            'end' => $request->end,
            ]);
          if($aa){
             $users = Schedule::where([['campus','=',$request->campus],['campusid','=',$request->campusid]])->get();
             return response()->json([
                'status' => $users
             ]);
          }
    }
     public function change_sem(Request $request){
        $request->validate([
            'semester'=>['required'],
        ]);

        $aa = Schedule::where([['campus', '=' ,$request->campus],['campusid', '=' ,$request->campusid]])
          ->update([
            'semester' => $request->semester,
            ]);
          if($aa){
             $users = Schedule::where([['campus','=',$request->campus],['campusid','=',$request->campusid]])->get();
             return response()->json([
                'status' => $users
             ]);
          }
    }
}
