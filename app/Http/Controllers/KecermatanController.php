<?php

namespace App\Http\Controllers;

use App\Models\Kecermatan;
use Illuminate\Http\Request;
use App\Imports\KecerdasanImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KecermatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecermatan = Kecermatan::orderBy('id','desc' )->get();
        // $kecermatan = Kecermatan::orderBy(DB::raw('RAND()'))->get();
        return view('admin.kecermatan.index', compact('kecermatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kecermatan.create');
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
            $request['created_by'] = auth()->user()->id;

            Kecermatan::create($request->all());

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
        return redirect(action('KecermatanController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecermatan  $kecermatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecermatan $kecermatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecermatan  $kecermatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecermatan $kecermatan)
    {
        dd($kecermatan);
        return view('admin.kecermatan.edit', compact('kecermatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecermatan  $kecermatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecermatan $kecermatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecermatan  $kecermatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecermatan $kecermatan)
    {

        $kecermatan->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }


    public function import()
    {
         return view('admin.kecermatan.import');
    }

    public function saveImport(Request $request)
    {
        Excel::import(new KecerdasanImport(), $request->file('import_file'));
        return 'success';
    }
}
