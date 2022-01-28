<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MataPelajaran::paginate(50);
            return view('admin.matapelajaran.table', compact('data'));
        }
        return view('admin.matapelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.matapelajaran.create_modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mapel = $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $mapel['created_by'] = auth()->user()->id;
            MataPelajaran::create($mapel);
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
        return redirect(action('MataPelajaranController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(MataPelajaran $matapelajaran)
    {
        return view('admin.matapelajaran.edit_modal', compact('matapelajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MataPelajaran $matapelajaran)
    {
        $mapel = $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $mapel['updated_by'] = auth()->user()->id;
            $matapelajaran->update($mapel);
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
        return redirect(action('MataPelajaranController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataPelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataPelajaran $matapelajaran)
    {
        $matapelajaran->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
