<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;

class UserController extends Controller
{
    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'name'      => 'required',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|min:5|confirmed'
            ]);

            if ($validator->passes()) {
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                return response()->json([
                    'message'   => 'User created successfully',
                    'token'     => $user->createToken("API TOKEN")->plainTextToken
                ], 200);

            } else {

                return response()->json([
                    'message'   => 'Ragistration failed',
                    'errors'    => $validator->errors()
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                'message'   => $e->getMessage(),
                'status'    => false
            ], 500);
        }
    }

    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'email'     => 'required|email|exists:users,email',
                'password'  => 'required'
            ]);

            if ($validator->passes()) {
                if (Auth::attempt($request->only(['email','password']))) {

                    $user = User::where('email',$request->email)->first();

                    return response([
                        'message'   => 'Logged in successful',
                        'status'    => true,
                        'token'     => $user->createToken('API TOKEN')->plainTextToken
                    ],200);

                } else {
                    return response([
                        'message'   => 'credentials does not match',
                        'status'    => false
                    ],401);
                }

            } else {
                return response([
                    'message'   => 'Validation failed',
                    'status'    => false
                ],401);
            }


        } catch (Exception $e) {
            return response([
                'message'   => $e->getMessage(),
                'status'    => false
            ],500);
        }
    }
}
