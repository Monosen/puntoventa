<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Venta;
use Illuminate\Http\Request;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::paginate(10); // Cambia el número 10 según tus necesidades de paginación
        return view('venta.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Persona::all();
        return view('venta.create',  compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_cliente' => 'required|integer',
            'tipo_comprobante' => 'required|string|max:20',
            'num_comprobante' => 'required|string|max:10',
            'fecha_hora' => 'required|date',
            'impuesto' => 'required|numeric',
            'total_venta' => 'required|numeric',
        ]);

        // Crear una nueva instancia de Venta con los datos del formulario
        $venta = new Venta();
        $venta->id_cliente = $request->id_cliente;
        $venta->tipo_comprobante = $request->tipo_comprobante;
        $venta->num_comprobante = $request->num_comprobante;
        $venta->fecha_hora = $request->fecha_hora;
        $venta->impuesto = $request->impuesto;
        $venta->total_venta = $request->total_venta;
        $venta->estado = 'Activo';

        // Guardar la venta en la base de datos
        $venta->save();

        // Redirigir a la vista de detalles de la venta recién creada

        return redirect()->route('venta.index')->with('success', 'Venta registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar la venta por su ID
        $venta = Venta::findOrFail($id);

        // Obtener todos los clientes para el dropdown
        $clientes = Persona::all();

        // Devolver la vista de edición con la venta y los clientes
        return view('venta.edit', compact('venta', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_cliente' => 'required|integer',
            'tipo_comprobante' => 'required|string|max:20',
            'num_comprobante' => 'required|string|max:10',
            'fecha_hora' => 'required|date',
            'impuesto' => 'required|numeric',
            'total_venta' => 'required|numeric',
        ]);

        // Buscar la venta por su ID
        $venta = Venta::findOrFail($id);

        // Actualizar los datos de la venta con los datos del formulario
        $venta->id_cliente = $request->id_cliente;
        $venta->tipo_comprobante = $request->tipo_comprobante;
        $venta->num_comprobante = $request->num_comprobante;
        $venta->fecha_hora = $request->fecha_hora;
        $venta->impuesto = $request->impuesto;
        $venta->total_venta = $request->total_venta;
        $venta->estado = 'Activo';

        // Guardar los cambios en la base de datos
        $venta->save();

        // Redirigir a la vista de detalles de la venta actualizada con un mensaje de éxito
        return redirect()->route('venta.index')->with('success', 'La venta se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar la venta por su ID
        $venta = Venta::findOrFail($id);

        // Cambiar el estado de la venta a "Inactivo"
        $venta->estado = 'Inactivo';

        // Guardar los cambios en la base de datos
        $venta->save();

        // Redirigir a la vista de listado de ventas con un mensaje de éxito
        return redirect()->route('venta.index')->with('success', 'La venta se ha desactivado correctamente.');
    }
}
