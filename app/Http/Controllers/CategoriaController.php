<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $categorias=DB::table('categoria')->where('categoria','LIKE','%'.$query.'%')
            ->where ('estado','=','1')
            ->orderBy('id_categoria','desc')
            ->paginate(7);
            return view('almacen.categoria.index',["categoria"=>$categorias,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("almacen.categoria.create", );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaFormRequest $request)
    {
        //
        $categoria=new Categoria;
        $categoria->categoria=$request->get('categoria');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->estado='1';
        $categoria->save();
        return Redirect::to('almacen/categoria');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaFormRequest $request, string $id)
    {
        //
        $categoria=Categoria::findOrFail($id);
        $categoria->categoria=$request->get('categoria');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categoria=Categoria::findOrFail($id);
        $categoria->estado='0';
        $categoria->update();
        /*return Redirect::to('almacen/categoria'); */

        return redirect()->route('categoria.index')->with('success', 'Categoria eliminada correctamente');
    }
}
