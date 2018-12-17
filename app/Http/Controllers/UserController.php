<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
	//View List of User Function
    public function viewUser()
    {
    	$users = User::all();
    	return view('user.index', compact('users'));
    }

    //View Add Form
    public function viewAddUser()
    {
    	return view('user.add');
    }

    //Add Record 
    public function addUser(Request $request)
    {
    	$data = User::create([
    		'name' => $request['name'],
    		'email' => $request['email'],
    		'password' => bcrypt($request['password']),
    	]);

    	return redirect()->route('viewUser');
    }

    //View Edit User Form

    public function viewEditUser($id)
    {
        $data = User::getSingleData($id);
        return view('user.edit', compact('data'));
    }

    //Save Edit User

    public function editUser(Request $request, $id)
    {
        $user = User::find($id);

        if(Input::get('password') !='')
            {
                $user->bcrypt(Input::get('password'));
            }

        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->save();

        return redirect()->route('viewUser');
    }

    //DELETE USER

    public function deleteUser($id)
    {
        User::destroy($id);
        return redirect()->route('viewUser');
    }
}
