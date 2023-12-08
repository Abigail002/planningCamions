<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Forecast;
use Illuminate\Http\Request;

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
        $loading = $request->loading;

        $container->update([
            'loading_file_id' => $loading,
            'status' => 'Delivered',
        ]);
        $container->save();

        $containers = Container::where('forecast_id', $container->forecast_id)->get();

        $allDelivered = true;

        foreach ($containers as $container) {
            if ($container->status !== 'delivered') {
                $allDelivered = false;
                break;
            }
        }

        if($allDelivered == true)
        {
            $forecast = Forecast::where('id', $container->forecast_id)->get();
            $forecast->update([
                'status' => 'Delivered',
            ]);
            $forecast->save();
        }
        else return 'File added to the container';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Container $container)
    {
        //
    }
    public function updateStatus (Container $container)
    {
        $container = Container::where('forecast_id', $container->forecast_id)->get();
        $container->update([
            'status' => 'In progress',
        ]);
        $container->save();
        return redirect()->route('forecast.update', ['id' => $container->forecast_id]);
    }
}
