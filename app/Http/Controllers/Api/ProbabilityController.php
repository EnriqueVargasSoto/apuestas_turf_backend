<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Probability;
use Illuminate\Http\Request;

class ProbabilityController extends Controller
{
    function index(Request $request)
    {
        $event_id = $request->event_id;
        $items = Probability::where('event_id', $event_id)->where('status', 'active')->get();
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

    function inactivaProbabilidad($id){
        $probability = Probability::find($id);
        $probability->status = 'inactive';
        $probability->save();

        return response()->json($data = $probability);
    }
}
