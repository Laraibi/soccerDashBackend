<?php

namespace App\Http\Controllers;

use App\Models\competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(competition::all()->sortBy("name")->values()->all());

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
     * @param  \App\Models\competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(competition $competition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, competition $competition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(competition $competition)
    {
        //
    }
}
