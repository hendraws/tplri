<?php

namespace App\Http\Controllers;

use App\Models\AkademikUjianNilai;
use Illuminate\Http\Request;

class AkademikUjianNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AkademikUjianNilai::orderBy('id','desc')->get();

        return view('admin.nilai.index', compact('data'));
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
     * @param  \App\Models\AkademikUjianNilai  $akademikUjianNilai
     * @return \Illuminate\Http\Response
     */
    public function show(AkademikUjianNilai $akademikUjianNilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AkademikUjianNilai  $akademikUjianNilai
     * @return \Illuminate\Http\Response
     */
    public function edit(AkademikUjianNilai $akademikUjianNilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AkademikUjianNilai  $akademikUjianNilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AkademikUjianNilai $akademikUjianNilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AkademikUjianNilai  $akademikUjianNilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(AkademikUjianNilai $akademikUjianNilai)
    {
        //
    }
}
