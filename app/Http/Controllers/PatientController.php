<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|unique:pacientes',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:pacientes',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $patient = Patient::create($request->all());
        return response()->json($patient, 201);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        return response()->json($patient);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'cpf' => 'string|unique:pacientes,cpf,' . $id,
            'phone' => 'string|max:20',
            'email' => 'email|unique:pacientes,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $patient->update($request->all());
        return response()->json($patient);
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully']);
    }
}