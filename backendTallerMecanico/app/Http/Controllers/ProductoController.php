<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos con relaciones
        $productos = Producto::with(['categoria', 'fabricante'])->get();
        return response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'required|integer|exists:categorias,categoria_id',
            'fabricante_id' => 'required|integer|exists:fabricantes,fabricante_id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'descuento' => 'nullable|numeric|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'producto_stock' => 'required|integer|min:0',
            'producto_stock_minimo' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear un nuevo producto
        $producto = Producto::create($request->only([
            'categoria_id',
            'fabricante_id',
            'nombre',
            'descripcion',
            'descuento',
            'precio_compra',
            'precio_venta',
            'producto_stock',
            'producto_stock_minimo',
        ]));

        // Cargar las relaciones
        $producto->load(['categoria', 'fabricante']);

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar un producto por ID con relaciones
        $producto = Producto::with(['categoria', 'fabricante'])->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'sometimes|integer|exists:categorias,categoria_id',
            'fabricante_id' => 'sometimes|integer|exists:fabricantes,fabricante_id',
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'descuento' => 'nullable|numeric|min:0',
            'precio_compra' => 'sometimes|numeric|min:0',
            'precio_venta' => 'sometimes|numeric|min:0',
            'producto_stock' => 'sometimes|integer|min:0',
            'producto_stock_minimo' => 'sometimes|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Buscar el producto por ID
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Actualizar los datos del producto
        $producto->update($request->only([
            'categoria_id',
            'fabricante_id',
            'nombre',
            'descripcion',
            'descuento',
            'precio_compra',
            'precio_venta',
            'producto_stock',
            'producto_stock_minimo',
        ]));

        // Cargar las relaciones
        $producto->load(['categoria', 'fabricante']);

        return response()->json($producto, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el producto por ID
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Eliminar el producto
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado exitosamente'], 200);
    }
}
