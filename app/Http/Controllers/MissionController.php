<?php

namespace App\Http\Controllers;

use App\Models\Forecast;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($driverId)
    {
        $missions = Mission::where('user_id', $driverId)->get();
        return $missions;
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
        $mission->user_id = $request->input('user_id');
        $mission->truck = $request->input('truck');
        $mission->trailer = $request->input('trailer');

        $missionExist = Mission::where('forecast_id', $mission->forecast_id)->get();

        //Récupération du nom d chauffeur assigné à la livraison
        $name = User::find($mission->user_id);
        $name = $name['name'];

        //Récupération des informations de la prévision
        $forecast = Forecast::find($mission->forecast_id);
        $date = \Carbon\Carbon::parse($forecast->forecastDate)->format('d-m-Y');
        $customer = $forecast->customer()->name;

        if (!$missionExist) {
            $mission->TC1 = $request->input('TC');

            $mission->description = "Bonjour " + $name + ". Vous avez été assigné à une livraison de "
                + $customer + " prévu le "
                + $date + " à charger au port " + $forecast->loadPlace + ". \nNuméro TC: " + $mission->TC1;

            $mission->save();
        } else {
            $TC = $request->input('TC');
            $mission->description = "Bonjour " + $name + ". Vous avez été assigné à une livraison de "
                + $customer + " prévu le "
                + $date + " à charger au port " + $forecast->loadPlace + ". Numéros TC: " + $mission->TC1 + " et " + $mission->TC2;

            return $this->addTC($TC, $missionExist, $mission->description);
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
    public function addTC($TC, Mission $mission, $description)
    {
        $mission = Mission::find($mission);
        $mission->TC2 = $TC;
        $mission->description = $description;

        $mission->save();
        return 'updated with successfull';
    }
}
