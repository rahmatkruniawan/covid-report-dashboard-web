<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(){ 
		if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
			$user = Auth::user();
			$user->customer;
			return response()->json([
				'status' => $this->successStatus,
				'message' => 'OK',
				'data' => $user->toArray()
			], $this->successStatus);
		} else{
		   	return response()->json(['status' => $status = 401, 'error'=>'Unauthorised'], $status); 
		} 
	}
}
