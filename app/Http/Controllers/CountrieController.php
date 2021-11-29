<?php

namespace App\Http\Controllers;

use App\Models\countrie;
use Illuminate\Http\Request;

class CountrieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(countrie::all()->sortBy("name")->values()->all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\countrie  $countrie
     * @return \Illuminate\Http\Response
     */
    public function show(countrie $countrie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\countrie  $countrie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, countrie $countrie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\countrie  $countrie
     * @return \Illuminate\Http\Response
     */
    public function destroy(countrie $countrie)
    {
        //
    }
}
