<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las ventas con sus relaciones
        $ventas = Venta::with(['cliente', 'vehiculo', 'ventaProductos', 'ventaServicios', 'pagosClientes'])->get();
        return response()->json($ventas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|integer|exists:clientes,cliente_id',
            'vehiculo_id' => 'required|integer|exists:vehiculos,vehiculo_id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear una nueva venta
        $venta = Venta::create($request->only([
            'cliente_id',
            'vehiculo_id',
            'fecha',
            'total',
            'observaciones',
        ]));

        // Cargar las relaciones (si es necesario)
        $venta->load(['cliente', 'vehiculo', 'ventaProductos', 'ventaServicios', 'pagosClientes']);

        return response()->json($venta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // Buscar una venta por ID con sus relaciones
        $venta = Venta::with(['cliente', 'vehiculo', 'ventaProductos', 'ventaServicios', 'pagosClientes'])->find($id);

        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }

        return response()->json($venta, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'sometimes|integer|exists:clientes,cliente_id',
            'vehiculo_id' => 'sometimes|integer|exists:vehiculos,vehiculo_id',
            'fecha' => 'sometimes|date',
            'total' => 'sometimes|numeric|min:0',
            'observaciones' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar la venta por ID
        $venta = Venta::find($id);

        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }

        // Actualizar los datos de la venta
        $venta->update($request->only([
            'cliente_id',
            'vehiculo_id',
            'fecha',
            'total',
            'observaciones',
        ]));

        // Cargar las relaciones (si es necesario)
        $venta->load(['cliente', 'vehiculo', 'ventaProductos', 'ventaServicios', 'pagosClientes']);

        return response()->json($venta, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // Buscar la venta por ID
        $venta = Venta::find($id);

        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }

        // Eliminar la venta
        $venta->delete();

        return response()->json(['message' => 'Venta eliminada exitosamente'], 200);
    }
}
