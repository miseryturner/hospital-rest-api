<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    public function record(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id'   => 'required|numeric',
            'doctor_id' => 'required|numeric|exists:doctors,id',
            'date'      => 'required|date|unique:records,date|after:today',
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

        $record = Record::create([
            'user_id'   => $request->get('user_id'),
            'doctor_id' => $request->get('doctor_id'),
            'date'      => $request->get('date')
        ]);

        return response()->json($record);
    }
}
