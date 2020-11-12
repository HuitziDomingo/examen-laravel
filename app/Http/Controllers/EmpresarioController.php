<?php

namespace App\Http\Controllers;

use App\Models\Empresario;
use Illuminate\Http\Request;

class EmpresarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresarios = Empresario::latest()->paginate(5);
        return view('index', ['empresarios' => $empresarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crear-empresario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'razon_social' => 'required',
            'razon_social' => 'required',
            'nombre' => 'required',
            'pais' => 'required',
            'tipo_moneda' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'activo' => 'required',
        ]);

        $empresario = Empresario::create($request->all());

        if( !is_null($empresario) )
            return back()->with('success', 'Nuevo empresario añadido');
        else return back()->with('failed', 'Alerta, empresario no añadido');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empresario $empresario)
    {
        return view('ver-empresario', compact('empresario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresario $empresario)
    {
        return view('editar-empresario', compact('empresario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresario $empresario)
    {
        $request->validate([
            'codigo' => 'required',
            'razon_social' => 'required',
            'razon_social' => 'required',
            'nombre' => 'required',
            'pais' => 'required',
            'tipo_moneda' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'activo' => 'required',
        ]);

        $empresario = Empresario::update($request->all());

        if( !is_null($empresario) )
            return back()->with('success', 'Actualizacion exitosa');
        else return back()->with('failed', 'Alerta, fallo la actualizacion de los datos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresario $empresario)
    {
        $empresario = $empresario->delete();

        if( is_null($empresario) )
            return back()->with("success", "Se elimino con exito");
        else return back()->with("failed", "Empresario no eliminado, vuelva a intentarlo");
    }
}
