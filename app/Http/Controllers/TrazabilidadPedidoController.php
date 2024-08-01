<?php

namespace App\Http\Controllers;

use App\Models\TrazabilidadPedido;
use App\Http\Requests\StoreTrazabilidadPedidoRequest;
use App\Http\Requests\UpdateTrazabilidadPedidoRequest;
use Illuminate\Http\Request;

class TrazabilidadPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTrazabilidadPedidoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrazabilidadPedidoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrazabilidadPedido $trazabilidadPedido
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $trazabilidadPedido = TrazabilidadPedido::where('id_pedido', $request->id_pedido)->get();

        return response()->json($trazabilidadPedido);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrazabilidadPedido  $trazabilidadPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(TrazabilidadPedido $trazabilidadPedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrazabilidadPedidoRequest  $request
     * @param  \App\Models\TrazabilidadPedido  $trazabilidadPedido
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrazabilidadPedidoRequest $request, TrazabilidadPedido $trazabilidadPedidoProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrazabilidadPedido  $trazabilidadPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrazabilidadPedido $trazabilidadPedido)
    {
        //
    }
}
