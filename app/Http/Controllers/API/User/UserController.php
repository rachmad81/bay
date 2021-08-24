<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use Hash,DB;

class UserController extends Controller
{
    function get(Request $request){
        $token = $request->token;
        $id = $request->id;

        $get_user = Users::find($id);

        if(!empty($get_user)){
            $return = [
                'status'=>'success',
                'code'=>'200',
                'message'=>'Data ditemukan',
                'data'=>$get_user,
            ];
        }else{
            $return = [
                'status'=>'error',
                'code'=>'250',
                'message'=>'Data kosong',
                'data'=>'',
            ];
        }

        return $return;
    }

    function simpan(Request $request){
        $token = $request->token;
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;


        if($id==0){
            $data_simpan = [
                'name'=>$name,
                'email'=>$email,
                'password'=>Hash::make($password),
                'token'=>md5($email),
            ];
            $simpan = DB::table('users')->insert($data_simpan);

            if($simpan){
                $return = [
                    'status'=>'success',
                    'code'=>'200',
                    'message'=>'Berhasil disimpan',
                    'data'=>$simpan,
                ];
            }else{
                $return = [
                    'status'=>'error',
                    'code'=>'250',
                    'message'=>'Gagal menyimpan',
                    'data'=>'',
                ];
            }
        }else{
            $data_update = [
                'name'=>$name,
                'email'=>$email,
            ];
            $get_user = Users::find($id);
            if(!empty($get_user)){
                $simpan = DB::table('users')->where('id',$id)->update($data_update);

                if($simpan){
                    $return = [
                        'status'=>'success',
                        'code'=>'200',
                        'message'=>'Berhasil diupdate',
                        'data'=>$simpan,
                    ];
                }else{
                    $return = [
                        'status'=>'error',
                        'code'=>'250',
                        'message'=>'Gagal menyimpan',
                        'data'=>'',
                    ];
                }
            }else{
                $return = [
                    'status'=>'error',
                    'code'=>'250',
                    'message'=>'User tidak ditemukan',
                    'data'=>'',
                ];
            }
        }
        return $return;
    }

    function hapus(Request $request){
        $token = $request->token;
        $id = $request->id;

        $get_user = Users::find($id);

        if($get_user){
            $hapus = $get_user->delete();
            if($hapus){
                $return = [
                    'status'=>'success',
                    'code'=>'200',
                    'message'=>'Berhasil dihapus',
                    'data'=>'',
                ];
            }else{    
                $return = [
                    'status'=>'error',
                    'code'=>'250',
                    'message'=>'Gagal dihapus',
                    'data'=>'',
                ];
            }
        }else{
            $return = [
                'status'=>'error',
                'code'=>'250',
                'message'=>'Data kosong',
                'data'=>'',
            ];
        }

        return $return;
    }
}
