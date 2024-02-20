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

    public function show($id) {
        $record = Record::with(['user', 'doctor'])->where('id', $id)->first();
        if($record) {
            $responseData = [
                'error' => [
                    'code' => 404,
                    'message' => 'Record not found'
                ]
            ];

            return response()->json($responseData, 422);
        }

        return response()->json($record);
    }

    public function getRecordByDoctor($id) {
        $record = Record::with(['user', 'doctor'])->where('doctor_id', $id)->get();
        if($record->isEmpty()) {
            $responseData = [
                'error' => [
                    'code' => 404,
                    'message' => 'Records not found'
                ]
            ];

            return response()->json($responseData, 422);
        }

        return response()->json($record);
    }

    public function getRecordByUserId($id) {
        $record = Record::with(['user', 'doctor'])->where('user_id', $id)->get();
        if($record->isEmpty()) {
            $responseData = [
                'error' => [
                    'code' => 404,
                    'message' => 'Records not found'
                ]
            ];

            return response()->json($responseData, 422);
        }

        return response()->json($record);
    } 
}
