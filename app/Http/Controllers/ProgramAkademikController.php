<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramAkademik;
use Illuminate\Support\Facades\DB;

class ProgramAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProgramAkademik::paginate(50);
            return view('admin.program_akademik.table', compact('data'));
        }
        return view('admin.program_akademik.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.program_akademik.create_modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $program = $request->validate([
            'nama_program' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $program['created_by'] = auth()->user()->id;
            ProgramAkademik::create($program);
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
        return redirect(action('ProgramAkademikController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgramAkademik  $programAkademik
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramAkademik $programAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProgramAkademik  $programAkademik
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramAkademik $programAkademik)
    {
        return view('admin.program_akademik.edit_modal', compact('programAkademik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProgramAkademik  $programAkademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramAkademik $programAkademik)
    {
        $program = $request->validate([
            'nama_program' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // $program['username'] = Str::slug($request->name);
            $program['updated_by'] = auth()->user()->id;
            $programAkademik->update($program);
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
        return redirect(action('ProgramAkademikController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProgramAkademik  $programAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramAkademik $programAkademik)
    {
        $programAkademik->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
