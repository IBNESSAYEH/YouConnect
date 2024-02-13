<?php

namespace App\Http\Controllers;

use App\Models\Folower;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFolowerRequest;
use App\Http\Requests\UpdateFolowerRequest;

class FolowerController extends Controller
{
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
     * @param  \App\Http\Requests\StoreFolowerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFolowerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folower  $folower
     * @return \Illuminate\Http\Response
     */
    public function show(Folower $folower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folower  $folower
     * @return \Illuminate\Http\Response
     */
    public function edit(Folower $folower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFolowerRequest  $request
     * @param  \App\Models\Folower  $folower
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFolowerRequest $request, Folower $folower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folower  $folower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folower $folower)
    {
        //
    }
}
