<?php

namespace App\Http\Controllers;

use App\Models\RefOption;
use Illuminate\Http\Request;

class RefOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RefOption::get();
        return view('admin.ref_option.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ref_option.create');
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
     * @param  \App\Models\RefOption  $refOption
     * @return \Illuminate\Http\Response
     */
    public function show(RefOption $refOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RefOption  $refOption
     * @return \Illuminate\Http\Response
     */
    public function edit(RefOption $refOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefOption  $refOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RefOption $refOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RefOption  $refOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(RefOption $refOption)
    {
        //
    }
}
