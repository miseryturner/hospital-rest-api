<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function regiter(Request $request) {
        $validator = Validator::make($request->all(), [
            'last_name'  => 'required|max:50',
            'patronymic' => 'required|max:50',
            'mobile'     => 'required|unique:users,mobile|min:12|max:12',
            'password'   => 'required|min:6',
            'policy'     => 'required|unique:users,policy|min:16',
            'birthday'   => 'required|date',
            'gender'     => 'required|max:1',
            'address'    => 'required|max:255'
        ]);

        if($validator->fails()) {
            $responseData = [
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->messages()
                ]
            ];

            return response()->json($responseData, 422);
        }

        $token = User::generateToken();

        $new_user = User::create([
            'last_name'  => $request->last_name,
            'patronymic' => $request->patronymic,
            'mobile'     => $request->mobile,
            'password'   => Hash::make($request->password),
            'policy'     => $request->policy,
            'birthday'   => $request->birthday,
            'gender'     => $request->gender,
            'address'    => $request->address,
            'token'      => $token
        ]);

        return response()->json(['token' => $new_user->token], 200);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'mobile'    => 'required|min:12|max:12',
            'password'  => 'required|min:6'
        ]);

        if($validator->fails()) {
            $responseData = [
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->messages()
                ]
            ];

            return response()->json($responseData, 422);
        }

        $user = User::where('mobile', $request->mobile)->first();

        if($user) {
            if(Hash::check($request->password, $user->password)) {
                return response()->json(['token' => $user->token]);
            } else {
                $responseData = [
                    'error' => [
                        'code' => 401,
                        'message' => 'Incorrect password'
                    ]
                ];
    
                return response()->json($responseData, 401);
            }
        } else { 
            $responseData = [
                'error' => [
                    'code' => 401,
                    'message' => 'User with this phone number not found'
                ]
            ];

            return response()->json($responseData, 401);
        } 
    }

    public function patient(Request $request) {
        $user = User::where('id', $request->get('user_id'))->first();
        return response()->json($user);
    }
}
