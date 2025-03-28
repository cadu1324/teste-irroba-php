<?php

namespace App\Http\Controllers;

use App\Models\Scheduling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Importe a classe Log

class SchedulingController extends Controller
{
    public function index()
    {
        try {
            $doctor = Auth::user();
            $schedulings = Scheduling::where('doctor_id', $doctor->id)->with(['patient', 'doctor'])->get();

            return response()->json($schedulings);
        } catch (\Exception $e) {
            Log::error('Erro ao listar agendamentos: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno ao listar agendamentos'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            Log::error('Erro ao criar agendamento: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno ao criar agendamento'], 500);
        }
    }

    public function show($id)
    {
        try {
            $scheduling = Scheduling::with(['patient', 'doctor'])->find($id);

            if (!$scheduling) {
                return response()->json(['message' => 'Agendamento não encontrado'], 404);
            }

            return response()->json($scheduling);
        } catch (\Exception $e) {
            Log::error('Erro ao exibir agendamento: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno ao exibir agendamento'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $scheduling = Scheduling::find($id);

            if (!$scheduling) {
                return response()->json(['message' => 'Agendamento não encontrado'], 404);
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
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar agendamento: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno ao atualizar agendamento'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $scheduling = Scheduling::find($id);

            if (!$scheduling) {
                return response()->json(['message' => 'Agendamento não encontrado'], 404);
            }

            $scheduling->delete();
            return response()->json(['message' => 'Agendamento deletado com sucesso']);
        } catch (\Exception $e) {
            Log::error('Erro ao deletar agendamento: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno ao deletar agendamento'], 500);
        }
    }
}