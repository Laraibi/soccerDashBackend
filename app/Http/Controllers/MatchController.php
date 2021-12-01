<?php

namespace App\Http\Controllers;

use App\Models\soccerMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(soccerMatch::all());

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
     * @param  \App\Models\match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(soccerMatch $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, soccerMatch $match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(soccerMatch $match)
    {
        //
    }

    public function matchsToDay(){
       $matchs=soccerMatch::where("Day",date("Y-m-d"))->with("awayTeam","homeTeam","Competition")->get();
       return response()->json($matchs);
    }
}
