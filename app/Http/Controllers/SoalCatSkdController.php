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
        return view('admin.soal_cat_skd.tiu.index', compact('data', 'kategori'));
    }

    public function createTiu(Request $request, $kategori)
    {
        return view('admin.soal_cat_skd.tiu.create', compact('kategori'));
    }

    public function editTiu(Request $request, $kategori, $id)
    {

        $data = SoalCatSkd::findOrFail($id);

        return view('admin.soal_cat_skd.tiu.edit', compact('kategori', 'data'));
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

    public function updateTiu(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // dd($request->all(), $id);
            $soal = SoalCatSkd::where('id', $id)->first();
            $input['pertanyaan'] = $request->pertanyaan;
            $soal->update($input);

            foreach ($request->jawaban as $k => $v) {


                $dataJawaban['jawaban'] = $v;
                $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i' ? 'Y' : 'N';
                $soalPilihanGanda = SoalPilihanCatSkd::where('soal_id', $soal->id)->where('pilihan', $k)->first();
                $soalPilihanGanda->update($dataJawaban);
                if ($request->jawaban_benar == $k) {
                    $soal->update([
                        'jawaban_id' => $soalPilihanGanda->id,
                    ]);
                }
            }
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

    public function deleteTiu($id)
    {

        $soal = SoalCatSkd::where('id', $id)->first();
        $soal->delete();
        $soal->getPilihan()->delete();
        $result['code'] = '200';
        return response()->json($result);
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

    public function twk(Request $request)
    {
        $data = SoalCatSkd::where('mapel', 'twk')->get();

        return view('admin.soal_cat_skd.twk.index', compact('data'));
    }

    public function createTwk(Request $request)
    {
        return view('admin.soal_cat_skd.twk.create');
    }

    public function editTwk($id)
    {

        $data = SoalCatSkd::findOrFail($id);

        return view('admin.soal_cat_skd.twk.edit', compact('data'));
    }

    public function storeTwk(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($contentSoal,  $request->mapel_id);
            $input['pertanyaan'] = $request->pertanyaan;
            $input['jawaban_id'] = 0;
            $input['mapel'] = 'twk';
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
        return redirect(action('SoalCatSkdController@twk'));
    }

    public function updateTwk(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // dd($request->all(), $id);
            $soal = SoalCatSkd::where('id', $id)->first();
            $input['pertanyaan'] = $request->pertanyaan;
            $soal->update($input);

            foreach ($request->jawaban as $k => $v) {


                $dataJawaban['jawaban'] = $v;
                $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i' ? 'Y' : 'N';
                $soalPilihanGanda = SoalPilihanCatSkd::where('soal_id', $soal->id)->where('pilihan', $k)->first();
                $soalPilihanGanda->update($dataJawaban);
                if ($request->jawaban_benar == $k) {
                    $soal->update([
                        'jawaban_id' => $soalPilihanGanda->id,
                    ]);
                }
            }
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
        return redirect(action('SoalCatSkdController@twk'));
    }

    public function deleteTwk($id)
    {

        $soal = SoalCatSkd::where('id', $id)->first();
        $soal->delete();
        $soal->getPilihan()->delete();
        $result['code'] = '200';
        return response()->json($result);
    }


    public function tkp(Request $request)
    {
        $data = SoalCatSkd::where('mapel', 'tkp')->get();
        return view('admin.soal_cat_skd.tkp.index', compact('data'));
    }

    public function editTkp($id)
    {
        $data = SoalCatSkd::findOrFail($id);

        return view('admin.soal_cat_skd.tkp.edit', compact('data'));
    }

    public function createTkp(Request $request)
    {
        return view('admin.soal_cat_skd.tkp.create');
    }

    public function storeTkp(Request $request)
    {
        DB::beginTransaction();
        try {

            $input['pertanyaan'] = $request->pertanyaan;
            $input['mapel'] = 'tkp';
            $input['jawaban_id'] = 0;
            $input['kategori'] = $request->kategori;
            $input['created_by'] = auth()->user()->id;
            $soal =  SoalCatSkd::create($input);

            foreach ($request->jawaban as $key => $value) {
                SoalPilihanCatSkd::create([

                    'soal_id' => $soal->id,
                    'pilihan' => $key,
                    'jawaban' => $value['jawaban'],
                    'skor' => $value['bobot'],
                ]);
            }
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
        return redirect(action('SoalCatSkdController@tkp'));
    }

    public function updateTkp(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $soal = SoalCatSkd::where('id', $id)->first();
            $input['pertanyaan'] = $request->pertanyaan;
            $input['jenis'] = $request->jenis_soal;
            $input['sesi'] = 1;
            $input['updated_by'] = auth()->user()->id;

            $soal->update($input);

            foreach ($request->jawaban as $key => $value) {

                SoalPilihanCatSkd::where('soal_id', $id)
                ->where('pilihan', $key)
                ->update([
                    'jawaban' => $value['jawaban'],
                    'skor' => $value['bobot'],
                ]);
            }
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
        toastr()->success('Data telah diubah', 'Berhasil');
        return redirect(action('SoalCatSkdController@tkp'));
    }

    public function deleteTkp($id)
    {

        $soal = SoalCatSkd::where('id', $id)->first();
        $soal->delete();
        $soal->getPilihan()->delete();
        $result['code'] = '200';
        return response()->json($result);
    }

}
