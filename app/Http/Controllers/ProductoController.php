<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $productos = DB::table('producto as p')
            ->join('categoria as c', 'p.id_categoria', '=', 'c.id_categoria')
            ->select('p.id_producto', 'p.codigo', 'p.nombre', 'p.existencia', 'p.descripcion', 'p.imagen', 'p.estado')
            ->where(function ($query) use ($texto) {
                $query->where('p.nombre', 'LIKE', '%' . $texto . '%')
                    ->orWhere('p.codigo', 'LIKE', '%' . $texto . '%');
            })
            ->where('p.estado', '=', 'Activo') // Filtrar por estado activo
            ->orderBy('id_producto', 'desc')
            ->paginate(10);

        return view('almacen.producto.index', compact('productos', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        return view("almacen.producto.create", compact( 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_categoria' => 'required|exists:categoria,id_categoria',
            'codigo' => 'required|unique:producto',
            'nombre' => 'required',
            'descripcion' => 'required',
            'existencia' => 'required|numeric',
            'imagen' => 'required',
        ]);

        // Crear un nuevo objeto Producto con los datos del formulario
        $producto = new Producto();
        $producto->id_categoria = $request->id_categoria;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->existencia = $request->existencia;
        $producto->imagen = $request->imagen;
        $producto->estado = 'Activo';

        // Guardar el producto en la base de datos
        $producto->save();

        // Redireccionar a la página de índice de productos con un mensaje de éxito
        return Redirect::to('almacen/producto');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view("almacen.producto.show",["producto"=>Producto::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); // Suponiendo que tienes un modelo Categoria para obtener todas las categorías
        return view('almacen.producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_categoria' => 'required|exists:categoria,id_categoria',
            'codigo' => 'required|string|max:50',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:512',
            'existencia' => 'required|integer',
            'imagen' => 'nullable|string|max:50',
        ]);

        // Obtener el producto a actualizar
        $producto = Producto::findOrFail($id);

        // Actualizar los datos del producto
        $producto->id_categoria = $request->id_categoria;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->existencia = $request->existencia;
        $producto->imagen = $request->imagen;
        $producto->estado = 'Activo';

        // Guardar los cambios en la base de datos
        $producto->save();

        // Redirigir al usuario a la página de detalles del producto actualizado
        return Redirect::to('almacen/producto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);

        // Actualizar el estado del producto a "Inactivo"
        $producto->estado = 'Inactivo';

        // Guardar los cambios en la base de datos
        $producto->save();

        // Redirigir al usuario a la página de listado de productos
        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente');
    }
}
