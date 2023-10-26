<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Record;

class RecordController extends Controller
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
        $record = Record::create([
            'probability_id' => $request->probability_id,
            'record' => $request->record
        ]);

        return response()->json($data = $record, 200);
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
        $record = Record::find($id);
        $record->record = $request->record;
        $record->save();

        return response()->json($data = $record, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Record::find($id);
        $record->delete();

        return response()->json('ok', 200);
    }

    public function indexForProbability($id){
        $records = Record::where('probability_id', $id)->get();
        return response()->json($data = $records, 200);
    }
}
