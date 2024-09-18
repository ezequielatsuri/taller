<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagoCliente;
use Illuminate\Support\Facades\Validator;

class PagoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los pagos de clientes con las relaciones
        $pagoClientes = PagoCliente::with(['venta', 'cliente', 'pago'])->get();
        return response()->json($pagoClientes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'venta_id' => 'required|integer|exists:ventas,venta_id',
            'cliente_id' => 'required|integer|exists:clientes,cliente_id',
            'pago_id' => 'required|integer|exists:pagos,pago_id',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear un nuevo pago de cliente
        $pagoCliente = PagoCliente::create($request->only('venta_id', 'cliente_id', 'pago_id', 'observaciones'));

        return response()->json($pagoCliente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar un pago de cliente por ID con las relaciones
        $pagoCliente = PagoCliente::with(['venta', 'cliente', 'pago'])->find($id);

        if (!$pagoCliente) {
            return response()->json(['message' => 'PagoCliente no encontrado'], 404);
        }

        return response()->json($pagoCliente, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'venta_id' => 'sometimes|integer|exists:ventas,venta_id',
            'cliente_id' => 'sometimes|integer|exists:clientes,cliente_id',
            'pago_id' => 'sometimes|integer|exists:pagos,pago_id',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar el pago de cliente por ID
        $pagoCliente = PagoCliente::find($id);

        if (!$pagoCliente) {
            return response()->json(['message' => 'PagoCliente no encontrado'], 404);
        }

        // Actualizar los datos del pago de cliente
        $pagoCliente->update($request->only('venta_id', 'cliente_id', 'pago_id', 'observaciones'));

        return response()->json($pagoCliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el pago de cliente por ID
        $pagoCliente = PagoCliente::find($id);

        if (!$pagoCliente) {
            return response()->json(['message' => 'PagoCliente no encontrado'], 404);
        }

        // Eliminar el pago de cliente
        $pagoCliente->delete();

        return response()->json(['message' => 'PagoCliente eliminado exitosamente'], 200);
    }
}
