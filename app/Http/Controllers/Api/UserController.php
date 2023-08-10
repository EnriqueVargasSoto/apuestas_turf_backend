<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $items = User::all();
        return response()->json([
            'data' => $items
        ]);
    }

    function store(Request $request)
    {
        $item = User::create($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function show(User $item)
    {
        return response()->json([
            'data' => $item
        ]);
    }

    function update(Request $request, User $item)
    {
        $item->update($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function destroy(User $item)
    {
        $item->delete();
        return response()->json([
            'data' => $item
        ]);
    }
}
