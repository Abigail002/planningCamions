<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Forecast;
use Illuminate\Http\Request;

class DeliveryController extends Controller
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
        $forecast_id = $request->forecast;

        $forecast = Forecast::where('id', $forecast_id)->get();

        $delivery = New Delivery();

        $delivery->customer_id = $forecast->customer_id;
        $delivery->user_id = $forecast->user_id;
        $delivery->operation = $forecast->operation;
        $delivery->BL = $forecast->BL;
        $delivery->ETA = $forecast->ETA;
        $delivery->idTrakit = $forecast->idTrakit;
        $delivery->numbTruck = $forecast->numbTruck;
        $delivery->loadPlace = $forecast->loadPlace;
        $delivery->deliveryPlace = $forecast->deliveryPlace;
        $delivery->containers = $request->input('containers');
        $delivery->save();

        return redirect()->route('forecast.delete', ['id' => $forecast->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        //
    }
}
