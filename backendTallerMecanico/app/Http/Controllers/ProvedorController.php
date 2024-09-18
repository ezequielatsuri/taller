<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provedor;
use Illuminate\Support\Facades\Validator;

class ProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los provedores con relaciones
        $provedores = Provedor::with('persona')->get();
        return response()->json($provedores, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'persona_id' => 'required|integer|exists:personas,persona_id',
            'contacto' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear un nuevo proveedor
        $provedor = Provedor::create($request->only([
            'persona_id',
            'contacto',
            'razon_social',
        ]));

        // Cargar la relación
        $provedor->load('persona');

        return response()->json($provedor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar un proveedor por ID con la relación
        $provedor = Provedor::with('persona')->find($id);

        if (!$provedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        return response()->json($provedor, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'persona_id' => 'sometimes|integer|exists:personas,persona_id',
            'contacto' => 'sometimes|string|max:255',
            'razon_social' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar el proveedor por ID
        $provedor = Provedor::find($id);

        if (!$provedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        // Actualizar los datos del proveedor
        $provedor->update($request->only([
            'persona_id',
            'contacto',
            'razon_social',
        ]));

        // Cargar la relación
        $provedor->load('persona');

        return response()->json($provedor, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el proveedor por ID
        $provedor = Provedor::find($id);

        if (!$provedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        // Eliminar el proveedor
        $provedor->delete();

        return response()->json(['message' => 'Proveedor eliminado exitosamente'], 200);
    }
}
