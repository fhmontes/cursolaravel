<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importar clases model
use App\Pelicula;
use App\Genero;
use App\Director;
use App\Imagen;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peliculas = Pelicula::orderBy('id', 'DESC')->paginate(10);
        $data['peliculas'] = $peliculas;
        return view('admin.pelicula.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener listado de generos
        $data['generos'] = Genero::orderBy('genero', 'ASC')->pluck('genero', 'id');
        // Obtener listado de directores
        $data['directores'] = Director::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('admin.pelicula.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // 1. Recuperar datos del formulario
        $pelicula = new Pelicula($request->all());
        // 2. Setear el id del usuario
        $pelicula->user_id = 1;
        // 3. Guardar datos de la pelicula
        $pelicula->save();
        // 4. Guardar relacion pelicula_director
        $pelicula->directores()->sync($request->directores);
        // 5. Guardar el archivo de imagen
        // 5.1 Verificar si se esta enviando un archivo
        if($request->file('imagen')){
            // 5.2 Obtener el archivo
            $file = $request->file('imagen');
            // 5.3 Definir un nombre unico para el archivo
            $file_name = 'cinema_'.time().'.'.$file->getClientOriginalExtension();
            // 5.4 Indicar la ruta donde se guardara el archivo
            $file_path = public_path().'/imagenes/pelicula';
            // 5.5 Guardar el archivo
            $file->move($file_path, $file_name);
        }
        // 6. Guardar datos de la imagen
        $imagen = new Imagen();
        $imagen->nombre = $file_name;
        $imagen->pelicula()->associate($pelicula);
        $imagen->save();
        // 7. Generar mensaje
        flash('Se ha guardado correctamente la pelicula.')->success();
        // 8. Redireccionar listado
        return redirect()->route('pelicula.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
