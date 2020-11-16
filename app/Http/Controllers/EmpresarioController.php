<?php

namespace App\Http\Controllers;

use App\Models\Empresario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class EmpresarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $empresarios = Empresario::where('activo', 1)->latest()->paginate(5);
        //Logica para la api de monedas
        $response = Http::get(
            'https://fx.currencysystem.com/webservices/CurrencyServer5.asmx/AllCurrencies',
            [
                'licenseKey' => '',
            ]
        );
        $s = xml_parser_create();
        xml_parse_into_struct($s, $response->body(), $vals, $index);
        xml_parser_free($s);

        $currencies = explode(';',$vals[0]['value']);
        $currencies = strval(json_encode($currencies));

        return view('index', ['empresarios' => $empresarios, 'currencies' => $currencies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $response = Http::get(
            'https://fx.currencysystem.com/webservices/CurrencyServer5.asmx/AllCurrencies',
            [
                'licenseKey' => '',
            ]
        );
        $s = xml_parser_create();
        xml_parse_into_struct($s, $response->body(), $vals, $index);
        xml_parser_free($s);

        $currencies = explode(';',$vals[0]['value']);


        $this->validate($request,[
            'codigo' => 'required',
            'razon_social' => 'required',
            'nombre' => 'required',
            'pais' => 'required',
            'tipo_moneda' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);

        $data = [
            'state' => false,
            'id' => 0,
        ];


        $codePetition = Empresario::find($request->codigo_empleado);
        if( $codePetition )
            $data['error_codigo'] = 1;
        else if( !in_array ($request->tipo_moneda, $currencies) )
            $data['currency'] = 1;
        else {
            $empleado = new Empresario();
            $empleado->codigo = $request->codigo;
            $empleado->razon_social =  $request->razon_social;
            $empleado->nombre = $request->nombre;
            $empleado->pais = $request->pais;
            $empleado->estado = $request->estado;
            $empleado->ciudad = $request->ciudad;
            $empleado->telefono = $request->telefono;
            $empleado->email = $request->email;
            $empleado->tipo_moneda= $request->tipo_moneda;
            $empleado->activo = 1;
            $data['state'] = $empleado->save();
    }
        if($data['state']) $data['id'] = $empleado->id;
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $u = Empresario::find($request->id);
        $data = [];
        $data["id"] = $u->id;
        $data["codigo"] = $u->codigo;
        $data["razon_social"] = $u->razon_social;
        $data["nombre"] = $u->nombre;
        $data["pais"] = $u->pais;
        $data["tipo_moneda"] = $u->tipo_moneda;
        $data["estado"] = $u->estado;
        $data["ciudad"] = $u->ciudad;
        $data["telefono"] = $u->telefono;
        $data["email"] = $u->email;
        $data["activo"] = $u->activo;

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Empresario $empresarios)
    {
        $this->validate($request,[
            'codigo' => 'required',
            'razon_social' => 'required',
            'nombre' => 'required',
            'pais' => 'required',
            'tipo_moneda' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);

        $empresarios = Empresario::find($request->id);
        $empresarios->codigo = $request->codigo;
        $empresarios->razon_social = $request->razon_social;
        $empresarios->nombre = $request->nombre;
        $empresarios->pais = $request->pais;
        $empresarios->tipo_moneda = $request->tipo_moneda;
        $empresarios->estado = $request->estado;
        $empresarios->ciudad = $request->ciudad;
        $empresarios->telefono = $request->telefono;
        $empresarios->email = $request->email;
        $result = $empresarios->save();

        return ['result' => $result];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {
        $empleado = Empresario::find($request->id);
        $empleado->activo = 0;

        return ['result' => $empleado->save()];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tooglestate(request $request)
    {
        $empresario = Empresario::find($request->id);
        $empresario->activo = (int) !$empresario->activo;
        $result = $empresario->save();

        return [
            'result' => $result,
            'id' => $request->id,
            'activo' => $empleado->activo
        ];
    }

}
