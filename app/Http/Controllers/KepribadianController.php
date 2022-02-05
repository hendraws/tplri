<?php

namespace App\Http\Controllers;

use App\Models\Kepribadian;
use App\Models\KepribadianPilihanJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepribadianController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kepribadian  $kepribadian
     * @return \Illuminate\Http\Response
     */
    public function show(Kepribadian $kepribadian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kepribadian  $kepribadian
     * @return \Illuminate\Http\Response
     */
    public function edit(Kepribadian $kepribadian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kepribadian  $kepribadian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kepribadian $kepribadian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kepribadian  $kepribadian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kepribadian $kepribadian)
    {
        //
    }

    // sesi 1
    public function sesi1()
    {
        $kepribadian = Kepribadian::where('sesi', 1)->get();

        return view('admin.kepribadian_sesi1.index', compact('kepribadian'));
    }

    public function create_sesi1()
    {
        return view('admin.kepribadian_sesi1.create');
    }

    public function store_sesi1(Request $request)
    {
        DB::beginTransaction();
        try {

            $input['pertanyaan'] = $request->pertanyaan;
            $input['jenis'] = $request->jenis_soal;
            $input['sesi'] = 1;
            $input['created_by'] = auth()->user()->id;
            $soal =  Kepribadian::create($input);

            foreach ($request->jawaban as $key => $value) {
                KepribadianPilihanJawaban::create([
                    'sesi' => 1,
                    'kepribadian_id' => $soal->id,
                    'pilihan' => $key,
                    'jawaban' => $value['jawaban'],
                    'bobot' => $value['bobot'],
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
        return redirect(action('KepribadianController@sesi1'));
        dd($request);
    }

    public function edit_sesi1(Kepribadian $kepribadian)
    {
        return view('admin.kepribadian_sesi1.edit', compact('kepribadian'));
    }

    public function update_sesi1(Request $request, Kepribadian $kepribadian)
    {
        DB::beginTransaction();
        try {

            $input['pertanyaan'] = $request->pertanyaan;
            $input['jenis'] = $request->jenis_soal;
            $input['sesi'] = 1;
            $input['updated_by'] = auth()->user()->id;

            $kepribadian->update($input);

            foreach ($request->jawaban as $key => $value) {

                KepribadianPilihanJawaban::where('kepribadian_id', $kepribadian->id)
                ->where('pilihan', $key)
                ->update([
                    'jawaban' => $value['jawaban'],
                    'bobot' => $value['bobot'],
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
        return redirect(action('KepribadianController@sesi1'));
        dd($request);
    }


    public function destroy_sesi1($id)
    {
        $data = Kepribadian::where('id',$id)->first();
        $data->delete();
        KepribadianPilihanJawaban::where('kepribadian_id',$id)->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }


    // -------------------------------------------------------------------------------------------------------------

    public function sesi2()
    {
        $kepribadian = Kepribadian::where('sesi', 2)->get();
        return view('admin.kepribadian_sesi2.index', compact('kepribadian'));
    }

    public function create_sesi2()
    {
        return view('admin.kepribadian_sesi2.create');
    }

    public function store_sesi2(Request $request)
    {
        DB::beginTransaction();
        try {
            $input['pertanyaan'] = $request->pertanyaan;
            $input['sesi'] = 2;
            $input['created_by'] = auth()->user()->id;
            $soal =  Kepribadian::create($input);

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
        return redirect(action('KepribadianController@sesi2'));
        dd($request);
    }

    public function edit_sesi2(Kepribadian $kepribadian)
    {
        return view('admin.kepribadian_sesi2.edit', compact('kepribadian'));
    }

    public function update_sesi2(Request $request, Kepribadian $kepribadian)
    {
        DB::beginTransaction();
        try {
            $input['pertanyaan'] = $request->pertanyaan;
            $input['updated_by'] = auth()->user()->id;

            $kepribadian->update($input);

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
        return redirect(action('KepribadianController@sesi2'));
    }

    public function destroy_sesi2($id)
    {

        $data = Kepribadian::where('id',$id)->first();
        $data->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
