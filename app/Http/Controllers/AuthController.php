<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
  public function login(Request $request) {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required|string|min:6',
    ]);
    if ($validator->fails()) {
      $data = ['error' => $validator->errors()->toJson(), 'success' => false];
      return response()->json($data, 400);
    }
    // dd(auth()->user());
    if (!auth()->attempt($validator->validated())) {
      return response(['error_message' => 'Incorrect Credentials. Please try again']);
    }
    $token = auth()->user()->createToken('API Token')->accessToken;
    return response(['user' => auth()->user(), 'token' => $token]);
  }

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|between:2,100',
      'email' => 'required|string|email|max:100|unique:users',
      'password' => 'required|string|confirmed|min:6',
    ]);
    if($validator->fails()){
      $data = ['error' => $validator->errors()->toJson(), 'success' => false];
      return response()->json($data, 400);
    }
    $data = $request->only('name', 'email', 'password');
    $data['password'] = bcrypt($request->password);
    $user = User::create($data);
    $token = $user->createToken('API Token')->accessToken;
    return response([ 'user' => $user, 'token' => $token]);
  }
}
