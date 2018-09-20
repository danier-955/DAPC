<?php

namespace App\Http\Controllers;

use App\Nomina;
use Illuminate\Http\Request;

class NominaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nomina  $nomina
     * @return \Illuminate\Http\Response
     */
    public function show(Nomina $nomina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nomina  $nomina
     * @return \Illuminate\Http\Response
     */
    public function edit(Nomina $nomina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nomina  $nomina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nomina $nomina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nomina  $nomina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nomina $nomina)
    {
        //
    }
}
