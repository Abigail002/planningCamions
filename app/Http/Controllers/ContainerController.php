<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Forecast;
use App\Models\Mission;
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
    public function update(Request $request)
    {
        $container = Container::where('id', $request->input('TC1'))->get()->first();
        $status = nl2br("Delivered");
        $container->status = $status;
        $container->save();
        $container1 = Container::where('id', $request->input('TC2'))->get()->first();
        $status = nl2br("Delivered");
        $container1->status = $status;
        $container1->save();
        $containers = Container::where('forecast_id', $container->forecast_id)->get();

        $allDelivered = true;

        foreach ($containers as $container) {
            if ($container->status !== 'Delivered') {
                $allDelivered = false;
                break;
            }
        }

        if ($allDelivered == true) {
            $forecast = Forecast::where('id', $container->forecast_id)->get();
            $forecast->status = 'Delivered';
            $forecast->save();
        } else return 'Container delivered';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Container $container)
    {
        //
    }
    public function updateStatus($id)
    {
        $mission = Mission::where('id', $id)->get()->first();

        $container = Container::where('id', $mission->first_container_id)->get()->first();
        //$status = "In progress";
        $container->status = "In progress";
        try {
            return $container;
            $container->save();
        } catch (\Exception $e) {
            return ("Error in index method: " . $e->getMessage());
        }

        if ($mission->second_container_id) {
            $container1 = Container::where('id', $mission->second_container_id)->get()->first();
            $status = nl2br("In progress");
            $container1->status = $status;
            $container1->save();
        }

        $forecast = Forecast::where('id', $container->forecast_id)->get()->first();
        $forecast->status = 'In progress';
        $forecast->save();
        return "Success";
    }
}
