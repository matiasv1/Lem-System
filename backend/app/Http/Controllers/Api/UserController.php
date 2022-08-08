<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller

{
    public function register(Request $request){
        $request->validate([
            'name' =>'required',
            'email' => 'required',
            'telefono'=>'required'
        ]);
        /*$name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $sql = DB::connection('mariadb')
                ->table('users')
                ->insertGetId([
                    'name'    => $name,
                    'email'  => $email,
                    'password'   => $password,
                    
                ]);*/
        $user = new User();
        $user->setConnection('mariadb');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
       
        $user->telefono= $request->input('telefono');
        $user->save();
        return response()->json([
            "status"=>1,
            "msg"=>"",
        ]);
    }

    public function login(Request $request){

    }
    public function userProfile(){

    }
    public function logout(){

    }
}
