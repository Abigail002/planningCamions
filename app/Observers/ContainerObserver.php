<?php

namespace App\Observers;

use App\Models\Container;
use App\Models\Forecast;
use App\Models\Mission;
use App\Models\Trailer;
use App\Models\Truck;
use App\Models\User;

class ContainerObserver
{
    /**
     * Handle the Container "created" event.
     */
    public function created(Container $container): void
    {
        //
    }

    /**
     * Handle the Container "updated" event.
     */
    public function updated(Container $container): void
    {
        // Vérifier si les attributs spécifiques (truck, trailer, user_id) sont modifiés
        $modifiedAttributes = $container->getDirty();

        if (array_intersect(['truck_id', 'trailer_id', 'user_id'], array_keys($modifiedAttributes))) {
            $mission = new Mission();
            $mission->forecast_id = $container->forecast_id;
            $mission->truck = $container->truck_id;
            $mission->trailer  = $container->trailer_id;

            //Récupération de la mission si TC différent mais même chauffeur
            $ListMission = Mission::where('forecast_id', $mission->forecast_id)
                ->where('driver_id', '=', $container->user_id)
                ->where('truck', '=', $container->truck_id)
                ->where('trailer', '=', $container->trailer_id)
                ->get()->first();
            //Récupération si même TC
            $ListMission1 = Mission::where('forecast_id', $container->forecast_id)
                ->where('first_container_id', '=', $container->id)
                ->get()->first();

            //Récupération du nom d chauffeur assigné à la livraison
            $mission->driver_id = $container->user_id;
            $driver = User::find($mission->driver_id);
            $name = $driver['name'];
            $driver->status = 'Busy';
            $driver->save();

            //Récupération du tracteur
            $truck = Truck::find($mission->truck);

            //Récupération de la remorque
            $trailer = Trailer::find($mission->trailer);

            //Récupération des informations de la prévision
            $forecast = Forecast::find($mission->forecast_id);
            $date = \Carbon\Carbon::parse($forecast->forecastDate)->format('d-m-Y');
            $customer = $forecast->customer->name;

            //Récupération du numéro du container
            $TC = Container::find($container->id);
            $TC->status = "Waiting for the driver";
            $TC->save();

            if (!$ListMission && !$ListMission1) {
                $mission->first_container_id = $container->id;

                $mission->description = "Bonjour " . $name . ". Vous avez été assigné à une livraison de "
                . $customer . " prévu le "
                . $date . " à charger au port " . $forecast->loadPlace . ".\n"
                . "Numéro TC: " . $TC->number . "\n"
                . "Tracteur : " . $truck->number . "\n"
                . "Remorque : " . $trailer->number;

                $mission->save();
                //return $mission;
            }
            //Si une mission est déjà créée pour ce container
            elseif ($ListMission1) {
                $ListMission1->truck = $container->truck_id;
                $ListMission1->trailer  = $container->trailer_id;
                $ListMission1->driver_id  = $container->user_id;
                $ListMission1->description = "Bonjour " . $name . ". Vous avez été assigné à une livraison de "
                    . $customer . " prévu le "
                    . $date . " à charger au port " . $forecast->loadPlace . ". \nNuméro TC: " . $TC->number . "\nTracteur : " . $truck->number . "\nRemorque : " . $trailer->number;
                $ListMission1->save();
                //return $ListMission1;
            } else {
                $ListMission->second_container_id = $container->id;
                $TC1 = Container::find($ListMission->first_container_id);
                $ListMission->description = "Bonjour " . $name . ". Vous avez été assigné à une livraison de "
                    . $customer . " prévu le "
                    . $date . " à charger au port " . $forecast->loadPlace . ". \nNuméros TC: " . $TC1->number . " et " . $TC->number . "\nTracteur : " . $truck->number . "\nRemorque : " . $trailer->number;

                $ListMission->save();
                //return $ListMission;
            }
        }
    }

    /**
     * Handle the Container "deleted" event.
     */
    public function deleted(Container $container): void
    {
        //
    }

    /**
     * Handle the Container "restored" event.
     */
    public function restored(Container $container): void
    {
        //
    }

    /**
     * Handle the Container "force deleted" event.
     */
    public function forceDeleted(Container $container): void
    {
        //
    }

    public function sendModificationEmail()
    {
        
    }
}
