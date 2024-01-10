<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required|max:50',
            'patronymic' => 'required|max:50',
            'mobile' => 'required|min:12|max:12',
            'password' => 'required|min:6',
            'policy' => 'required|min:16',
            'birthday' => 'required|date',
            'gender' => 'required|max:1',
            'address' => 'required|max:255'
        ]);

        if($validator->fails()) {
            $data = [
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->messages()
                ]
            ];

            return response()->json($data, 422);
        }

        $new_user = User::create([
            'last_name' => $request->last_name,
            'patronymic' => $request->patronymic,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'policy' => $request->policy,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        return response()->json(['data' => $new_user], 200);
    }
}
