<?php

namespace App\Http\Controllers;

use App\Models\Scheduling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SchedulingController extends Controller
{
    public function index()
    {
        $doctor = Auth::user();
        $schedulings = Scheduling::where('doctor_id', $doctor->id)->with(['patient', 'doctor'])->get();

        return response()->json($schedulings);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_time' => 'required|date',
            'status' => 'nullable|in:scheduled,performed,canceled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $scheduling = Scheduling::create($request->all());
        return response()->json($scheduling, 201);
    }

    public function show($id)
    {
        $scheduling = Scheduling::with(['patient', 'doctor'])->find($id);

        if (!$scheduling) {
            return response()->json(['message' => 'Scheduling not found'], 404);
        }

        return response()->json($scheduling);
    }

    public function update(Request $request, $id)
    {
        $scheduling = Scheduling::find($id);

        if (!$scheduling) {
            return response()->json(['message' => 'Scheduling not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'patient_id' => 'exists:patients,id',
            'doctor_id' => 'exists:doctors,id',
            'appointment_time' => 'date',
            'status' => 'in:scheduled,performed,canceled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $scheduling->update($request->all());
        return response()->json($scheduling);
    }

    public function destroy($id)
    {
        $scheduling = Scheduling::find($id);

        if (!$scheduling) {
            return response()->json(['message' => 'Scheduling not found'], 404);
        }

        $scheduling->delete();
        return response()->json(['message' => 'Scheduling deleted successfully']);
    }
}