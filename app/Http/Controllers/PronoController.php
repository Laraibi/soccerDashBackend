<?php

namespace App\Http\Controllers;

use App\Models\prono;
use Illuminate\Http\Request;

class PronoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        //
        return response()->json($request->user()->pronos->load('soccerMatch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate(['match_id' => 'required', 'prono' => 'required|max:1|in:x,1,2', 'mise' => 'required|numeric|min:5']);
        if ($request->user()->solde < $request->mise) {
            return response('Solde Inssufisant', 404);
        }
        $request->user()->solde -= $request->mise;
        $request->user()->save();
        $prono = $request->user()->pronos()->create($request->only(['match_id', 'prono', 'mise']));
        $prono->load('soccerMatch');
        return response()->json(['soldeUser' => $request->user()->solde, 'prono' => $prono], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\prono  $prono
     * @return \Illuminate\Http\Response
     */
    public function show(prono $prono)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\prono  $prono
     * @return \Illuminate\Http\Response
     */
    public function edit(prono $prono)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\prono  $prono
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, prono $prono)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\prono  $prono
     * @return \Illuminate\Http\Response
     */
    public function destroy(prono $prono)
    {
        //
    }
}
