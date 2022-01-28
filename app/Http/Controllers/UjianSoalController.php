<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Ujian;
use App\Models\UjianSoal;
use Illuminate\Http\Request;
use App\Models\UjianMataPelajaran;
use Illuminate\Support\Facades\DB;

class UjianSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $ujianMapel = UjianMataPelajaran::find($request->ujianmapel);
        if ($request->ajax()) {

            $data = UjianSoal::join('soals', 'ujian_soals.soal_id', 'soals.id')
                ->leftjoin('soal_pilihan_gandas', 'soals.jawaban_benar', 'soal_pilihan_gandas.id')
                ->select('ujian_soals.*', 'soals.*', 'soal_pilihan_gandas.*', 'ujian_soals.id as id', 'ujian_soals.soal_id as soal_id',)
                ->where('ujian_mata_pelajaran_id', $request->ujianmapel)
                ->paginate(10)
                ->withQueryString();
            return view('admin.ujian_soal.table', compact('ujianMapel', 'data'));
        }

        return view('admin.ujian_soal.index', compact('ujianMapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ujianMapel = UjianMataPelajaran::find($request->ujian);
        $listSoal = UjianSoal::where('ujian_mata_pelajaran_id', $ujianMapel->id)->pluck('soal_id');

        $data = Soal::leftJoin('soal_pilihan_gandas', 'soals.jawaban_benar', 'soal_pilihan_gandas.id')
            ->where('mata_pelajaran_id', $ujianMapel->mata_pelajaran_id)
            ->select('soals.*', 'soal_pilihan_gandas.*', 'soals.id as id')
            ->whereNotIn('soals.id', $listSoal)
            ->paginate(10)
            ->withQueryString();

        return view('admin.ujian_soal.create', compact('ujianMapel', 'data'));
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
            $ujianSoal = [];
            $now = now()->toDateTimeString();
            foreach($request->soal_id as $item){
                $ujianSoal[] = [
                    'ujian_mata_pelajaran_id' => $request->ujian_mapel_id,
                    'soal_id' => $item,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }


            UjianSoal::insert($ujianSoal);
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
        toastr()->success('Data telah ditambahkan', 'Berhasil');
        return redirect(action('UjianSoalController@index', '?ujianmapel='.$request->ujian_mapel_id));

        dd($ujianMapel, $request->ujian_mapel_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UjianSoal  $ujianSoal
     * @return \Illuminate\Http\Response
     */
    public function show(UjianSoal $ujianSoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UjianSoal  $ujianSoal
     * @return \Illuminate\Http\Response
     */
    public function edit(UjianSoal $ujianSoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UjianSoal  $ujianSoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UjianSoal $ujianSoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UjianSoal  $ujianSoal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ujianSoal = UjianSoal::find($id);
        $ujianSoal->delete();

        $result['code'] = '200';
        return response()->json($result);
    }
}
