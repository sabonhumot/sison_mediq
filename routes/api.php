<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthenticationController,
    UserController,
    AppointmentController,
    PatientController,
    DoctorController,
    DiagnosisController
};
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);
   
    
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    Route::get('/get-appointments', [AppointmentController::class, 'getAppointments']);
    Route::post('/add-appointment', [AppointmentController::class, 'addAppointment']);
    Route::put('/edit-appointment/{id}', [AppointmentController::class, 'editAppointment']);
    Route::delete('/delete-appointment/{id}', [AppointmentController::class, 'deleteAppointment']);

    Route::get('/get-patients', [PatientController::class, 'getPatients']);
    Route::post('/add-patient', [PatientController::class, 'addPatient']);
    Route::put('/edit-patient/{id}', [PatientController::class, 'editPatient']);
    Route::delete('/delete-patient/{id}', [PatientController::class, 'deletePatient']);

    Route::get('/get-doctors', [DoctorController::class, 'getDoctors']);
    Route::post('/add-doctor', [DoctorController::class, 'addDoctor']);
    Route::put('/edit-doctor/{id}', [DoctorController::class, 'editDoctor']);
    Route::delete('/delete-doctor/{id}', [DoctorController::class, 'deleteDoctor']);
    
    Route::get('/get-diagnosis', [DiagnosisController::class, 'getDiagnosis']);
    Route::post('/add-diagnosis', [DiagnosisController::class, 'addDiagnosis']);
    Route::put('/edit-diagnosis/{id}', [DiagnosisController::class, 'editDiagnosis']);
    Route::delete('/delete-diagnosis/{id}', [DiagnosisController::class, 'deleteDiagnosis']);
});
