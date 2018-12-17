<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\User;
use DB;
use App\Aduan;
use\Illuminate\Support\Facades\Input;


class APIController extends Controller
{
    //Register API

    public function Register (Request $request)
    {

    	//Check to validate input

    	$validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
        ]);

    	if($validator->fails()){
                     return response()->json($validator->errors()->toJson(), 400);
              }


        //Save Register in DB

           $user = User::create([
                'username' => $request->get('username'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(['message' => 'Successfully Register ', 'status' => true, 'user' => $user, 'token' => $token], 201);


    }

    //Login Function

    public function authenticate(Request $request)
        {
            $credentials = $request->only('username', 'password');
            
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            $user_name = $request->username;
            $userid=User::where('username', '=', $user_name)->value('id');

            $data = DB:: table('users')
                    -> select ('id','username', 'name')
                    -> where('id',$userid)
                    -> get();

             
            return response()->json([
                        'access_token' => $token,
                        'token_type' => 'bearer',
                        'status' => true,
                        'users' => $data            
                    ]);

            return response()->json(compact('data'));

        }


        //LOGOUT FUNCTION

        public function logout()
        {
            $this->guard()->logout();
                
            return response()->json(['message' => 'Successfully logged out']);
        }

                    /**
             * Get the guard to be used during authentication.
             *
             * @return \Illuminate\Contracts\Auth\Guard
             */
        public function guard()
        {
           return Auth::guard('api');
        }


        //Create New Aduan

        public function CreateAduan()
        {
	    	$aduan = new Aduan;
	    	$aduan->title = Input::get('title');
	    	$aduan->kategori = Input::get('kategori');
	    	$aduan->masalah = Input::get('masalah');
	    	$aduan->status = 'Pending';
	    	$aduan->user_id_fk = Input::get('user_id');
	    	$aduan->save();

	    	$feedData = Aduan::orderBy('created_at', 'desc')->first();

	    	return response()->json(['message' => 'Aduan has been created', 'status' =>true, 'feedData'=> $feedData],201);
        }

        //Get All Aduan

        public function GetAllAduan()
        {
        	$feedData = DB::table('aduans')
        				->select('aduan_id', 'title', 'kategori', 'masalah', 'status', 'user_id_fk', 'created_at')
        				->get();

        	return response()->json(['feedData'=> $feedData], 201);
        }

        //GET ADUAN FOR SPECIFIC ID

        public function GetAduan($user_id)
        {
        	$feedData = DB::table('aduans')
        				->select('aduan_id', 'title', 'kategori', 'masalah', 'status', 'user_id_fk', 'created_at')
        				->where('user_id_fk', $user_id)
        				->get();

        	return response()->json(['feedData'=> $feedData], 201);
        }

        //Update Aduan

        public function UpdateAduan(Request $request, $aduan_id)
        {
        	$input = $request->all();
        	$aduan = Aduan::find($aduan_id);
        	$aduan->update($input);
        	$aduan->save();

        	$feedData = DB::table('aduans')
        				->select('aduan_id', 'title', 'kategori', 'masalah', 'status', 'user_id_fk', 'created_at')
        				->where('aduan_id', $aduan_id)
        				->get();

        	return response()->json(['message'=> 'Aduan has been update', 'status'=> true, 'feedData'=> $feedData], 201);


        }


        //Delete Aduan Function

        public function DeleteAduan($aduan_id)
        {
        	Aduan::destroy($aduan_id);
        	return response()->json(['message'=> 'Aduan has been delete', 'status'=> true], 201);
        }

}
