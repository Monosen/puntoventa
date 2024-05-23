<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalles_venta = DetalleVenta::paginate(10); // Obtener todos los detalles de venta paginados

        return view('detalle-venta.index', compact('detalles_venta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ventas = Venta::all();
        $productos = Producto::all();
        return view('detalle-venta.create', compact('ventas', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_venta' => 'required|exists:venta,id_venta',
            'id_producto' => 'required|exists:producto,id_producto',
            'cantidad' => 'required',
            'precio_venta' => 'required',
            'descuento' => 'required',
        ]);

        // Crear una nueva instancia de DetalleVenta con los datos del formulario
        DetalleVenta::create([
            'id_venta' => $request->id_venta,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'precio_venta' => $request->precio_venta,
            'descuento' => $request->descuento,
        ]);

        // Redireccionar al usuario a la página de index de detalles de venta con un mensaje de éxito
        return redirect()->route('detalle-venta.index')->with('success', 'Detalle de venta creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        $ventas = Venta::all();
        $productos = Producto::all();
        return view('detalle-venta.edit', compact('detalleVenta', 'ventas', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleVenta $detalleVenta)
    {
        // Validación de los campos del formulario
        $request->validate([
            'id_venta' => 'required|exists:venta,id_venta',
            'id_producto' => 'required|exists:producto,id_producto',
            'cantidad' => 'required',
            'precio_venta' => 'required',
            'descuento' => 'required',
        ]);

        // Actualización de los datos del detalle de venta
        $detalleVenta->update($request->all());

        // Redireccionar a la página de listado de detalles de venta con un mensaje de éxito
        return redirect()->route('detalle-venta.index')->with('success', 'Detalle de venta actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        $detalleVenta->delete();
        return Redirect::route('detalle-venta.index')->with('success', 'Detalle de venta eliminado correctamente.');

    }
}
