<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function getAppointments(){
        $appointments = Appointment::with(['patient', 'doctor'])->get();

        return response()->json($appointments);
    }

    public function addAppointment(){
        $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required', 'date_format:H:i'],
        ]);
        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'scheduled',
        ]);
        return response()->json(['message' => 'Appointment created successfully!', 'appointment' => $appointment]);
    }

    public function editAppointment(Request $request, $id){
        $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required', 'date_format:H:i'],
        ]);
        $appointment = Appointment::find($id);
        if(!$appointment){
            return response()->json(['message' => 'Appointment not found!'], 404);
        }
        $appointment->update([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);
        return response()->json(['message' => 'Appointment updated successfully!', 'appointment' => $appointment]);
    }

    public function deleteAppointment($id){
        $appointment = Appointment::find($id);
        if(!$appointment){
            return response()->json(['message' => 'Appointment not found!'], 404);
        }
        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully!']);
    }

}
