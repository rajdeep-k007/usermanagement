<?php

namespace App\Http\Controllers;

use App\Models\permissionsmodel;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // To show list of all permissions
    public function show(){
        $permissions = permissionsmodel::paginate(5);
        return view('pages/permissionPage/permissions', compact('permissions'));
    }

    // To remove item
    public function remove($id){
        $item = permissionsmodel::find($id);
        if($item){
            $item->delete();
        }
        return redirect('/permissionslist');
    }


    // to redirect to create role page
    public function createPage(){
        return view('/pages/permissionPage/createRole');
    }


    // to create role
    public function create(){

    }

}
