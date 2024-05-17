<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = DB::table('reservas')
        ->join('clientes', 'reservas.cliente_id', '=', 'clientes.id')
        ->join('vehiculos', 'reservas.vehiculo_id', '=', 'vehiculos.id')
        ->select('reservas.*', 'clientes.nombre', 'clientes.apellido', 'vehiculos.marca', 'vehiculos.modelo')
        ->get();
    return json_encode(['reservas' => $reservas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reserva = new Reserva();
        $reserva->cliente_id = $request->cliente_id;
        $reserva->vehiculo_id = $request->vehiculo_id;
        $reserva->fecha_reserva = $request->fecha_reserva;
        $reserva->fecha_inicio = $request->fecha_inicio;
        $reserva->fecha_fin = $request->fecha_fin;
        $reserva->estado = $request->estado;
        $reserva->save();
        return json_encode(['reserva' => $reserva]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reserva = DB::table('reservas')
        ->join('clientes', 'reservas.cliente_id', '=', 'clientes.id')
        ->join('vehiculos', 'reservas.vehiculo_id', '=', 'vehiculos.id')
        ->select('reservas.*', 'clientes.nombre', 'clientes.apellido', 'vehiculos.marca', 'vehiculos.modelo')
        ->where('reservas.id', $id)
        ->first();
    return json_encode(['reserva' => $reserva]);
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
        $reserva = Reserva::find($id);
        $reserva->cliente_id = $request->cliente_id;
        $reserva->vehiculo_id = $request->vehiculo_id;
        $reserva->fecha_reserva = $request->fecha_reserva;
        $reserva->fecha_inicio = $request->fecha_inicio;
        $reserva->fecha_fin = $request->fecha_fin;
        $reserva->estado = $request->estado;
        $reserva->save();
        return json_encode(['reserva' => $reserva]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reserva = Reserva::find($id);
        $reserva->delete();
        $reservas = DB::table('reservas')
            ->join('clientes', 'reservas.cliente_id', '=', 'clientes.id')
            ->join('vehiculos', 'reservas.vehiculo_id', '=', 'vehiculos.id')
            ->select('reservas.*', 'clientes.nombre', 'clientes.apellido', 'vehiculos.marca', 'vehiculos.modelo')
            ->get();
        return json_encode(['reservas' => $reservas, 'success' => true]);
    }
}
