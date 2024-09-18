<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los vehículos con sus relaciones
        $vehiculos = Vehiculo::with(['cliente', 'ventas'])->get();
        return response()->json($vehiculos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|integer|exists:clientes,cliente_id',
            'modelo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'año' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'placa' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'observaciones' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear un nuevo vehículo
        $vehiculo = Vehiculo::create($request->only([
            'cliente_id',
            'modelo',
            'marca',
            'año',
            'placa',
            'tipo',
            'observaciones',
        ]));

        // Cargar las relaciones (si es necesario)
        $vehiculo->load(['cliente', 'ventas']);

        return response()->json($vehiculo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar un vehículo por ID con sus relaciones
        $vehiculo = Vehiculo::with(['cliente', 'ventas'])->find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        return response()->json($vehiculo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'sometimes|integer|exists:clientes,cliente_id',
            'modelo' => 'sometimes|string|max:255',
            'marca' => 'sometimes|string|max:255',
            'año' => 'sometimes|integer|min:1900|max:' . (date('Y') + 1),
            'placa' => 'sometimes|string|max:255',
            'tipo' => 'sometimes|string|max:255',
            'observaciones' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar el vehículo por ID
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        // Actualizar los datos del vehículo
        $vehiculo->update($request->only([
            'cliente_id',
            'modelo',
            'marca',
            'año',
            'placa',
            'tipo',
            'observaciones',
        ]));

        // Cargar las relaciones (si es necesario)
        $vehiculo->load(['cliente', 'ventas']);

        return response()->json($vehiculo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el vehículo por ID
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        // Eliminar el vehículo
        $vehiculo->delete();

        return response()->json(['message' => 'Vehículo eliminado exitosamente'], 200);
    }
}
