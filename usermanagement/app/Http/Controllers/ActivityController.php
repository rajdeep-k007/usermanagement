<?php

namespace App\Http\Controllers;

use App\Models\activitylog;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // To show list of all activity
    public function show(){
        $activityLogs = activitylog::paginate(5);
        return view('pages/activityPage/activitylogs', compact('activityLogs'));
    }

    // To remove item
    public function remove($id){
        $item = activitylog::find($id);
        if($item){
            $item->delete();
        }
        return redirect('/activitylist');
    }
}
