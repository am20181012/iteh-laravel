<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientCollection;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        // return new PatientCollection($patients);
        return response()->json([
            new PatientCollection($patients)
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
            'card_num' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'gender' => 'required',
            'adress' => 'required|string|max:60',
            'email' => 'required|string|email|max:255',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $patient = Patient::create([
            'card_num' => $request->card_num,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'adress' => $request->adress,
            'email' => $request->email,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'Patient created successfully.',
            new PatientResource($patient)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return response()->json([
            new PatientResource($patient)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'card_num' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'gender' => 'required',
            'adress' => 'required|string|max:60',
            'email' => 'required|string|email|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $patient->card_num = $request->card_num;
        $patient->name = $request->name;
        $patient->date_of_birth = $request->date_of_birth;
        $patient->gender = $request->gender;
        $patient->adress = $request->adress;
        $patient->email = $request->email;

        $patient->save();

        return response()->json([
            'Patient updated successfully.',
            new PatientResource($patient)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Patient $patient)
    // {
    //     //
    // }

    public function destroy($patient_id)
    {
        $patient = Patient::find($patient_id);
        $patient->delete();
        return response()->json([
            'Patient deleted successfully.'
        ]);
    }
}
