<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Importe a classe Log

class PatientController extends Controller
{
    public function index()
    {
        try {
            $patients = Patient::all();
            return response()->json($patients);
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao listar pacientes: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => 'Erro interno ao listar pacientes', 'log' => $errorMessage], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao criar paciente: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => 'Erro interno ao criar paciente', 'log' => $errorMessage], 500);
        }
    }

    public function show($id)
    {
        try {
            $patient = Patient::find($id);

            if (!$patient) {
                return response()->json(['message' => 'Paciente não encontrado'], 404);
            }

            return response()->json($patient);
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao exibir paciente: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => 'Erro interno ao exibir paciente', 'log' => $errorMessage], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $patient = Patient::find($id);

            if (!$patient) {
                return response()->json(['message' => 'Paciente não encontrado'], 404);
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
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao atualizar paciente: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => 'Erro interno ao atualizar paciente', 'log' => $errorMessage], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $patient = Patient::find($id);

            if (!$patient) {
                return response()->json(['message' => 'Paciente não encontrado'], 404);
            }

            $patient->delete();
            return response()->json(['message' => 'Paciente deletado com sucesso']);
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao deletar paciente: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => 'Erro interno ao deletar paciente', 'log' => $errorMessage], 500);
        }
    }
}