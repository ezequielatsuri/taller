<?php

namespace App\Http\Controllers;

use App\Models\Pago; // Importar el modelo Pago
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los pagos
        $pagos = Pago::all();
        return response()->json($pagos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'num_comprobante' => 'required|string|max:255',
            'cantidad_pago' => 'required|integer',
            'descuento' => 'nullable|string|max:255',
            'fecha' => 'required|date',
            'observaciones' => 'nullable|string|max:255',
        ]);

        // Crear un nuevo pago
        $pago = Pago::create([
            'num_comprobante' => $validated['num_comprobante'],
            'cantidad_pago' => $validated['cantidad_pago'],
            'descuento' => $validated['descuento'] ?? null,
            'fecha' => $validated['fecha'],
            'observaciones' => $validated['observaciones'] ?? null,
        ]);

        return response()->json($pago, 201); // Respuesta con código 201 (creado)
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // Buscar un pago por su ID
        $pago = Pago::find($id);

        if (!$pago) {
            return response()->json(['message' => 'Pago no encontrado'], 404);
        }

        return response()->json($pago);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'num_comprobante' => 'required|string|max:255',
            'cantidad_pago' => 'required|integer',
            'descuento' => 'nullable|string|max:255',
            'fecha' => 'required|date',
            'observaciones' => 'nullable|string|max:255',
        ]);

        // Buscar el pago que se va a actualizar
        $pago = Pago::find($id);

        if (!$pago) {
            return response()->json(['message' => 'Pago no encontrado'], 404);
        }

        // Actualizar los datos del pago
        $pago->update([
            'num_comprobante' => $validated['num_comprobante'],
            'cantidad_pago' => $validated['cantidad_pago'],
            'descuento' => $validated['descuento'] ?? null,
            'fecha' => $validated['fecha'],
            'observaciones' => $validated['observaciones'] ?? null,
        ]);

        return response()->json($pago);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // Buscar el pago que se va a eliminar
        $pago = Pago::find($id);

        if (!$pago) {
            return response()->json(['message' => 'Pago no encontrado'], 404);
        }

        // Eliminar el pago
        $pago->delete();

        return response()->json(['message' => 'Pago eliminado con éxito']);
    }
}
