<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BetEvent;
use Illuminate\Http\Request;

class BetEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $betEvent = BetEvent::create([
            'bet_id' => $request->bet_id,
            'event_id' => $request->event_id,
            'probability_id' => $request->probability_id,
            'amount_bet' => $request->amount_bet,
            'quota' => $request->quota,
            'amount_result' => $request->amount_result,
            'result' => $request->result
        ]);

        return response()->json([
            'data' => $betEvent
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
