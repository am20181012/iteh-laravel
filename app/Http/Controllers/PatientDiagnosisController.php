<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiagnosisCollection;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class PatientDiagnosisController extends Controller
{
    public function index($patient_id){
        $diagnosis = Diagnosis::get()->where('patient_id', $patient_id);
        if(is_null($diagnosis)){
            return response()->json('Data not found', 404);
        }
        // return response()->json($diagnosis);
        return response()->json(new DiagnosisCollection($diagnosis));
    }
}
