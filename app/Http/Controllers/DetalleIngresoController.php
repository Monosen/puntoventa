<?php

namespace App\Http\Controllers;

use App\Models\DetalleIngreso;
use App\Models\Ingreso;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los detalles de ingreso
        $detallesIngreso = DetalleIngreso::paginate(10); // Puedes ajustar el número de elementos por página según tus necesidades

        // Retornar la vista con los detalles de ingreso
        return view('detalle-ingreso.index', compact('detallesIngreso'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los ingresos y productos para el dropdown
        $ingresos = Ingreso::all();
        $productos = Producto::all();

        // Retornar la vista de creación de detalle de ingreso con los ingresos y productos
        return view('detalle-ingreso.create', compact('ingresos', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_ingreso' => 'required|exists:ingreso,id_ingreso',
            'id_producto' => 'required|exists:producto,id_producto',
            'cantidad' => 'required|numeric|min:1',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
        ]);

        // Crear un nuevo objeto DetalleIngreso con los datos del formulario
        $detalleIngreso = new DetalleIngreso();
        $detalleIngreso->id_ingreso = $request->id_ingreso;
        $detalleIngreso->id_producto = $request->id_producto;
        $detalleIngreso->cantidad = $request->cantidad;
        $detalleIngreso->precio_compra = $request->precio_compra;
        $detalleIngreso->precio_venta = $request->precio_venta;

        // Guardar el detalle de ingreso en la base de datos
        $detalleIngreso->save();

        // Redireccionar a la página de índice de detalle de ingreso con un mensaje de éxito
        return redirect()->route('detalle-ingreso.index')->with('success', 'Detalle de ingreso creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetalleIngreso $detalleIngreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleIngreso $detalleIngreso)
    {
        $ingresos = Ingreso::all();
        $productos = Producto::all();
        return view('detalle-ingreso.edit', compact('detalleIngreso', 'ingresos', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleIngreso $detalleIngreso)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_ingreso' => 'required|exists:ingreso,id_ingreso',
            'id_producto' => 'required|exists:producto,id_producto',
            'cantidad' => 'required|integer',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
        ]);

        // Actualizar el detalle de ingreso con los datos del formulario
        $detalleIngreso->update($request->all());

        // Redirigir a la vista de detalles de ingreso con un mensaje de éxito
        return redirect()->route('detalle-ingreso.index')->with('success', 'Detalle de ingreso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetalleIngreso $detalleIngreso)
    {
        // Eliminar el detalle de ingreso de la base de datos
        $detalleIngreso->delete();

        // Redirigir a la vista de detalles de ingreso con un mensaje de éxito
        return redirect()->route('detalle-ingreso.index')->with('success', 'Detalle de ingreso eliminado correctamente');
    }
}
