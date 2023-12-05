<?php

namespace App\Http\Controllers;

use App\Models\Forecast;
use Illuminate\Http\Request;

class ForecastController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Forecast $forecast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forecast $forecast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forecast $forecast)
    {
        $forecast = Forecast::where('id', $request->id)->get();
        $forecast->update([
            'status' => 'In progress',
        ]);
        $forecast->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forecast $forecast)
    {
        if (!$forecast) {
            return response()->json(['message' => 'Forecast not found'], 404);
        }
        $forecast->delete();

        return response()->json(['message' => 'Forecast deleted successfully']);
    }
}
