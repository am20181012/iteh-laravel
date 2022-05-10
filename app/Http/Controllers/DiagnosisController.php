<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiagnosisCollection;
use App\Http\Resources\DiagnosisResource;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnosis = Diagnosis::all();
        return response()->json([
            new DiagnosisCollection($diagnosis)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latin_name' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'cause' => 'required|string|max:60',
            'hospitalization' => 'required',
            'note' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $diagnosis = Diagnosis::create([
            'latin_name' => $request->latin_name,
            'date_of_diagnosis' => $request->date_of_diagnosis,
            'description' => $request->description,
            'cause' => $request->cause,
            'hospitalization' => $request->hospitalization,
            'note' => $request->note,
            'patient_id' => $request->patient_id,
            'user_id' => Auth::user()->id
        ]);

        return response()->json([
            'Diagnosis created successfully.',
            new DiagnosisResource($diagnosis)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosis $diagnosis)
    {
        return response()->json([
            new DiagnosisResource($diagnosis)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosis $diagnosis)
    {
        $validator = Validator::make($request->all(), [
            'latin_name' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'cause' => 'required|string|max:60',
            'hospitalization' => 'required',
            'note' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $diagnosis->latin_name = $request->latin_name;
        $diagnosis->date_of_diagnosis = $diagnosis->date_of_diagnosis;
        $diagnosis->description = $request->description;
        $diagnosis->cause = $request->cause ;
        $diagnosis->hospitalization = $request->hospitalization;
        $diagnosis->note = $request->note;

        $diagnosis->save();

        return response()->json([
            'Diagnosis updated successfully.',
            new DiagnosisResource($diagnosis)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosis $diagnosis)
    {
        //
    }
}
