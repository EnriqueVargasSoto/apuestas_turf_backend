<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function index()
    {
        $items = Event::with(['probabilities.records'])->get();
        return response()->json([
            'data' => $items
        ]);
    }

    function store(Request $request)
    {
        if($request->hasFile('image')) {

            $path = $request->file('image')->store('image', 'public');//$request->file('image')->store('image/events');
            $item = Event::create([
                'type' => $request->type,
                'name' => $request->name,
                'image' => $path,
                'date' => $request->date,
                'tag' => 'Pendiente',
                'status' => 'active'
            ]);
            return response()->json([
                'data' => $item
            ]);
        }else {
            return response()->json([
                'message' => 'No se encontro la imagen'
            ]);
        }

        //$path = $request->file()->store('events', 'public');

    }

    function show(Event $item)
    {
        return response()->json([
            'data' => $item
        ]);
    }

    function update(Request $request, $id)
    {

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('image', 'public');
        }

        $item = Event::find($id);

        $item->type = $request->type;
        $item->name = $request->name;
        $item->image = $request->hasFile('image') ? $path : $item->image;
        $item->date = $request->date;
        $item->tag = $request->tag;
        $item->status = $request->status;

        $item->save();

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

    function anular() {

    }

    function eventosActivos() {
        $eventos = Event::where('tag', 'Activo')->where('status', 'active')->with(['probabilities'])->with(['probabilities.records'])->get();
        return response()->json($data = $eventos);
    }
}
