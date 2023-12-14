<?php

namespace App\Http\Controllers;

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
                $missions = Mission::where('user_id', $user->id)->get();
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
        $mission->user_id = $request->input('user_id');
        $mission->truck = $request->input('truck');
        $mission->trailer  = $request->input('trailer');

        $ListMission = Mission::where('forecast_id', $mission->forecast_id)
            ->where('user_id', '=', $mission->user_id)
            ->get()->first();

        //Récupération du nom d chauffeur assigné à la livraison
        $name = User::find($mission->user_id);
        $name = $name['name'];

        //Récupération des informations de la prévision
        $forecast = Forecast::find($mission->forecast_id);
        $date = \Carbon\Carbon::parse($forecast->forecastDate)->format('d-m-Y');
        $customer = $forecast->customer->name;

        if (!$ListMission) {
            $mission->TC1 = $request->input('TC');

            $mission->description = nl2br("Bonjour " . $name . ". Vous avez été assigné à une livraison de "
                . $customer . " prévu le "
                . $date . " à charger au port " . $forecast->loadPlace . ". \nNuméro TC: " . $mission->TC1);

            $mission->save();
            return $mission;
        } else {
            $TC = $request->input('TC');
            $ListMission->TC2 = $TC;
            $ListMission->description = nl2br("Bonjour " . $name . ". Vous avez été assigné à une livraison de "
                . $customer . " prévu le "
                . $date . " à charger au port " . $forecast->loadPlace . ". \nNuméros TC: " . $ListMission->TC1 . " et " . $ListMission->TC2);

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
