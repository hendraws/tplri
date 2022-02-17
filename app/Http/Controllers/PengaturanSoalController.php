<?php

namespace App\Http\Controllers;

use App\Models\RefOption;
use Illuminate\Http\Request;
use App\Models\PengaturanSoal;
use Illuminate\Support\Facades\DB;

class PengaturanSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PengaturanSoal::get();
        return view('admin.pengaturan_soal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getCategory = PengaturanSoal::pluck('kategori');
        $kategori = RefOption::where('modul','kategori-kecermatan')->whereNotIn('key', $getCategory)->pluck('option','key');

        return view('admin.pengaturan_soal.create', compact('kategori'));
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
            // $request['created_by'] = auth()->user()->id;


            PengaturanSoal::updateOrcreate(['kategori'=>$request->kategori],['jumlah_soal'=>$request->jumlah_soal]);

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
        return redirect(action('PengaturanSoalController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengaturanSoal  $pengaturanSoal
     * @return \Illuminate\Http\Response
     */
    public function show(PengaturanSoal $pengaturanSoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengaturanSoal  $pengaturanSoal
     * @return \Illuminate\Http\Response
     */
    public function edit(PengaturanSoal $pengaturanSoal)
    {

        $kategori = RefOption::where('modul','kategori-kecermatan')->pluck('option','key');

        return view('admin.pengaturan_soal.edit', compact('kategori','pengaturanSoal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengaturanSoal  $pengaturanSoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengaturanSoal $pengaturanSoal)
    {
        DB::beginTransaction();
        try {
            // $request['created_by'] = auth()->user()->id;
            // dd($pengaturanSoal,$request);
            PengaturanSoal::updateOrcreate(['kategori'=>$request->kategori],['jumlah_soal'=>$request->jumlah_soal]);


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
        return redirect(action('PengaturanSoalController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengaturanSoal  $pengaturanSoal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $data = PengaturanSoal::where('id',$id)->first();
        $data->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
