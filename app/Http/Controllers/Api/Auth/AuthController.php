<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //login
    public function login(Request $request){
      $validate = Validator::make($request->all(),[
        'email' => 'required|email|exists:users',
        'password'=> 'required'
    ]);

    if ($validate->fails()){
      return response()->json([
        'errors' => $validate->errors()
      ],422);
    }

    $reqData = request()->only('email','password');
    if (Auth::attempt($reqData)){
      $user = Auth::user();
      return response()->json([
        $user,
        'loginSuccess' => 'Anda Berhasil Masuk'
      ],200);

    }else {
      return response()-json([
        'loginFailed' => 'Email atau Password Salah'
      ],401);
    }
  }
  //signup
  public function signup(Request $request){
    $validate = Validator::make($request->all(),[
      'username' => 'required|min:5|unique:users',
      'firstname' => 'required',
      'email' => 'required|email|unique:users',
      'phone' => 'required|min:5|unique:users',
      'dateofbirth' => 'required',
      'password'=> 'required|min:5|confirmed'
  ]);

  if ($validate->fails()){
    return response()->json([
      'errors' => $validate->errors()
    ],422);
  }

  $reqData = request()->only('username','firstname','email','phone','dateofbirth','password');
  $reqData['password'] = Hash::make($request->password);
    $user = User::create($reqData);
    Auth::login($user);
    $data['user'] = $user;
    return response()->json([
      $data,
      'signupsuccess' => 'Anda Berhasil Daftar'
    ],200);
  }
  //search
  public function search(Request $request){
    $username01 = $request->input('username');
    $validate = Validator::make($request->all(),[
      'username' => 'required'
  ]);

  if ($validate->fails()){
    return response()->json([
      'errors' => $validate->errors()
    ],422);
  }
    if (DB::table('users')->where('username', $username01)->exists()){
    $reqData = request()->only('username');
    return response()->json([
      $reqData,
      'searchsuccess' => 'User ditemukan'
    ]);
  }else{
    return response()->json([
      'searchsuccess' => 'User tidak ditemukan'
    ],200);
  }
  }
}
