<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importar clases del modelo
use App\Genero;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listado de registros
        // $generos = Genero::all();                           // Obtener todos los registros
        // $generos = Genero::orderBy('id', 'DESC')->get();    // Obtener todos los registros ordenados
        $generos = Genero::orderBy('id', 'DESC')->paginate(10); // Obtener los registros ordenados y paginados
        // Enviar listado de registros a una vista
        $data['generos'] = $generos;
        return view('admin.genero.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Renderizar formulario para nuevo registro
        return view('admin.genero.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(Request $request)
    {
        // Guardar datos del formulario
        // 1. Obtener todos los datos del formulario
        $genero = new Genero($request->all());
        // 3. Guardar en la base de datos
        $genero->save();
        // 4. Mostrar mensaje
        //return 'Genero registrado correctamente';
        flash('Genero registrado correctamente')->success();
        // 5. Redireccionar a listado de Generos
        return redirect()->route('genero.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mostrar informacion detallada
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Renderizar formulario para editar
        $genero = Genero::find($id);
        // dd($genero);
        $data['genero'] = $genero;
        return view('admin.genero.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Registrar cambios en la base de datos
        // dd($request->all());
        // 1. Buscar registro a modificar
        $genero = Genero::find($id);
        // 2. Editar valores
        $genero->fill($request->all());
        // 3. Guardar cambios
        $genero->save();
        // 4. Preparar mensaje
        flash('Genero editado correctamente')->success();
        // 5. Redireccionar
        return redirect()->route('genero.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar un registro
        // 1. Buscar registro a eliminar
        $genero=Genero::find($id);
        if($genero){
            // 2. Eliminar registro
            $genero->delete();
            // 3. Preparar mensaje
            flash('Se ha eliminado '.$genero->name.' correctamente.')->success();
        }else{
            // Preparar mensaje de error
            flash('Error al eliminar, no existe el id '.$id.'.')->error();
        }
        // 4. Redireccionar
        return redirect()->route('genero.index');
    }
}
