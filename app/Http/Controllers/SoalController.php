<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\RefOption;
use App\Models\Texteditor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\SoalPilihanGanda;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $mapel, $jabatan)
    {
        $data = Soal::where('mapel', $mapel)->where('jabatan', $jabatan)->orderBy('id', 'desc')->get();
        $mataPelajaran = RefOption::where('key', $mapel)->first();
        return view('admin.soal.index', compact('data', 'mataPelajaran', 'jabatan', 'mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $mapel, $jabatan)
    {
        $mataPelajaran = RefOption::where('key', $mapel)->first();
        return view('admin.soal.create', compact('mapel', 'jabatan', 'mataPelajaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            // dd($contentSoal,  $request->mapel_id);
            $input['pertanyaan'] = $request->pertanyaan;
            $input['jawaban_id'] = 0;
            $input['mapel'] = $request->mapel;
            $input['jabatan'] = $request->jabatan;
            $soal =  Soal::create($input);

            foreach ($request->jawaban as $k => $v) {

                if (empty($v)) {
                    $v = '-';
                }

                $dataJawaban['soal_id'] = $soal->id;
                $dataJawaban['pilihan'] = $k;
                $dataJawaban['jawaban'] = $v;
                $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i' ? 'Y' : 'N';
                $soalPilihanGanda = SoalPilihanGanda::create($dataJawaban);

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
        return redirect(action('SoalController@index', [$request->mapel, $request->jabatan]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $mapel = MataPelajaran::find($id);
        if ($request->ajax()) {
            $data = Soal::where('mata_pelajaran_id', $id)->get();
            return view('admin.soal.soal_table', compact('data'));
        }
        return view('admin.soal.soal_index', compact('mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $mapel, $jabatan, $id)
    {
        $mataPelajaran = RefOption::where('key', $mapel)->first();
        $data = Soal::findOrFail($id);
        // $mapel = MataPelajaran::find($soal->mata_pelajaran_id);
        return view('admin.soal.edit', compact('data', 'jabatan', 'mapel', 'mataPelajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mapel, $jabatan, $id)
    {

        DB::beginTransaction();
        try {
            $soal = Soal::where('id', $id)->first();
            $input['pertanyaan'] = $request->pertanyaan;
            $soal->update($input);

            foreach ($request->jawaban as $k => $v) {


                $dataJawaban['jawaban'] = $v;
                $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i' ? 'Y' : 'N';
                $soalPilihanGanda = SoalPilihanGanda::where('soal_id', $soal->id)->where('pilihan', $k)->first();
                $soalPilihanGanda->update($dataJawaban);
                if ($request->jawaban_benar == $k) {
                    $soal->update([
                        'jawaban_id' => $soalPilihanGanda->id,
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($e->getMessage(), 'Error');

            return back();
        } catch (\Throwable $e) {
            DB::rollback();

            toastr()->error($e->getMessage(), 'Error');
            throw $e;
        }

        DB::commit();
        toastr()->success('Data telah diubah', 'Berhasil');
        return redirect(action('SoalController@index', [$mapel, $jabatan]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // $contentSoal = $soal->pertanyaan;
            // $contents = new \DomDocument();
            // $contents->loadHtml($contentSoal, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            // $imageFileSoal = $contents->getElementsByTagName('img');

            // foreach ($imageFileSoal as $k => $img) {
            //     $dataSoal = $img->getAttribute('src');

            //     if (File::exists(public_path($dataSoal))) {
            //         File::delete(public_path($dataSoal));
            //     }
            // }
            // // dd($soal);
            // foreach ($soal->getJawaban as $k => $v) {

            //     $contentjawaban = $v->jawaban;
            //     $dom = new \DomDocument();
            //     $dom->loadHtml($contentjawaban, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //     $imageFile = $dom->getElementsByTagName('img');


            //     foreach ($imageFile as $item => $image) {
            //         $data = $image->getAttribute('src');
            //         if (File::exists(public_path($data))) {
            //             File::delete(public_path($data));
            //         }
            //     }
            //     SoalPilihanGanda::where('id', $v->id)->delete();
            //     // dd($v->deleted());
            //     // $v->deleted();
            // }
            // $soal->delete();

            $soal = Soal::where('id', $id)->first();
            $soal->delete();
            $soal->getPilihan()->delete();
            $result['code'] = '200';
            return response()->json($result);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($e->getMessage(), 'Error');
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error($e->getMessage(), 'Error');
            throw $e;
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        DB::commit();
        $result['code'] = '200';
        return response()->json($result);
    }

    public function listMapel(Request $request)
    {

        $data = MataPelajaran::get();

        return view('admin.soal.index', compact('data'));
    }

    public function upload(Request $request)
    {
        $soal = new Soal();
        $soal->id  = 0;
        $soal->exists = true;
        $image  = $soal->addMediaFromRequest('upload')->toMediaCollection('images');
        // dd($image);
        return response()->json([
            'url' => $image->getUrl()
        ]);
    }

    public function duplikasi(Request $request)
    {

        DB::beginTransaction();
        try {
            $soal = Soal::where('id', $request->id)->first();

            $jabatan = $request->jabatan == 'akpol' ? 'bintara' : 'akpol';

            $input['pertanyaan'] = $soal->pertanyaan;
            $input['jawaban_id'] = 0;
            $input['mapel'] = $request->mapel;
            $input['jabatan'] = $jabatan;
            $input['duplicate'] = 'Y';

            $soalDuplikasi =  Soal::create($input);
            foreach ($soal->getPilihan as $k => $v) {

                $dataJawaban['soal_id'] = $soalDuplikasi->id;
                $dataJawaban['pilihan'] = $v->pilihan;
                $dataJawaban['jawaban'] = $v->jawaban;
                $dataJawaban['benar'] = $v->benar;
                $soalPilihanGanda = SoalPilihanGanda::create($dataJawaban);

                if ($v->benar == 'Y') {
                    $soalDuplikasi->update([
                        'jawaban_id' => $soalPilihanGanda->id,
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($e->getMessage(), 'Error');
            dd($e->getMessage());
            return back();
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e->getMessage());

            toastr()->error($e->getMessage(), 'Error');
            throw $e;
        }

        DB::commit();
        $result['code'] = '200';
        return response()->json($result);
    }

    public function duplicateMtk()
    {
        DB::beginTransaction();
        try {
            $soalMtk = Soal::where('mapel', 'mtk')->where('jabatan', 'akpol')->where('duplicate', 'N')->take(150)->get();

            foreach ($soalMtk as $soal) {
                $soal->update(['duplicate' => 'Y']);
                $input['pertanyaan'] = $soal->pertanyaan;
                $input['jawaban_id'] = 0;
                $input['mapel'] = 'mtk';
                $input['jabatan'] = 'bintara';
                $input['duplicate'] = 'Y';

                $soalDuplikasi =  Soal::create($input);
                foreach ($soal->getPilihan as $k => $v) {

                    $dataJawaban['soal_id'] = $soalDuplikasi->id;
                    $dataJawaban['pilihan'] = $v->pilihan;
                    $dataJawaban['jawaban'] = $v->jawaban;
                    $dataJawaban['benar'] = $v->benar;
                    $soalPilihanGanda = SoalPilihanGanda::create($dataJawaban);

                    if ($v->benar == 'Y') {
                        $soalDuplikasi->update([
                            'jawaban_id' => $soalPilihanGanda->id,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return back();
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e->getMessage());

            toastr()->error($e->getMessage(), 'Error');
            throw $e;
        }

        DB::commit();

        $result['code'] = '200';
        $result['code2'] = 'berhasil dulpicate '.$soalMtk->count().'soal';
        return response()->json($result);
    }
}
