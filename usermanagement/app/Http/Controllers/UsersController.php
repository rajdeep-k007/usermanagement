<?php

namespace App\Http\Controllers;

use App\Models\activitylog;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    // view user page
    public function view($id){
        $user = User::find($id);
        return view('pages/userPage/userDetail', compact('user'));
    }


    // add user page
    public function createUserPage(){
        return view('pages/userPage/createUser');
    }

    // add user
    public function createUser(Request $request){
        $request->validate([
            'username' => 'required|regex:/^[\sA-Za-z0-9]+$/u',
            'useremail' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $input = $request->all();
        User::create($input);

        $log = '';
        $log = session()->get('user')->id;
        $log ;

        activitylog::create($log);
        return redirect('userslist');
    }

    // To show list of all users
    public function show(){
        $users = User::withTrashed()->paginate(5);
        // $users = User::all();
        return view('pages/userPage/users', compact('users'));
    }

    // To remove item
    public function remove($id){
        $item = User::find($id);
        if($item){
            $item->delete();
        }
        return redirect('/userslist');
    }

    // To restore item
    public function restore($id){
        $item = User::withTrashed()->find($id);
        // dd($item);
        if($item){
            $item->restore();
        }
        return redirect('/userslist');
    }

    public function submitEditForm(Request $request){

        // $request->validate([
        //     'location' => 'required|regex:/^[\sA-Za-z0-9]+$/u',
        //     'bio' => 'required',
        // ]);
        $input = $request->all();

        if($input('location')=='' && $input('bio')==''){
            // Nothing to update
        }else{
            // update
            dd($input);
        }

    }

    // block user
    public function ban(Request $request){
        $input = $request->all();

        if(!empty($input['id'])){
                $user = User::find($input['id']);

                $user->bans()->create([
                    'expired_at' => '+1 month',
                    'comment' => $request->baninfo
                ]);
        }

        return redirect()->route('users.index')->with('success', 'Blocked successfully');

    }

    // unblock user
    public function revoke($id){
        if(!empty($id)){
            $user = User::find($id);
            if($user){
                $user->unban();
            }
        }

        return redirect()->route('users.index')->with('success','User unblocked successfully');

    }

}
