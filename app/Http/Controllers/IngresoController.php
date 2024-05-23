<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Persona;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos = Ingreso::where('estado', 'activo')->paginate(10);
        return view('compras.ingreso.index', compact('ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Persona::all();
        return view('compras.ingreso.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'tipo_comprobante' => 'required',
            'num_comprobante' => 'required',
            'fecha_hora' => 'required',
            'impuesto' => 'required',
        ]);

        // Crea un nuevo ingreso con los datos recibidos del formulario
        Ingreso::create([
            'id_proveedor' => $request->id_proveedor,
            'tipo_comprobante' => $request->tipo_comprobante,
            'num_comprobante' => $request->num_comprobante,
            'fecha_hora' => $request->fecha_hora,
            'impuesto' => $request->impuesto,
            'estado' => 'Activo',
        ]);

        // Redirige a la página de índice de ingresos con un mensaje de éxito
        return redirect()->route('ingreso.index')->with('success', 'Ingreso creado correctamente.');
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
        $ingreso = Ingreso::findOrFail($id);
        $proveedores = Persona::all();

        // Aquí puedes pasar los datos necesarios a la vista de edición
        return view('compras.ingreso.edit', compact('ingreso', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'tipo_comprobante' => 'required',
            'num_comprobante' => 'required',
            'fecha_hora' => 'required',
            'impuesto' => 'required',
        ]);

        // Encuentra el ingreso por su ID
        $ingreso = Ingreso::findOrFail($id);

        // Actualiza los campos del ingreso con los datos del formulario
        $ingreso->update([
            'tipo_comprobante' => $request->tipo_comprobante,
            'num_comprobante' => $request->num_comprobante,
            'fecha_hora' => $request->fecha_hora,
            'impuesto' => $request->impuesto,
            // Agrega aquí los demás campos que necesites actualizar
        ]);

        // Redirecciona a la ruta deseada después de actualizar el ingreso
        return redirect()->route('ingreso.index')->with('success', 'Ingreso actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el producto por su ID
        $ingreso = Ingreso::findOrFail($id);

        // Actualizar el estado del producto a "Inactivo"
        $ingreso->estado = 'Inactivo';

        // Guardar los cambios en la base de datos
        $ingreso->save();

        // Redirigir al usuario a la página de listado de productos
        return redirect()->route('ingreso.index')->with('success', 'Ingreso eliminado correctamente');
    }
}
