<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    function index()
    {
        $items = Transaction::all();
        return response()->json([
            'data' => $items
        ]);
    }

    function store(Request $request)
    {
        $item = Transaction::create($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function show(Transaction $item)
    {
        return response()->json([
            'data' => $item
        ]);
    }

    function update(Request $request, Transaction $item)
    {
        $item->update($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function destroy(Transaction $item)
    {
        $item->delete();
        return response()->json([
            'data' => $item
        ]);
    }
}
