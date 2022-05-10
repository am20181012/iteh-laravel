<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiagnosisCollection;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class UserDiagnosisController extends Controller
{
    public function index($user_id)
    {
        $diagnosis = Diagnosis::get()->where('user_id', $user_id);
        if (is_null($diagnosis)) {
            return response()->json('Data not found', 404);
        }
        return response()->json(new DiagnosisCollection($diagnosis));
    }
}
