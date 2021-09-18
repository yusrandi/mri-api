<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)     
    {
        $hasher = app()->make('hash');
        $email = $request->email;
        $password = $request->password;

        $login = Pegawai::where(['email'=> $email])->first();

        if(!$login){

            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Maaf email anda tidak terdaftar',
                'pegawai' => new Pegawai()
            ], 201);
        }else{
            if($hasher->check($password, $login->password)){

                $data = Pegawai::where('id', $login->id)->first();

                    return response()->json([
                        'responsecode' => '1',
                        'responsemsg' => 'Selamat datang',
                        'pegawai' => $data
                    ], 201);
                
            }else{
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Maaf password anda salah',
                    'pegawai' => new Pegawai()
                ], 201);
            }
        }

    }

    public function register(Request $request)
    {
        $hasher = app()->make('hash');
        $login = User::where('email', $request->email)->first();

        if($login){
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Maaf email sudah terdaftar'
                
            ], 401);
        }else{
            

            $insert = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$hasher->make($request->password),
            ]);


            if($insert){
                    return response()->json([
                        'responsecode' => '1',
                        'responsemsg' => 'anda berhasil terdaftar',
                        'responsedata' => $insert
                    ], 201);
            }else{
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'terjadi kesalahan'
                    
                ], 401);
            }
        }
    }
}
