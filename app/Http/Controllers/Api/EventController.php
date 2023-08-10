<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function index()
    {
        $items = Event::all();
        return response()->json([
            'data' => $items
        ]);
    }

    function store(Request $request)
    {
        $item = Event::create($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function show(Event $item)
    {
        return response()->json([
            'data' => $item
        ]);
    }

    function update(Request $request, Event $item)
    {
        $item->update($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function destroy(Event $item)
    {
        $item->delete();
        return response()->json([
            'data' => $item
        ]);
    }
}
