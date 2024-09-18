<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fabricante;
use Illuminate\Support\Facades\Validator;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los fabricantes con sus productos relacionados
        $fabricantes = Fabricante::with('productos')->get();
        return response()->json($fabricantes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear un nuevo fabricante
        $fabricante = Fabricante::create($request->only('nombre', 'descripcion'));

        return response()->json($fabricante, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar un fabricante por ID con sus productos
        $fabricante = Fabricante::with('productos')->find($id);

        if (!$fabricante) {
            return response()->json(['message' => 'Fabricante no encontrado'], 404);
        }

        return response()->json($fabricante, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar el fabricante por ID
        $fabricante = Fabricante::find($id);

        if (!$fabricante) {
            return response()->json(['message' => 'Fabricante no encontrado'], 404);
        }

        // Actualizar los datos del fabricante
        $fabricante->update($request->only('nombre', 'descripcion'));

        return response()->json($fabricante, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el fabricante por ID
        $fabricante = Fabricante::find($id);

        if (!$fabricante) {
            return response()->json(['message' => 'Fabricante no encontrado'], 404);
        }

        // Eliminar el fabricante
        $fabricante->delete();

        return response()->json(['message' => 'Fabricante eliminado exitosamente'], 200);
    }
}
