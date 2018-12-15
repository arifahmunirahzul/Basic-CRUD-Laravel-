<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
