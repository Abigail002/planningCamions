<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Forecast;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                $missions = Mission::where('driver_id', $user->id)->get();
                return $missions;
            } else {
                return "User not found";
            }
        } catch (\Exception $e) {
            // Log the error details
            error_log("Error in index method: " . $e->getMessage());

            // Return a generic error message
            return "An error occurred. Please check the logs for more details.";
        }
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
        $mission = new Mission();
        $mission->forecast_id = $request->input('forecast_id');
        $mission->truck = $request->input('truck');
        $mission->trailer  = $request->input('trailer');

        //Récupération de la mission si TC différent mais même chauffeur
        $ListMission = Mission::where('forecast_id', $mission->forecast_id)
            ->where('driver_id', '=', $request->input('driver_id'))
            ->where('truck', '=', $request->input('truck'))
            ->where('trailer', '=', $request->input('trailer'))
            ->get()->first();
        //Récupération si même TC
        $ListMission1 = Mission::where('forecast_id', $mission->forecast_id)
            ->where('first_container_id', '=', $request->input('TC_id'))
            ->get()->first();

        //Récupération du nom d chauffeur assigné à la livraison
        $mission->driver_id = $request->input('driver_id');
        $driver = User::find($mission->driver_id);
        $name = $driver['name'];
        $driver->status = 'Busy';
        $driver->save();

        //Récupération des informations de la prévision
        $forecast = Forecast::find($mission->forecast_id);
        $date = \Carbon\Carbon::parse($forecast->forecastDate)->format('d-m-Y');
        $customer = $forecast->customer->name;

        //Récupération du numéro du container
        $TC = Container::find($request->input('TC_id'));
        $TC->status = "Waiting for the driver";
        $TC->save();

        if (!$ListMission) {
            $mission->first_container_id = $request->input('TC_id');

            $mission->description = nl2br("Bonjour " . $name . ". Vous avez été assigné à une livraison de "
                . $customer . " prévu le "
                . $date . " à charger au port " . $forecast->loadPlace . ". \nNuméro TC: " . $TC->number . "\nTracteur : " . $mission->truck . "\nRemorque : " . $mission->trailer);

            $mission->save();
            return $mission;
        }
        //Si une mission est déjà créée pour ce container
        elseif ($ListMission1) {
            $ListMission1->truck = $request->input('truck');
            $ListMission1->trailer  = $request->input('trailer');
            $ListMission1->driver_id  = $request->input('driver_id');
            $ListMission1->description = nl2br("Bonjour " . $name . ". Vous avez été assigné à une livraison de "
                . $customer . " prévu le "
                . $date . " à charger au port " . $forecast->loadPlace . ". \nNuméro TC: " . $TC->number . "\nTracteur : " . $ListMission1->truck . "\nRemorque : " . $ListMission1->trailer);
            $ListMission1->save();
            return $ListMission1;
        } else {
            $ListMission->second_container_id = $request->input('TC_id');
            $TC1 = Container::find($ListMission->first_container_id);
            $ListMission->description = nl2br("Bonjour " . $name . ". Vous avez été assigné à une livraison de "
                . $customer . " prévu le "
                . $date . " à charger au port " . $forecast->loadPlace . ". \nNuméros TC: " . $TC1->number . " et " . $TC->number . "\nTracteur : " . $ListMission->truck . "\nRemorque : " . $ListMission->trailer);

            $ListMission->save();
            return $ListMission;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
    }
}
