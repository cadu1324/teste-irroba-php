<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'crm' => 'required|string|unique:medicos',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:medicos',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $doctor = Doctor::create($request->all());
        return response()->json($doctor, 201);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        return response()->json($doctor);
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'specialty' => 'string|max:255',
            'crm' => 'string|unique:medicos,crm,' . $id,
            'phone' => 'string|max:20',
            'email' => 'email|unique:medicos,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $doctor->update($request->all());
        return response()->json($doctor);
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted successfully']);
    }
}