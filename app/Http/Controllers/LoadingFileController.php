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
        $loadingFile = New LoadingFile();

        $loadingFile->departCFS = $request->input('departCFS');
        $loadingFile->entreeGate3 = $request->input('entreeGate3');
        $loadingFile->arriveeGate10 = $request->input('arriveeGate10');
        $loadingFile->passageGate10 = $request->input('passageGate10');
        $loadingFile->chargementTC = $request->input('chargementTC');
        $loadingFile->passageScanner = $request->input('passageScanner');
        $loadingFile->resultatScanner = $request->input('resultatScanner');
        $loadingFile->sortieDouane = $request->input('sortieDouane');
        $loadingFile->sortieGate3 = $request->input('sortieGate3');
        $loadingFile->arriveeClient = $request->input('arriveeClient');
        $loadingFile->debutDehargement = $request->input('debutDehargement');
        $loadingFile->fintDehargement = $request->input('fintDehargement');
        $loadingFile->departClient = $request->input('departClient');
        $loadingFile->arriveeGate3 = $request->input('arriveeGate3');
        $loadingFile->arriveeCFS = $request->input('arriveeCFS');
        $loadingFile->save();

        $number = $request->input('container');
        $container = Container::where('number', $number)->get();
        return redirect()->route('container.update', ['id' => $container->id, 'loading' => $loadingFile->id]);
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
    public function update(Request $request, LoadingFile $loadingFile)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoadingFile $loadingFile)
    {
        //
    }
}
