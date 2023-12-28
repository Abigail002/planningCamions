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
    public function update($id)
    {
        $mission = Mission::where('id', $id)->get()->first();

        $container = Container::where('id', $mission->first_container_id)->get()->first();
        $status = nl2br("Delivered");
        $container->status = $status;
        $container->save();
        if ($mission->second_container_id) {
            $container1 = Container::where('id', $mission->second_container_id)->get()->first();
            $container1->status = $status;
            $container1->save();
        }
        $containers = Container::where('forecast_id', $container->forecast_id)->get();

        $allDelivered = true;

        foreach ($containers as $container) {
            if ($container->status == 'Delivered') {
                $allDelivered = true;
            } else {
                $allDelivered = false;
                break;
            }
        }
        if ($allDelivered == true) {
            $forecast = Forecast::where('id', $container->forecast_id)->get()->first();
            $forecast->status = 'Delivered';
            $forecast->save();
            return $forecast;
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
        $container->update(['status' => 'In progress']);
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
