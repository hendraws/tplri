<?php

namespace App\Http\Controllers;

use App\Imports\KecermatanSamaImport;
use Illuminate\Http\Request;
use App\Models\KecermatanSama;
use Maatwebsite\Excel\Facades\Excel;

class KecermatanSamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KecermatanSama::get();

        return view('admin.kecermatan_sama.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kecermatan_sama.create');
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
     * @param  \App\Models\KecermatanSama  $kecermatanSama
     * @return \Illuminate\Http\Response
     */
    public function show(KecermatanSama $kecermatanSama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KecermatanSama  $kecermatanSama
     * @return \Illuminate\Http\Response
     */
    public function edit(KecermatanSama $kecermatanSama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KecermatanSama  $kecermatanSama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KecermatanSama $kecermatanSama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KecermatanSama  $kecermatanSama
     * @return \Illuminate\Http\Response
     */
    public function destroy(KecermatanSama $kecermatanSama)
    {
        //
    }

    public function import()
    {
        return view('admin.kecermatan_sama.import');
    }

    public function saveImport(Request $request)
    {
        Excel::import(new KecermatanSamaImport(), $request->file('import_file'));
        return 'success';
    }

    public function generate($kategori, $jumlah)
    {
        // dd($kategori, $jumlah);
        $angka = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $huruf = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',];
        if($kategori == 'angka'){
            $data = $angka;
        }

        if($kategori == 'huruf'){
            $data = $huruf;
        }



        for ($i = 0; $i < $jumlah; $i++) {
            shuffle($data);
            $jawaban_a =  array_slice($data, 0, 5);
            shuffle($data);
            $jawaban_b =  array_slice($data, 0, 5);
            shuffle($data);
            $jawaban_c =  array_slice($data, 0, 5);
            shuffle($data);
            $jawaban_d =  array_slice($data, 0, 5);
            shuffle($data);
            $jawaban_e =  array_slice($data, 0, 5);

            KecermatanSama::create([
                'jawaban_a' => implode($jawaban_a),
                'jawaban_b' => implode($jawaban_b),
                'jawaban_c' => implode($jawaban_c),
                'jawaban_d' => implode($jawaban_d),
                'jawaban_e' => implode($jawaban_e),
                'kategori' => $kategori,
            ]);
        }
    }
}
