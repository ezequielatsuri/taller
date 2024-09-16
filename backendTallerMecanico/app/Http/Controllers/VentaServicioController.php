<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VentaServicio;
use Illuminate\Support\Facades\Validator;

class VentaServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de venta_servicio con sus relaciones
        $ventaServicios = VentaServicio::with(['venta', 'tarea'])->get();
        return response()->json($ventaServicios, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'venta_id' => 'required|integer|exists:ventas,venta_id',
            'tarea_id' => 'required|integer|exists:tareas,tarea_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear un nuevo registro de venta_servicio
        $ventaServicio = VentaServicio::create($request->only([
            'venta_id',
            'tarea_id',
        ]));

        // Cargar las relaciones (si es necesario)
        $ventaServicio->load(['venta', 'tarea']);

        return response()->json($ventaServicio, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // Buscar un registro de venta_servicio por ID con sus relaciones
        $ventaServicio = VentaServicio::with(['venta', 'tarea'])->find($id);

        if (!$ventaServicio) {
            return response()->json(['message' => 'VentaServicio no encontrado'], 404);
        }

        return response()->json($ventaServicio, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'venta_id' => 'sometimes|integer|exists:ventas,venta_id',
            'tarea_id' => 'sometimes|integer|exists:tareas,tarea_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar el registro de venta_servicio por ID
        $ventaServicio = VentaServicio::find($id);

        if (!$ventaServicio) {
            return response()->json(['message' => 'VentaServicio no encontrado'], 404);
        }

        // Actualizar los datos del registro de venta_servicio
        $ventaServicio->update($request->only([
            'venta_id',
            'tarea_id',
        ]));

        // Cargar las relaciones (si es necesario)
        $ventaServicio->load(['venta', 'tarea']);

        return response()->json($ventaServicio, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // Buscar el registro de venta_servicio por ID
        $ventaServicio = VentaServicio::find($id);

        if (!$ventaServicio) {
            return response()->json(['message' => 'VentaServicio no encontrado'], 404);
        }

        // Eliminar el registro de venta_servicio
        $ventaServicio->delete();

        return response()->json(['message' => 'VentaServicio eliminado exitosamente'], 200);
    }
}
