<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use Hash,DB,Auth;

class LoginController extends Controller
{
	function login(Request $request){
		$username = $request->username;
		$passsword = $request->passsword;

		$get_user = DB::table('users')->whereRaw("email='$username'")->first();

		if(!empty($get_user)){
			if(Hash::check($passsword,$get_user->password)){
				$response = [
					'code'=>'200',
					'message'=>'Data ditemukan',
					'status'=>'success',
					'data'=>$get_user,
				];
			}else{
				$response = [
					'code'=>'250',
					'message'=>'Password salah',
					'status'=>'error',
					'data'=>'',
				];	
			}
		}else{
			$response = [
				'code'=>'250',
				'message'=>'User not found',
				'status'=>'error',
				'data'=>'',
			];
		}

		retur $response;
	}
}
