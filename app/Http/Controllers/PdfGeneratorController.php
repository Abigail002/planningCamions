<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Customer;
use App\Models\Forecast;
use App\Models\LoadingFile;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;

class PdfGeneratorController extends Controller
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generate(string $id)
    {
        $container = Container::where('id', $id)->get()->first();
        $file = LoadingFile::where('id', $container->loading_file_id)->get()->first();

        //Search a second container
        $anotherContainer = Container::where('loading_file_id', $container->loading_file_id)->where('id', '!=', $container->id)->first();

        //Search the driver
        $driver = User::where('id', $container->user_id)->get()->first();

        //Search the custmer
        $forecast = Forecast::where('id', $container->forecast_id)->get()->first();
        $customer = Customer::where('id', $forecast->customer_id)->get()->first();
        //return $anotherContainer ?? 0;
        $pdf = PDF::loadview('loadingPDF', compact('file', 'container', 'driver', 'anotherContainer', 'customer'));
        //return view('loadingPDF', compact('file', 'container', 'driver', 'anotherContainer', 'customer'));
        return $pdf->download('ficheDeChargement-' . $container->number . '-' . $anotherContainer->number . '.pdf');
    }
}
