<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagoProvedor;
use Illuminate\Support\Facades\Validator;

class PagoProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los pagos a proveedores con las relaciones
        $pagoProvedores = PagoProvedor::with(['proveedor', 'pago'])->get();
        return response()->json($pagoProvedores, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'provedor_id' => 'required|integer|exists:provedores,provedor_id',
            'pago_id' => 'required|integer|exists:pagos,pago_id',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear un nuevo pago a proveedor
        $pagoProvedor = PagoProvedor::create($request->only('provedor_id', 'pago_id', 'observaciones'));

        return response()->json($pagoProvedor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar un pago a proveedor por ID con las relaciones
        $pagoProvedor = PagoProvedor::with(['proveedor', 'pago'])->find($id);

        if (!$pagoProvedor) {
            return response()->json(['message' => 'PagoProvedor no encontrado'], 404);
        }

        return response()->json($pagoProvedor, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'provedor_id' => 'sometimes|integer|exists:provedores,provedor_id',
            'pago_id' => 'sometimes|integer|exists:pagos,pago_id',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar el pago a proveedor por ID
        $pagoProvedor = PagoProvedor::find($id);

        if (!$pagoProvedor) {
            return response()->json(['message' => 'PagoProvedor no encontrado'], 404);
        }

        // Actualizar los datos del pago a proveedor
        $pagoProvedor->update($request->only('provedor_id', 'pago_id', 'observaciones'));

        return response()->json($pagoProvedor, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el pago a proveedor por ID
        $pagoProvedor = PagoProvedor::find($id);

        if (!$pagoProvedor) {
            return response()->json(['message' => 'PagoProvedor no encontrado'], 404);
        }

        // Eliminar el pago a proveedor
        $pagoProvedor->delete();

        return response()->json(['message' => 'PagoProvedor eliminado exitosamente'], 200);
    }
}
