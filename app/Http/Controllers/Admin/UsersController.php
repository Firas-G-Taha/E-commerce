<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        // dd( Auth::user()->id);
        // dd(session()->get());
        $users = User::where('id','<>',Auth::user()->id)->get();
        return view('/admin/users/index',[
            'users' => $users
        ]);
    }

    public function makeAdmin($id){
        
        $user = User::where('id',$id)->update([
            'admin' => 1,
        ]);
        return redirect('/admin/users');
    }
    public function removeAdmin($id){
       
        $user = User::where('id',$id)->update([
            'admin' => 0,
        ]);
        return redirect('/admin/users');
    }

    public function delete($id){
        User::where('id' ,$id)->first()->delete();

    }



}
