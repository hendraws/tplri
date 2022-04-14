<?php

namespace App\Http\Controllers;

use App\Models\Kecerdasan;
use App\Models\KecerdasanPilihanUmum;
use Illuminate\Http\Request;
use App\Models\KecerdasanUmum;
use App\Models\PengaturanSoal;

class KecerdasanUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaturanSoal = PengaturanSoal::get();
        $soalKecerdasan = null;
        // dd($pengaturanSoal);
        foreach ($pengaturanSoal as $value) {
            $soal = Kecerdasan::with('getPilihan')->where('kategori', $value->kategori)->orderByRaw('RAND()')->take($value->jumlah_soal)->get();

            if (empty($soalKecerdasan)) {
                $soalKecerdasan = $soal;
            } else {
                $soalKecerdasan = $soalKecerdasan->merge($soal);
            }
        }

        foreach($soalKecerdasan as $val){

            $data = KecerdasanUmum::create([
                'pertanyaan' => $val->pertanyaan,
                'kategori' => $val->kategori,
                'jawaban_id' => $val->jawaban_id,
            ]);

            foreach ($val->getPilihan as $v) {

                $dataJawaban['kecerdasan_id'] = $data->id;
                $dataJawaban['pilihan'] = $v->pilihan;
                $dataJawaban['jawaban'] = $v->jawaban;
                $dataJawaban['benar'] = $v->benar;
                $soalPilihanGanda = KecerdasanPilihanUmum::create($dataJawaban);

                if ($v->benar == 'Y') {
                    $data->update([
                        'jawaban_id' => $soalPilihanGanda->id,
                    ]);
                }
            }

        }

        return 'd';
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
     * @param  \App\Models\KecerdasanUmum  $kecerdasanUmum
     * @return \Illuminate\Http\Response
     */
    public function show(KecerdasanUmum $kecerdasanUmum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KecerdasanUmum  $kecerdasanUmum
     * @return \Illuminate\Http\Response
     */
    public function edit(KecerdasanUmum $kecerdasanUmum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KecerdasanUmum  $kecerdasanUmum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KecerdasanUmum $kecerdasanUmum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KecerdasanUmum  $kecerdasanUmum
     * @return \Illuminate\Http\Response
     */
    public function destroy(KecerdasanUmum $kecerdasanUmum)
    {
        //
    }
}
