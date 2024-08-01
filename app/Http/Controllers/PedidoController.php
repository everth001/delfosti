<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\TrazabilidadPedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view('pedido.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::with(['producto', 'user', 'estado'])->get();

        return response()->json($pedidos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $userId = Auth::id();
        $pedido = [
            'nro_pedido' => random_int(100000, 999999),
            'producto_id' => $request->producto,
            'estado_id' => $request->estado,
            'repartidor' => $request->repartidor,
            'user_id' => $userId
        ];
        
        $fechas = [
            '1' => 'fecha_pedido',
            '2' => 'fecha_recepcion',
            '3' => 'fecha_despacho',
            '4' => 'fecha_entrega',
        ];
        
        if (isset($fechas[$request->estado])) {
            $pedido[$fechas[$request->estado]] = now();
        }

        Pedido::create($pedido);
        return response()->json([
            'status' => 0
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePedidoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePedidoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        return response()->json($pedido);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePedidoRequest  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $userId = Auth::id();

        $fechas = [
            '1' => 'fecha_pedido',
            '2' => 'fecha_recepcion',
            '3' => 'fecha_despacho',
            '4' => 'fecha_entrega',
        ];

        $pedido = Pedido::with(['producto', 'user', 'estado'])->findOrFail($id);

        $tempNombreFecha = $fechas[$pedido->estado_id];
        $fechaFormateada = Carbon::createFromFormat('d/m/Y H:i:s', $pedido->$tempNombreFecha)->format('Y-m-d H:i:s');

        $trazabilidad = new TrazabilidadPedido([
            "id_pedido" => $pedido->id,
            "producto" => $pedido->producto->nombre,
            "tipo_fecha" => $pedido->estado->nombre,
            "fecha" => $fechaFormateada,
            "user_id" => $pedido->user_id,
            "nombre_user" => $pedido->user->name,
            "repartidor" => $pedido->repartidor,
            "estado" => $pedido->estado->nombre
        ]);

        if (isset($fechas[$request->estado])) {
            $data[$fechas[$request->estado]] = now();
        }

        $trazabilidad->save();

        $data = [
            'nro_pedido' => $request->nro_pedido ?? $pedido->nro_pedido,
            'producto_id' => $request->producto ?? $pedido->producto_id,
            'estado_id' => $request->estado ?? $pedido->estado_id,
            'repartidor' => $request->repartidor ?? $pedido->repartidor,
            'user_id' => $userId
        ];

        if (isset($fechas[$request->estado])) {
            $data[$fechas[$request->estado]] = now();
        }

        $pedido->update($data);
        
        return response()->json([
            'status' => 0
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
