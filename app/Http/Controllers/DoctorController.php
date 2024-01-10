<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request) {
        if($request->get('speciality-id')) {
            $doctors = Doctor::where('speciality_id', $request->get('speciality-id'))->with('speciality')->get();
        } else {
            $doctors = Doctor::with('speciality')->get();
        }

        if($doctors->isEmpty()) {
            $responseData = [
                'error' => [
                    'code' => 404,
                    'message' => 'Doctors not found'
                ]
            ];

            return response()->json($responseData);
        }

        return response()->json($doctors);
    }

    public function search(Request $request) {
        $query = $request->get('query');
        $doctors = Doctor::where('name', 'like', "%$query%")->get();

        return response()->json($doctors);
    }
}
