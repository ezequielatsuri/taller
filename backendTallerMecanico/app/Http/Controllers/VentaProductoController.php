<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VentaProducto;
use Illuminate\Support\Facades\Validator;

class VentaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de venta_producto con sus relaciones
        $ventaProductos = VentaProducto::with(['venta', 'producto'])->get();
        return response()->json($ventaProductos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'venta_id' => 'required|integer|exists:ventas,venta_id',
            'producto_id' => 'required|integer|exists:productos,producto_id',
            'cantidad' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear un nuevo registro de venta_producto
        $ventaProducto = VentaProducto::create($request->only([
            'venta_id',
            'producto_id',
            'cantidad',
        ]));

        // Cargar las relaciones (si es necesario)
        $ventaProducto->load(['venta', 'producto']);

        return response()->json($ventaProducto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // Buscar un registro de venta_producto por ID con sus relaciones
        $ventaProducto = VentaProducto::with(['venta', 'producto'])->find($id);

        if (!$ventaProducto) {
            return response()->json(['message' => 'VentaProducto no encontrado'], 404);
        }

        return response()->json($ventaProducto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'venta_id' => 'sometimes|integer|exists:ventas,venta_id',
            'producto_id' => 'sometimes|integer|exists:productos,producto_id',
            'cantidad' => 'sometimes|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar el registro de venta_producto por ID
        $ventaProducto = VentaProducto::find($id);

        if (!$ventaProducto) {
            return response()->json(['message' => 'VentaProducto no encontrado'], 404);
        }

        // Actualizar los datos del registro de venta_producto
        $ventaProducto->update($request->only([
            'venta_id',
            'producto_id',
            'cantidad',
        ]));

        // Cargar las relaciones (si es necesario)
        $ventaProducto->load(['venta', 'producto']);

        return response()->json($ventaProducto, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // Buscar el registro de venta_producto por ID
        $ventaProducto = VentaProducto::find($id);

        if (!$ventaProducto) {
            return response()->json(['message' => 'VentaProducto no encontrado'], 404);
        }

        // Eliminar el registro de venta_producto
        $ventaProducto->delete();

        return response()->json(['message' => 'VentaProducto eliminado exitosamente'], 200);
    }
}
