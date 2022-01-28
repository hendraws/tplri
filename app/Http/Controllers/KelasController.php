<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\ProgramAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::paginate(50);
            return view('admin.kelas.table', compact('data'));
        }
        return view('admin.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programAkademik = ProgramAkademik::get();
        return view('admin.kelas.create_modal', compact('programAkademik'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kls = $request->validate([
            'program_akademik_id' => 'required',
            'nama_kelas' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $kls['created_by'] = auth()->user()->id;
            Kelas::create($kls);
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
        return redirect(action('KelasController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
        $programAkademik = ProgramAkademik::get();
        return view('admin.kelas.edit_modal', compact('kela','programAkademik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        $kls = $request->validate([
            'program_akademik_id' => 'required',
            'nama_kelas' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // $kls['username'] = Str::slug($request->name);
            $kls['updated_by'] = auth()->user()->id;
            $kela->update($kls);
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
        return redirect(action('KelasController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
