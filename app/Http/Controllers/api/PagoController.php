<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = DB::table('pagos')
        ->join('contratos_de_alquiler', 'pagos.contrato_id', '=', 'contratos_de_alquiler.id')
        ->select('pagos.*', 'contratos_de_alquiler.fecha_inicio', 'contratos_de_alquiler.fecha_fin')
        ->get();
    return json_encode(['pagos' => $pagos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pago = new Pago();
        $pago->contrato_id = $request->contrato_id;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->monto = $request->monto;
        $pago->metodo_pago = $request->metodo_pago;
        $pago->save();
        return json_encode(['pago' => $pago]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pago = DB::table('pagos')
        ->join('contratos_de_alquiler', 'pagos.contrato_id', '=', 'contratos_de_alquiler.id')
        ->select('pagos.*', 'contratos_de_alquiler.fecha_inicio', 'contratos_de_alquiler.fecha_fin')
        ->where('pagos.id', $id)
        ->first();
    return json_encode(['pago' => $pago]);
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
        $pago = Pago::find($id);
        $pago->contrato_id = $request->contrato_id;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->monto = $request->monto;
        $pago->metodo_pago = $request->metodo_pago;
        $pago->save();
        return json_encode(['pago' => $pago]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pago = Pago::find($id);
        $pago->delete();
        $pagos = DB::table('pagos')
            ->join('contratos_de_alquiler', 'pagos.contrato_id', '=', 'contratos_de_alquiler.id')
            ->select('pagos.*', 'contratos_de_alquiler.fecha_inicio', 'contratos_de_alquiler.fecha_fin')
            ->get();
        return json_encode(['pagos' => $pagos, 'success' => true]);
    }
}
