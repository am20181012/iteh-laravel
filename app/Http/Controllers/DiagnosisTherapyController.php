<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiagnosisResource;
use App\Http\Resources\TherapyCollection;
use App\Http\Resources\TherapyResource;
use App\Models\Diagnosis;
use App\Models\Therapy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnosisTherapyController extends Controller
{
    public function index($diagnosis_id)
    {
        $therapies = Therapy::get()->where('diagnosis_id', $diagnosis_id);
        if (is_null($therapies)) {
            return response()->json([
                'Data not found.', 404
            ]);
        }
        return response()->json(new TherapyCollection($therapies));
    }

    public function show(Diagnosis $diagnosis, Therapy $therapy)
    {
        return response()->json([
            // "diagnosis: " => new DiagnosisResource($diagnosis),
            "therapy: " => new TherapyResource($therapy)]);
    }

    public function store(Request $request, $diagnosis_id)
    {
        $validator = Validator::make($request->all(), [
            'type_of_therapy' => 'required|string|max:100',
            'name_of_therapy' => 'required|string|max:100',
            'description' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $therapy = Therapy::create([
            // 'diagnosis_id' => $request->path()[14],
            'diagnosis_id' => $diagnosis_id,
            'type_of_therapy' => $request->type_of_therapy,
            'name_of_therapy' => $request->name_of_therapy,
            'description' => $request->description
        ]);

        return response()->json([
            'Therapy created successfully.',
            new TherapyResource($therapy)
        ]);
    }

    public function update(Request $request, Diagnosis $diagnosis, Therapy $therapy)
    {
        $validator = Validator::make($request->all(), [
            'type_of_therapy' => 'required|string|max:100',
            'name_of_therapy' => 'required|string|max:100',
            'description' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $therapy->type_of_therapy = $request->type_of_therapy;
        $therapy->name_of_therapy = $request->name_of_therapy;
        $therapy->description = $request->description;

        $therapy->save();

        return response()->json([
            'Therapy updated successfully.',
            new TherapyResource($therapy)
        ]);
    }


    public function destroy(Diagnosis $diagnosis, Therapy $therapy)
    {
        $therapy->delete();
        return response()->json([
            'Therapy deleted successfully.'
        ]);
    }
}
