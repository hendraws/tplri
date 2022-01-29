<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\UjianNilai;
use App\Models\UjianSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UjianSiswaJawaban;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\UjianSiswaJawabanKecermatan;

class UjianSiswaController extends Controller
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
     * @param  \App\Models\UjianSiswa  $ujianSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(UjianSiswa $ujianSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UjianSiswa  $ujianSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(UjianSiswa $ujianSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UjianSiswa  $ujianSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UjianSiswa $ujianSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UjianSiswa  $ujianSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(UjianSiswa $ujianSiswa)
    {
        //
    }

    public function ruangUjian(Request $request)
    {
        if ($request->session()->has('ujian_id') && $request->session()->has('ujian_siswa')) {
            $cekUjian =  UjianSiswa::find($request->session()->get('ujian_siswa'));
            $pengaturanUjian = Ujian::find($request->session()->get('ujian_id'));

            return view('siswa.ujian.data_profile', compact('pengaturanUjian', 'cekUjian'));
        };
        return view('siswa.ujian.index');
    }

    public function ujianSiswa(Request $request)
    {

        // $request->session()->put('key', 'value');
        // $request->session()->forget('key');
        // $request->session()->put('ujian', auth()->user()->id );
        // session(['key' => 'value']);

        $ujian = Ujian::where('token', $request->token)
            ->where('is_active', 1)
            ->first();

        if (empty($ujian)) {
            toastr()->error('Token Salah!, Silahkan periksa kembali atau hubungi Admin', 'Error');
            return back();
        }

        // $cekUjian = UjianSiswa::where('user_id', auth()->user()->id)->where('ujian_id', $pengaturanUjian->id)->first();

        // if (empty($cekUjian)) {
            $ujianSiswa = UjianSiswa::create([
                'user_id' => auth()->user()->id,
                'ujian_id' => $ujian->id,
            ]);
        // }

        return view('ujian.kecermatan', compact('ujian', 'ujianSiswa'))->with('ujian_siswa_id', $ujianSiswa->id);
        // return view('siswa.ruang_ujian.index', compact('pengaturanUjian', 'cekUjian'));
        // $request->session()->put('ujian_id', $pengaturanUjian->id);
        // $request->session()->put('ujian_user_id', auth()->user()->id);
        // $request->session()->put('ujian_siswa', $cekUjian->id);

        return view('siswa.ujian.data_profile', compact('pengaturanUjian', 'cekUjian'));
    }

    public function mulaiUjian(Request $request)
    {
        $ujian = Ujian::find($request->ujian);
        $ujianSiswa =  UjianSiswa::find($request->ujianSiswa);

        return view('ujian.index', compact('ujian', 'ujianSiswa'));
    }

    public function simpanJawabanKecerdasan(Request $request)
    {
        if($request->has('status')){
            $cekUjian =  UjianSiswa::find($request->ujianSiswaId);

            UjianNilai::updateOrCreate(
            ['ujian_siswa_id'=> $cekUjian->id],
            ['kecerdasan'=> $cekUjian->jawabanBenarKecerdasan->count()]);


            $cekUjian->update([
                'kecerdasan' => 1
            ]);

            $pengaturanUjian = Ujian::find($cekUjian->ujian_id);

            return view('siswa.ruang_ujian.index', compact('pengaturanUjian', 'cekUjian'));
        }

        if ($request->ajax()) {
            try {

                if($request->jb == $request->jawaban){
                    $benar = 1;
                }else{
                    $benar = 0;
                }

                UjianSiswaJawaban::updateOrCreate(
                    [
                        'ujian_siswa_id' => $request->ujianSiswaId,
                        'soal_id' => $request->noSoal,
                        'kategori' => 1
                    ],
                    [
                        'jawaban_id' => $request->jawaban,
                        'benar' => $benar,
                    ]
                );
            } catch (\Exception $e) {
                $result['code'] = '500';
                $result['message'] = $e->getMessage();
                return response()->json($result);
            } catch (\Throwable $e) {
                $result['code'] = '500';
                $result['message'] = $e->getMessage();
                return response()->json($result);
            }
            $result['code'] = '200';
            return response()->json($result);
        }
        // $ujian = Ujian::find($request->ujian_id);
        // $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);

        // $ujianSiswa->update([
        //     'waktu_berjalan' => $request->sisa_waktu,
        //     'status' => 'sedang_ujian',
        // ]);
        // $dataJawaban = [];
        // $now = now()->toDateTimeString();
        // UjianSiswaJawaban::where('ujian_siswa_id', $ujianSiswa->id)->delete();
        // foreach($request->pilihan as $soal => $jawaban){
        //     $dataJawaban[] = [
        //         'ujian_siswa_id' => $ujianSiswa->id,
        //         'soal_id' => $soal,
        //         'jawaban_id' => $jawaban,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ];
        // }
        // UjianSiswaJawaban::insert($dataJawaban);
        // dd($dataJawaban, $request->toArray(), $ujianSiswa->toArray(), $ujian->toArray());
        // return view('ujian.index', compact('ujian','ujianSiswa'));
    }
    // public function simpanData(Request $request)
    // {
    //     $ujian = Ujian::find($request->ujian_id);
    //     $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);

    //     $ujianSiswa->update([
    //         'waktu_berjalan' => $request->sisa_waktu,
    //         'status' => 'sedang_ujian',
    //     ]);
    //     $dataJawaban = [];
    //     $now = now()->toDateTimeString();
    //     UjianSiswaJawaban::where('ujian_siswa_id', $ujianSiswa->id)->delete();
    //     foreach($request->pilihan as $soal => $jawaban){
    //         $dataJawaban[] = [
    //             'ujian_siswa_id' => $ujianSiswa->id,
    //             'soal_id' => $soal,
    //             'jawaban_id' => $jawaban,
    //             'created_at' => $now,
    //             'updated_at' => $now,
    //         ];
    //     }
    //     UjianSiswaJawaban::insert($dataJawaban);
    //     dd($dataJawaban, $request->toArray(), $ujianSiswa->toArray(), $ujian->toArray());
    //     return view('ujian.index', compact('ujian','ujianSiswa'));
    // }

    public function ujianKecerdasan(Request $request)
    {
        $ujian = Ujian::find($request->ujian_id);
        $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);

        return view('ujian.kecerdasan', compact('ujian', 'ujianSiswa'));
    }

    public function ujianKecermatan(Request $request)
    {
        $ujian = Ujian::find($request->ujian_id);
        $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);

        return view('ujian.kecermatan', compact('ujian', 'ujianSiswa'));
    }


    public function simpanJawabanKecermatan(Request $request)
    {
        if($request->has('status')){
            $cekUjian =  UjianSiswa::find($request->ujianSiswaId);

            $nilai = UjianNilai::updateOrCreate(
                ['ujian_siswa_id'=> $cekUjian->id],
                ['kecermatan'=>$cekUjian->jawabanBenarKecermatan->count() * 0.2]);

            $cekUjian->update([
                'kecermatan' => 1
            ]);
            
            $pengaturanUjian = Ujian::find($cekUjian->ujian_id);

            return redirect(action('UjianSiswaController@hasilUjian', $cekUjian->id));
            return view('ujian.hasil-ujian', compact('pengaturanUjian', 'cekUjian', 'nilai'));
            // return view('siswa.ruang_ujian.index', compact('pengaturanUjian', 'cekUjian'));
        }

        if ($request->ajax()) {
            try {
                UjianSiswaJawabanKecermatan::create([
                    'ujian_siswa_id' => $request->ujianSiswaId,
                    'soal_id'=>$request->soal_id,
                    'soal_a'=>$request->soal[0],
                    'soal_b'=>$request->soal[1],
                    'soal_c'=>$request->soal[2],
                    'soal_d'=>$request->soal[3],
                    'jawaban'=>$request->jawaban,
                    'benar'=>$request->jb,
                ]);

            } catch (\Exception $e) {
                $result['code'] = '500';
                $result['message'] = $e->getMessage();
                return response()->json($result);
            } catch (\Throwable $e) {
                $result['code'] = '500';
                $result['message'] = $e->getMessage();
                return response()->json($result);
            }
            $result['code'] = '200';
            return response()->json($result);
        }

    }

    public function hasilUjian(Request $request, $nilai)
    {
        $data = UjianSiswa::find($nilai);

        return view('ujian.hasil-ujian', compact('data'));

    }
}

