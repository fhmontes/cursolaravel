<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importar clases del modelo
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listado de registros
        // $users = User::all();                           // Obtener todos los registros
        // $users = User::orderBy('id', 'DESC')->get();    // Obtener todos los registros ordenados
        $users = User::orderBy('id', 'DESC')->paginate(10); // Obtener los registros ordenados y paginados
        // Enviar listado de registros a una vista
        $data['users'] = $users;
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Renderizar formulario para nuevo registro
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Guardar datos del formulario
        // 1. Obtener todos los datos del formulario
        $user = new User($request->all());
        // 2. Cifrar password
        $user->password = bcrypt($user->password);
        // 3. Guardar en la base de datos
        $user->save();
        // 4. Mostrar mensaje
        return 'Usuario registrado correctamente';
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
