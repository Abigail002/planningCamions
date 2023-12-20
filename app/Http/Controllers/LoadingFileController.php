<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\LoadingFile;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class LoadingFileController extends Controller
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
        try {
            $loadingFile = new LoadingFile();

            $loadingFile->departCFS = $request->input('departCFS');
            $loadingFile->entreeGate3 = $request->input('entreeGate3');
            $loadingFile->arriveeGate10 = $request->input('arriveeGate10');
            $loadingFile->passageGate10 = $request->input('passageGate10');
            $loadingFile->chargementTC1 = $request->input('chargementTC1');
            $loadingFile->chargementTC2 = $request->input('chargementTC2');
            $loadingFile->passageScanner = $request->input('passageScanner');
            $loadingFile->resultatScanner = $request->input('resultatScanner');
            $loadingFile->sortieDouane = $request->input('sortieDouane');
            $loadingFile->sortieGate3 = $request->input('sortieGate3');
            $loadingFile->arriveeClient = $request->input('arriveeClient');
            $loadingFile->debutDehargement = $request->input('debutDehargement');
            $loadingFile->finDechargement = $request->input('finDechargement');
            $loadingFile->departClient = $request->input('departClient');
            $loadingFile->arriveeGate3 = $request->input('arriveeGate3');
            $loadingFile->arriveeCFS = $request->input('arriveeCFS');
            $loadingFile->save();

            $id1 = $request->input('TC1');
            $container1 = Container::where('id', $id1)->get()->first();
            $container1->loading_file_id = $loadingFile->id;
            $container1->save();

            $id2 = $request->input('TC2');
            $container2 = Container::where('id', $id2)->get()->first();
            $container2->loading_file_id = $loadingFile->id;
            $container2->save();
            return $loadingFile;
        } catch (\Exception $e) {
            // Log the error details
            return ("Error in index method: " . $e->getMessage());

            // Return a generic error message
            return "An error occurred. Please check the logs for more details.";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LoadingFile $loadingFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoadingFile $loadingFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $loadingFile = LoadingFile::find($id);
            $loadingFile->departCFS = $request->input('departCFS');
            $loadingFile->entreeGate3 = $request->input('entreeGate3');
            $loadingFile->arriveeGate10 = $request->input('arriveeGate10');
            $loadingFile->passageGate10 = $request->input('passageGate10');
            $loadingFile->chargementTC1 = $request->input('chargementTC1');
            $loadingFile->chargementTC2 = $request->input('chargementTC2');
            $loadingFile->passageScanner = $request->input('passageScanner');
            $loadingFile->resultatScanner = $request->input('resultatScanner');
            $loadingFile->sortieDouane = $request->input('sortieDouane');
            $loadingFile->sortieGate3 = $request->input('sortieGate3');
            $loadingFile->arriveeClient = $request->input('arriveeClient');
            $loadingFile->debutDehargement = $request->input('debutDehargement');
            $loadingFile->finDechargement = $request->input('finDechargement');
            $loadingFile->departClient = $request->input('departClient');
            $loadingFile->arriveeGate3 = $request->input('arriveeGate3');
            $loadingFile->arriveeCFS = $request->input('arriveeCFS');
            $loadingFile->save();

            return $loadingFile;
        } catch (\Exception $e) {
            // Log the error details
            return ("Error in index method: " . $e->getMessage());

            // Return a generic error message
            return "An error occurred. Please check the logs for more details.";
        }

        return $loadingFile;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoadingFile $loadingFile)
    {
        //
    }
}
