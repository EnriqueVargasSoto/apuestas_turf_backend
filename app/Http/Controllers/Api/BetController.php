<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BetController extends Controller
{
    function index(Request $request)
    {
        $items = Bet::where('user_id', $request->user_id)->with(['betEvents'])->get();//all();
        return response()->json([
            'data' => $items
        ]);
    }

    function store(Request $request)
    {
        $item = Bet::create($request->all());
        $codigo = str_pad($item->id, 6, '0', STR_PAD_LEFT);
        $item->code = $codigo;
        $item->save();

        return response()->json([
            'data' => $item
        ]);
    }

    function show(Bet $item)
    {
        return response()->json([
            'data' => $item
        ]);
    }

    function update(Request $request, Bet $item)
    {
        $item->update($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function destroy(Bet $item)
    {
        $item->delete();
        return response()->json([
            'data' => $item
        ]);
    }

    public function cancelarEvento(Request $request){
        $apuestas = Bet::where('result', 'pendiente')->with(['betEvents'])->get();

        //Actualiza cancelados
        foreach ($apuestas as $key => $apuesta) {
            $newCuota = 0;

            foreach ($apuesta->betEvents as $key => $event) {
                if ($event->event_id == $request->id) {
                    $event->result = 'cancelado';
                    $event->save();
                }else{
                    $newCuota = $event->quota;
                }
            }
            $apuesta->quota = $newCuota;
            $apuesta->save();

        }

        //verifica los cancelados para reintegrar
        foreach ($apuestas as $key => $apuesta){
            if(count($apuesta->betEvents) == 1) {
                $condicionCancelado = true;
                foreach ($apuesta->betEvents as $key => $event) {
                    if ($event->result != 'cancelado') {
                        $condicionCancelado = false;
                        //break;
                    }
                }
                if ($condicionCancelado == true) {
                    Transaction::create([
                        'user_id' => $apuesta->user_id,
                        'type' => 'Reintegro',
                        'amount' => $apuesta->amount_total_bet
                    ]);
                    $apuesta->result = 'cancelada';
                    $apuesta->save();
                }
            }
        }

        //verifica perdidas
        foreach ($apuestas as $key => $apuesta){
            if($apuesta->result == 'pendiente') {
                $condicionPerdida = false;
                foreach ($apuesta->betEvents as $key => $event) {
                    if ($event->result == 'perdida') {
                        $condicionPerdida = true;
                        //break;
                    }
                }
                if ($condicionPerdida == true) {
                    /*Transaction::create([
                        'user_id' => $apuesta->user_id,
                        'type' => 'Reintegro',
                        'amount' => $apuesta->amount_total_bet
                    ]);*/
                    $apuesta->result = 'perdida';
                    $apuesta->save();
                }
            }
        }

        //verifica ganadas
        foreach ($apuestas as $key => $apuesta){
            if($apuesta->result == 'pendiente') {
                $condicionGanada = true;
                foreach ($apuesta->betEvents as $key => $event) {
                    if ($event->result != 'ganada' && $event->result != 'cancelada') {
                        $condicionGanada = false;
                        //break;
                    }
                }
                if ($condicionGanada == true) {
                    Transaction::create([
                        'user_id' => $apuesta->user_id,
                        'type' => 'Ganada',
                        'amount' => $apuesta->amount_total_result
                    ]);
                    $apuesta->result = 'ganada';
                    $apuesta->save();
                }
            }
        }
    }

    public function probabilidadesGanadas(Request $request){
        $apuestas = Bet::where('result', 'pendiente')->with(['betEvents'])->get();

        $ganadas = json_decode($request->ganadas);

        return response()->json($ganadas);

        //Actualiza ganados
        foreach ($apuestas as $key => $apuesta) {
            $newCuota = 0;

            foreach ($apuesta->betEvents as $key => $event) {
                if ($event->event_id == $request->id) {
                    foreach ($ganadas as $key => $ganada) {
                        if ($ganada == $event->probability_id) {
                            $event->result = 'ganada';
                            $event->save();
                        }
                    }

                }
            }
            //$apuesta->quota = $newCuota;
            //$apuesta->save();

        }

        //verifica pendientes

        foreach ($apuestas as $key => $apuesta) {
            if($apuesta->result == 'pendiente'){
                $verificaPendientes = false;

                foreach ($apuesta->betEvents as $key => $event) {
                    if ($event->result == 'pendiente') {
                        $verificaPendientes = true;
                        //break;
                    }
                }

                if ($verificaPendientes == false) {
                    $verificaCancelada = false;

                    foreach ($apuesta->betEvents as $key => $event) {
                        if ($event->result == 'cancelada') {
                            $verificaCancelada = true;
                            //break;
                        }
                    }

                    if ($verificaCancelada == true) {
                        $apuesta->result = 'perdida';
                        $apuesta->save();
                    }else {
                        Transaction::create([
                            'user_id' => $apuesta->user_id,
                            'type' => 'Ganada',
                            'amount' => $apuesta->amount_total_result
                        ]);
                        $apuesta->result = 'ganada';
                        $apuesta->save();
                    }
                }
            }

            //$apuesta->quota = $newCuota;
            //$apuesta->save();

        }
    }
}
