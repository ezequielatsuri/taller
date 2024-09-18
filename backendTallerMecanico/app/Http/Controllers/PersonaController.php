<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Validator;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las personas
        $personas = Persona::all();
        return response()->json($personas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido_pat' => 'required|string|max:255',
            'apellido_mat' => 'nullable|string|max:255',
            'correo' => 'required|email|max:255|unique:personas,correo',
            'sexo' => 'required|string|max:1',
            'telefono' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear una nueva persona
        $persona = Persona::create($request->only([
            'nombre',
            'apellido_pat',
            'apellido_mat',
            'correo',
            'sexo',
            'telefono',
        ]));

        return response()->json($persona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar una persona por ID
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        return response()->json($persona, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            'apellido_pat' => 'sometimes|string|max:255',
            'apellido_mat' => 'sometimes|string|max:255',
            'correo' => 'sometimes|email|max:255|unique:personas,correo,' . $id . ',persona_id',
            'sexo' => 'sometimes|string|max:1',
            'telefono' => 'sometimes|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar la persona por ID
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        // Actualizar los datos de la persona
        $persona->update($request->only([
            'nombre',
            'apellido_pat',
            'apellido_mat',
            'correo',
            'sexo',
            'telefono',
        ]));

        return response()->json($persona, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar la persona por ID
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        // Eliminar la persona
        $persona->delete();

        return response()->json(['message' => 'Persona eliminada exitosamente'], 200);
    }
}
