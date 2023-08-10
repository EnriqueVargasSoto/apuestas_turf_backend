<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    function index()
    {
        $items = Role::all();
        return response()->json([
            'data' => $items
        ]);
    }

    function store(Request $request)
    {
        $item = Role::create($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function show(Role $item)
    {
        return response()->json([
            'data' => $item
        ]);
    }

    function update(Request $request, Role $item)
    {
        $item->update($request->all());
        return response()->json([
            'data' => $item
        ]);
    }

    function destroy(Role $item)
    {
        $item->delete();
        return response()->json([
            'data' => $item
        ]);
    }
}
