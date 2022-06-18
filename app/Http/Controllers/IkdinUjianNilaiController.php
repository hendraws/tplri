<?php

namespace App\Http\Controllers;

use App\Models\IkdinUjianNilai;
use App\Models\IkdinUjianSiswa;
use Illuminate\Http\Request;

class IkdinUjianNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = IkdinUjianNilai::with('getUjianSiswa', 'getUjianSiswa.getSiswa')->orderBy('id','desc')->get();
        $data = IkdinUjianSiswa::with('getSiswa','getNilai')->orderBy('id','desc')->get();
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
     * @param  \App\Models\IkdinUjianNilai  $ikdinUjianNilai
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = IkdinUjianSiswa::with('getJawaban')->findOrFail($id);
        return view('admin.nilai.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IkdinUjianNilai  $ikdinUjianNilai
     * @return \Illuminate\Http\Response
     */
    public function edit(IkdinUjianNilai $ikdinUjianNilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IkdinUjianNilai  $ikdinUjianNilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IkdinUjianNilai $ikdinUjianNilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IkdinUjianNilai  $ikdinUjianNilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(IkdinUjianNilai $ikdinUjianNilai)
    {
        //
    }
}
