<?php

namespace App\Http\Controllers;

use App\Models\Kepribadian;
use App\Models\KepribadianPilihanUmum;
use Illuminate\Http\Request;
use App\Models\KepribadianUmum;

class KepribadianUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soalPositif = Kepribadian::with('getPilihan')->where('sesi', '1')->where('jenis', 'positif')->orderByRaw('RAND()')->take(25)->get();
        $soalNegatif = Kepribadian::with('getPilihan')->where('sesi', '1')->where('jenis', 'negatif')->orderByRaw('RAND()')->take(25)->get();

        $soalSesi1 = $soalPositif->merge($soalNegatif)->shuffle();

        foreach($soalSesi1 as $pertanyaan){
            $input['pertanyaan'] = $pertanyaan->pertanyaan;
            $input['jenis'] = $pertanyaan->jenis;
            $input['sesi'] = 1;
            $input['created_by'] = auth()->user()->id;
            $soal =  KepribadianUmum::create($input);

            foreach ($pertanyaan->getPilihan as $key => $value) {

                KepribadianPilihanUmum::create([
                    'sesi' => 1,
                    'kepribadian_id' => $soal->id,
                    'pilihan' => $value->pilihan,
                    'jawaban' => $value->jawaban,
                    'bobot' => $value->bobot,
                ]);
            }
        }

        return 'done';
    }

    public function index2()
    {


        $soalSesi = Kepribadian::where('sesi', '2')->orderByRaw('RAND()')->take(50)->get();
        // dd($soalSesi);
        foreach($soalSesi as $pertanyaan){
            $input['pertanyaan'] = $pertanyaan->pertanyaan;
            $input['sesi'] = 2;
            $input['jawaban_id'] = $pertanyaan->jawaban_id;
            $input['created_by'] = auth()->user()->id;
              KepribadianUmum::create($input);

        }

        return 'done';
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
     * @param  \App\Models\KepribadianUmum  $kepribadianUmum
     * @return \Illuminate\Http\Response
     */
    public function show(KepribadianUmum $kepribadianUmum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KepribadianUmum  $kepribadianUmum
     * @return \Illuminate\Http\Response
     */
    public function edit(KepribadianUmum $kepribadianUmum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KepribadianUmum  $kepribadianUmum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KepribadianUmum $kepribadianUmum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KepribadianUmum  $kepribadianUmum
     * @return \Illuminate\Http\Response
     */
    public function destroy(KepribadianUmum $kepribadianUmum)
    {
        //
    }
}
