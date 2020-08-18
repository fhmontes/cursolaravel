<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importar clases del modelo
use App\Director;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listado de registros
        // $directores = Director::all();                           // Obtener todos los registros
        // $directores = Director::orderBy('id', 'DESC')->get();    // Obtener todos los registros ordenados
        $directores = Director::orderBy('id', 'DESC')->paginate(10); // Obtener los registros ordenados y paginados
        // Enviar listado de registros a una vista
        $data['directores'] = $directores;
        return view('admin.director.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Renderizar formulario para nuevo registro
        return view('admin.director.create');
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
        $director = new Director($request->all());
        // 3. Guardar en la base de datos
        $director->save();
        // 4. Mostrar mensaje
        //return 'Director registrado correctamente';
        flash('Director registrado correctamente')->success();
        // 5. Redireccionar a listado de Directors
        return redirect()->route('director.index');
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
        $director = Director::find($id);
        // dd($director);
        $data['director'] = $director;
        return view('admin.director.edit', $data);
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
        $director = Director::find($id);
        // 2. Editar valores
        $director->fill($request->all());
        // 3. Guardar cambios
        $director->save();
        // 4. Preparar mensaje
        flash('Director editado correctamente')->success();
        // 5. Redireccionar
        return redirect()->route('director.index');
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
        $director=Director::find($id);
        if($director){
            // 2. Eliminar registro
            $director->delete();
            // 3. Preparar mensaje
            flash('Se ha eliminado '.$director->name.' correctamente.')->success();
        }else{
            // Preparar mensaje de error
            flash('Error al eliminar, no existe el id '.$id.'.')->error();
        }
        // 4. Redireccionar
        return redirect()->route('director.index');
    }
}
