<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Forecast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContainerController extends Controller
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
    public function show(Container $container)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Container $container)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Container $container)
    {
        $container->status = 'Delivered';
        $container->save();

        $containers = Container::where('forecast_id', $container->forecast_id)->get();

        $allDelivered = true;

        foreach ($containers as $container) {
            if ($container->status !== 'Delivered') {
                $allDelivered = false;
                break;
            }
        }

        if($allDelivered == true)
        {
            $forecast = Forecast::where('id', $container->forecast_id)->get();
            $forecast->status = 'Delivered';
            $forecast->save();
        }
        else return 'Container delivered';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Container $container)
    {
        //
    }
    public function updateStatus ($forecastId)
    {
        $container = Container::where('forecast_id', $forecastId)->get()->first();
        $status = nl2br("In progress");
        $container->status = $status;
        $container->save();

        $forecast = Forecast::where('id', $forecastId)->get()->first();
        $forecast->status = 'In progress';
        $forecast->save();

        return $container;
    }
}
