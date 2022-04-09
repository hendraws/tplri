<?php

namespace App\Http\Controllers;

use App\Models\RefOption;
use App\Models\Kecerdasan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KecerdasanPilihanJawaban;

class KecerdasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecerdasan = Kecerdasan::with('getPilihan')->orderBy('id','desc' )->get();
        return view('admin.kecerdasan.index', compact('kecerdasan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = RefOption::where('modul', 'kategori-kecermatan')->pluck('option', 'id');

        return view('admin.kecerdasan.create', compact('kategori'));
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

            $input['pertanyaan'] = $request->pertanyaan;
            $input['jawaban_id'] = 0;
            $input['kategori'] = $request->kategori;
            $input['created_by'] = auth()->user()->id;
            $soal =  Kecerdasan::create($input);


            foreach ($request->jawaban as $k => $v) {


                if(empty($v)){
                    $v = '-';
                }

                $dataJawaban['kecerdasan_id'] = $soal->id;
                $dataJawaban['pilihan'] = $k;
                $dataJawaban['jawaban'] = $v;
                $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i' ? 'Y' : 'N';
                $soalPilihanGanda = KecerdasanPilihanJawaban::create($dataJawaban);

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
        return redirect(action('KecerdasanController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecerdasan  $kecerdasan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecerdasan $kecerdasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecerdasan  $kecerdasan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecerdasan $kecerdasan)
    {
        $kategori = RefOption::where('modul', 'kategori-kecermatan')->pluck('option', 'id');

        return view('admin.kecerdasan.edit', compact('kategori', 'kecerdasan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecerdasan  $kecerdasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecerdasan $kecerdasan)
    {
        DB::beginTransaction();
        try {
            $input['pertanyaan'] = $request->pertanyaan;
            $input['kategori'] = $request->kategori;
            $input['created_by'] = auth()->user()->id;
            $kecerdasan->update($input);

            foreach ($request->jawaban as $k => $v) {

                $dataJawaban['jawaban'] = $v;
                $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i' ? 'Y' : 'N';
                $soalPilihanGanda = KecerdasanPilihanJawaban::where('kecerdasan_id', $kecerdasan->id)->where('pilihan',$k)->first();
                $soalPilihanGanda->update($dataJawaban);
                if ($request->jawaban_benar == $k) {
                    $kecerdasan->update([
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
        return redirect(action('KecerdasanController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecerdasan  $kecerdasan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $kecerdasan = Kecerdasan::where('id',$id)->first();
        $kecerdasan->delete();
        $kecerdasan->getPilihan()->delete();
        $result['code'] = '200';
        return response()->json($result);
    }


    public function upload(Request $request)
    {
        $kecerdasan = new Kecerdasan();
        $kecerdasan->id  = 0;
        $kecerdasan->exists = true;
        $image  = $kecerdasan->addMediaFromRequest('upload')->toMediaCollection('images');
        // dd($image);
        return response()->json([
            'url' => $image->getUrl()
        ]);
    }

}
