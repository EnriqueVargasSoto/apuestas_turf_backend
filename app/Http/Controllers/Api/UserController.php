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

    function destroy($id)
    {
        $item = User::find($id);//->delete();
        $item->status = 'inactive';
        $item->save();
        return response()->json([
            'data' => $item
        ]);
    }

    function updateImage(Request $request, $id) {
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('image/user', 'public');
            $user = User::find($id);
            $user->name = $path;
            $user->save();
        }
    }

    function updatePassword(Request $request, $id) {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->clave = $request->password;
        $user->save();
    }
}
