<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use Illuminate\Http\Request;

class BetController extends Controller
{
    function index()
    {
        $items = Bet::all();
        return response()->json([
            'data' => $items
        ]);
    }

    function store(Request $request)
    {
        $item = Bet::create($request->all());
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
}
