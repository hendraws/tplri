<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\UjianMataPelajaran;
use Illuminate\Support\Facades\DB;

class UjianMataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ujian = Ujian::findOrFail($request->ujian);
        if ($request->ajax()) {
            $data = UjianMataPelajaran::with('getMataPelajaran')->withCount('getSoal')->where('ujian_id', $request->ujian)->paginate(10);
            return view('admin.ujian_mapel.table', compact('data'));
        }
        return view('admin.ujian_mapel.index', compact('ujian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ujian = Ujian::findOrFail($request->ujian);

        $mapelUjian = UjianMataPelajaran::where('ujian_id', $request->ujian)->pluck('mata_pelajaran_id');
        $mapel = MataPelajaran::whereNotIn('id', $mapelUjian)->pluck('nama_mapel', 'id');

        if($request->has('mapel')){
            $jumlahSoal = Soal::where('mata_pelajaran_id', $request->mapel)->count();
            return response()->json($jumlahSoal);

        }

        return view('admin.ujian_mapel.create', compact('mapel', 'ujian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputUjianMapel = $request->validate([
            'ujian_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'passing_grade' => 'required',
            'jumlah_soal' => 'required',
        ]);

        DB::beginTransaction();
        try {

            UjianMataPelajaran::create($inputUjianMapel);
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
        return redirect(action('UjianMataPelajaranController@index', '?ujian='.$request->ujian_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UjianMataPelajaran  $ujianMataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(UjianMataPelajaran $ujianMataPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UjianMataPelajaran  $ujianMataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(UjianMataPelajaran $ujianMataPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UjianMataPelajaran  $ujianMataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UjianMataPelajaran $ujianMataPelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UjianMataPelajaran  $ujianMataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(UjianMataPelajaran $ujianMataPelajaran)
    {
        //
    }
}
