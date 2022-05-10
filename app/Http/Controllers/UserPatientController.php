<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientCollection;
use App\Models\Patient;
use Illuminate\Http\Request;

class UserPatientController extends Controller
{
    public function index($user_id){
        $patients = Patient::get()->where('user_id', $user_id);
        if(is_null($patients)){
            return response()->json('Data not found', 404);
        }
        // return response()->json($diagnosis);
        return response()->json(new PatientCollection($patients));
    }
}
