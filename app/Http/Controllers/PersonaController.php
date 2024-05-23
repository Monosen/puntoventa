<?php

namespace App\Http\Controllers;


use App\Models\Persona;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::paginate(10); // Obtener todas las personas paginadas

        return view('compras.persona.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('compras.persona.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo_persona' => 'required|string|max:20',
            'nombre' => 'required|string|max:100',
            'tipo_documento' => 'required|string|max:20',
            'num_documento' => 'required|string|max:15',
            'direccion' => 'nullable|string|max:70',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:50',
        ]);

        // Crear una nueva instancia de Persona con los datos del formulario
        Persona::create([
            'tipo_persona' => $request->tipo_persona,
            'nombre' => $request->nombre,
            'tipo_documento' => $request->tipo_documento,
            'num_documento' => $request->num_documento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
        ]);

        // Redireccionar al usuario a la página de index de personas con un mensaje de éxito
        return redirect()->route('persona.index')->with('success', 'Persona creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        //
        return view("producto.show",["producto"=>Producto::findOrFail($persona)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        return view('compras.persona.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        // Validación de los campos del formulario
        $request->validate([
            'tipo_persona' => 'required',
            'nombre' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
        ]);

        // Actualización de los datos de la persona
        $persona->update($request->all());

        // Redireccionar a la página de listado de personas con un mensaje de éxito
        return redirect()->route('persona.index')->with('success', 'Persona actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        $persona->delete(); // Eliminar la persona

        return redirect()->route('persona.index')->with('success', 'Persona eliminada correctamente'); // Redirigir al índice de personas con un mensaje de éxito
    }
}
