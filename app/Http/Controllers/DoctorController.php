<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response; // Importando o Response

class DoctorController extends Controller
{
    public function index()
    {
        try {
            $doctors = Doctor::all();
            return response()->json($doctors);
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao listar médicos: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json([
                'error' => 'Erro interno ao listar médicos',
                'log' => $errorMessage
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // Usando a constante do Response
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'specialty' => 'required|string|max:255',
                'crm' => 'required|string|unique:doctors',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|unique:doctors',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY); // Usando a constante do Response
            }

            $doctor = Doctor::create($request->all());
            return response()->json($doctor, Response::HTTP_CREATED); // Usando a constante do Response
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao criar médico: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json([
                'error' => 'Erro interno ao criar médico',
                'log' => $errorMessage
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // Usando a constante do Response
        }
    }

    public function show($id)
    {
        try {
            $doctor = Doctor::find($id);

            if (!$doctor) {
                return response()->json(['message' => 'Médico não encontrado'], Response::HTTP_NOT_FOUND); // Usando a constante do Response
            }

            return response()->json($doctor);
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao exibir médico: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json([
                'error' => 'Erro interno ao exibir médico',
                'log' => $errorMessage
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // Usando a constante do Response
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $doctor = Doctor::find($id);

            if (!$doctor) {
                return response()->json(['message' => 'Médico não encontrado'], Response::HTTP_NOT_FOUND); // Usando a constante do Response
            }

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'specialty' => 'string|max:255',
                'crm' => 'string|unique:doctors,crm,' . $id,
                'phone' => 'string|max:20',
                'email' => 'email|unique:doctors,email,' . $id,
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY); // Usando a constante do Response
            }

            $doctor->update($request->all());
            return response()->json($doctor);
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao atualizar médico: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json([
                'error' => 'Erro interno ao atualizar médico',
                'log' => $errorMessage
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // Usando a constante do Response
        }
    }

    public function destroy($id)
    {
        try {
            $doctor = Doctor::find($id);

            if (!$doctor) {
                return response()->json(['message' => 'Médico não encontrado'], Response::HTTP_NOT_FOUND); // Usando a constante do Response
            }

            $doctor->delete();
            return response()->json(['message' => 'Médico deletado com sucesso']);
        } catch (\Exception $e) {
            $errorMessage = 'Erro ao deletar médico: ' . $e->getMessage();
            Log::error($errorMessage);
            return response()->json([
                'error' => 'Erro interno ao deletar médico',
                'log' => $errorMessage
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // Usando a constante do Response
        }
    }
}