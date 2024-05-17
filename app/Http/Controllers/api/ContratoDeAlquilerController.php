<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ContratoDeAlquiler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContratoDeAlquilerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = DB::table('contratos_de_alquiler')
        ->join('vehiculos', 'contratos_de_alquiler.vehiculo_id', '=', 'vehiculos.id')
        ->join('clientes', 'contratos_de_alquiler.cliente_id', '=', 'clientes.id')
        ->select('contratos_de_alquiler.*', 'vehiculos.marca', 'vehiculos.modelo', 'clientes.nombre', 'clientes.apellido')
        ->get();
    return json_encode(['contratos' => $contratos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contrato = new ContratoDeAlquiler();
        $contrato->vehiculo_id = $request->vehiculo_id;
        $contrato->cliente_id = $request->cliente_id;
        $contrato->fecha_inicio = $request->fecha_inicio;
        $contrato->fecha_fin = $request->fecha_fin;
        $contrato->total = $request->total;
        $contrato->save();
        return json_encode(['contrato' => $contrato]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = DB::table('contratos_de_alquiler')
        ->join('vehiculos', 'contratos_de_alquiler.vehiculo_id', '=', 'vehiculos.id')
        ->join('clientes', 'contratos_de_alquiler.cliente_id', '=', 'clientes.id')
        ->select('contratos_de_alquiler.*', 'vehiculos.marca', 'vehiculos.modelo', 'clientes.nombre', 'clientes.apellido')
        ->where('contratos_de_alquiler.id', $id)
        ->first();
    return json_encode(['contrato' => $contrato]);
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
        $contrato = ContratoDeAlquiler::find($id);
        $contrato->vehiculo_id = $request->vehiculo_id;
        $contrato->cliente_id = $request->cliente_id;
        $contrato->fecha_inicio = $request->fecha_inicio;
        $contrato->fecha_fin = $request->fecha_fin;
        $contrato->total = $request->total;
        $contrato->save();
        return json_encode(['contrato' => $contrato]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrato = ContratoDeAlquiler::find($id);
        $contrato->delete();
        $contratos = DB::table('contratos_de_alquiler')
            ->join('vehiculos', 'contratos_de_alquiler.vehiculo_id', '=', 'vehiculos.id')
            ->join('clientes', 'contratos_de_alquiler.cliente_id', '=', 'clientes.id')
            ->select('contratos_de_alquiler.*', 'vehiculos.marca', 'vehiculos.modelo', 'clientes.nombre', 'clientes.apellido')
            ->get();
        return json_encode(['contratos' => $contratos, 'success' => true]);
    }
}
