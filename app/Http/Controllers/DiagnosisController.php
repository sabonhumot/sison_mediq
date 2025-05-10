<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function getDiagnosis()
    {
        $diagnosis = Diagnosis::with(['patient', 'doctor'])->get();

        return response()->json($diagnosis);
    }

    public function addDiagnosis(){
        $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'appointment_id' => ['required', 'exists:appointments,id'],
            'diagnosis_date' => ['required', 'date'],
            'diagnosis_time' => ['required', 'date_format:H:i'],
            'diagnosis_description' => ['required', 'string'],
        ]);

        $diagnosis = Diagnosis::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_id' => $request->appointment_id,
            'diagnosis_date' => $request->diagnosis_date,
            'diagnosis_time' => $request->diagnosis_time,
            'diagnosis_description' => $request->diagnosis_description,
        ]);

        return response()->json(['message' => 'Diagnosis created successfully!', 'diagnosis' => $diagnosis]);
    }

    public function editDiagnosis(Request $request, $id){
        $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'appointment_id' => ['required', 'exists:appointments,id'],
            'diagnosis_date' => ['required', 'date'],
            'diagnosis_time' => ['required', 'date_format:H:i'],
            'diagnosis_description' => ['required', 'string'],
        ]);

        $diagnosis = Diagnosis::find($id);

        if(!$diagnosis){
            return response()->json(['message' => 'Diagnosis not found!'], 404);
        }

        $diagnosis->update([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_id' => $request->appointment_id,
            'diagnosis_date' => $request->diagnosis_date,
            'diagnosis_time' => $request->diagnosis_time,
            'diagnosis_description' => $request->diagnosis_description,
        ]);

        return response()->json(['message' => 'Diagnosis updated successfully!', 'diagnosis' => $diagnosis]);
    }
    public function deleteDiagnosis($id){
        $diagnosis = Diagnosis::find($id);

        if(!$diagnosis){
            return response()->json(['message' => 'Diagnosis not found!'], 404);
        }

        $diagnosis->delete();

        return response()->json(['message' => 'Diagnosis deleted successfully!']);
    }
}
