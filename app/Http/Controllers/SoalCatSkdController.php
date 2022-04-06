<?php

namespace App\Http\Controllers;

use App\Models\SoalCatSkd;
use Illuminate\Http\Request;
use App\Models\SoalPilihanCatSkd;
use Illuminate\Support\Facades\DB;

class SoalCatSkdController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($contentSoal,  $request->mapel_id);
            $input['pertanyaan'] = $request->pertanyaan;
            $input['jawaban_id'] = 0;
            $input['mapel'] = $request->tiu;
            $input['kategori'] = $request->kategori;
            $soal =  SoalCatSkd::create($input);

            foreach ($request->jawaban as $k => $v) {

                if (empty($v)) {
                    $v = '-';
                }

                $dataJawaban['soal_id'] = $soal->id;
                $dataJawaban['pilihan'] = $k;
                $dataJawaban['jawaban'] = $v;
                $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i' ? 'Y' : 'N';
                $soalPilihanGanda = SoalPilihanCatSkd::create($dataJawaban);

                if ($request->jawaban_benar == $k) {
                    $soal->update([
                        'jawaban_id' => $soalPilihanGanda->id,
                    ]);
                }
            }

            // $mapel['created_by'] = auth()->user()->id;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            toastr()->error($e->getMessage(), 'Error');

            return back();
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e->getMessage());
            toastr()->error($e->getMessage(), 'Error');
            throw $e;
        }

        DB::commit();
        toastr()->success('Data telah ditambahkan', 'Berhasil');
        return redirect(action('SoalCatSkdController@tiu', [$request->kategori]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SoalCatSkd  $soalCatSkd
     * @return \Illuminate\Http\Response
     */
    public function show(SoalCatSkd $soalCatSkd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SoalCatSkd  $soalCatSkd
     * @return \Illuminate\Http\Response
     */
    public function edit(SoalCatSkd $soalCatSkd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SoalCatSkd  $soalCatSkd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoalCatSkd $soalCatSkd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SoalCatSkd  $soalCatSkd
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoalCatSkd $soalCatSkd)
    {
        //
    }

    public function tiu(Request $request, $kategori)
    {
            $data = SoalCatSkd::where('mapel', 'tiu')->where('kategori', $kategori)->get();
            return view('admin.soal_cat_skd.index_tiu', compact('data', 'kategori'));
    }

    public function createTiu(Request $request, $kategori)
    {
        return view('admin.soal_cat_skd.create_tiu', compact('kategori'));
    }

    public function storeTiu(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($contentSoal,  $request->mapel_id);
            $input['pertanyaan'] = $request->pertanyaan;
            $input['jawaban_id'] = 0;
            $input['mapel'] = 'tiu';
            $input['kategori'] = $request->kategori;
            $soal =  SoalCatSkd::create($input);

            foreach ($request->jawaban as $k => $v) {

                if (empty($v)) {
                    $v = '-';
                }

                $dataJawaban['soal_id'] = $soal->id;
                $dataJawaban['pilihan'] = $k;
                $dataJawaban['jawaban'] = $v;
                $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i' ? 'Y' : 'N';
                $soalPilihanGanda = SoalPilihanCatSkd::create($dataJawaban);

                if ($request->jawaban_benar == $k) {
                    $soal->update([
                        'jawaban_id' => $soalPilihanGanda->id,
                    ]);
                }
            }

            // $mapel['created_by'] = auth()->user()->id;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            toastr()->error($e->getMessage(), 'Error');

            return back();
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e->getMessage());
            toastr()->error($e->getMessage(), 'Error');
            throw $e;
        }

        DB::commit();
        toastr()->success('Data telah ditambahkan', 'Berhasil');
        return redirect(action('SoalCatSkdController@tiu', [$request->kategori]));
    }

    public function upload(Request $request)
    {
        $soal = new SoalCatSkd();
        $soal->id  = 0;
        $soal->exists = true;
        $image  = $soal->addMediaFromRequest('upload')->toMediaCollection('images');
        // dd($image);
        return response()->json([
            'url' => $image->getUrl()
        ]);
    }


}
