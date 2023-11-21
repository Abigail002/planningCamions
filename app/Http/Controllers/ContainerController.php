<?php

namespace App\Http\Controllers;

use App\Models\Container;
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
            $allContainers[] = $container->number;
        }

        if($allDelivered == true)
        {
            $forecast = $container->forecast_id;
            return redirect()->route('delivery.store', ['forecast' => $forecast,'containers' => $allContainers]);
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
}
