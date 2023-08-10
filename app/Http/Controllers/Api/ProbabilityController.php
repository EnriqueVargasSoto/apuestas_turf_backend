<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Probability;
use Illuminate\Http\Request;

class ProbabilityController extends Controller
{
    function index()
    {
        $items = Probability::all();
        return response()->json([
            'data' => $items
        ]);
    }

    function store(Request $request)
    {
        $item = Probability::create($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function show(Probability $item)
    {
        return response()->json([
            'data' => $item
        ]);
    }

    function update(Request $request, Probability $item)
    {
        $item->update($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function destroy(Probability $item)
    {
        $item->delete();
        return response()->json([
            'data' => $item
        ]);
    }
}
