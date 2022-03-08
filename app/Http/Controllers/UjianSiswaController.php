<?php

namespace App\Http\Controllers;

use App\Models\Kecerdasan;
use App\Models\Ujian;
use App\Models\UjianNilai;
use App\Models\UjianSiswa;
use App\Models\Kepribadian;
use App\Models\PengaturanSoal;
use App\Models\UjianKecermatan;
use App\Models\UjianSiswaJawabanKecerdasan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UjianSiswaJawaban;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\UjianSiswaJawabanKecermatan;
use App\Models\UjianSiswaJawabanKepribadian;
use App\Models\Kecermatan;

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

        // return view('ujian.kecermatan', compact('ujian', 'ujianSiswa'))->with('ujian_siswa_id', $ujianSiswa->id);
        return view('siswa.ruang_ujian.index', compact('ujianSiswa', 'ujian'));
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
            $ujianSiswa =  UjianSiswa::find($request->ujianSiswaId);

            $nilai = UjianNilai::updateOrCreate(
                ['ujian_siswa_id'=> $ujianSiswa->id],
                ['kecerdasan'=> $ujianSiswa->jawabanBenarKecerdasan->count() ]);


            $ujianSiswa->update([
                'kecerdasan' => 1
            ]);

            $ujian = Ujian::find($ujianSiswa->ujian_id);

            return view('siswa.ruang_ujian.index', compact('ujian', 'ujianSiswa'));
        }

        if ($request->ajax()) {
            try {

                if($request->jb == $request->jawaban){
                    $benar = 1;
                }else{
                    $benar = 0;
                }

                UjianSiswaJawabanKecerdasan::updateOrCreate(
                    [
                        'ujian_siswa_id' => $request->ujianSiswaId,
                        'soal_id' => $request->noSoal,
                    ],
                    [
                        'kategori' => 1,
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

    }


    public function ujianKecerdasan(Request $request)
    {
        $ujian = Ujian::find($request->ujian_id);
        $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);

        $jawabanSiswa = UjianSiswaJawabanKecerdasan::where('ujian_siswa_id', $request->ujian_siswa_id)->get();

        if($jawabanSiswa->count() > 0){
            $jawabanSiswa->each->delete();
        }

        $pengaturanSoal = PengaturanSoal::get();
        $soalKecerdasan = null;
        // dd($pengaturanSoal);
        foreach($pengaturanSoal as $value){
            $soal = Kecerdasan::where('kategori', $value->kategori)->orderByRaw('RAND()')->take($value->jumlah_soal)->get();

            if(empty($soalKecerdasan)){
                $soalKecerdasan = $soal;
            }else{
                $soalKecerdasan = $soalKecerdasan->merge($soal);
            }
        }

        return view('ujian.kecerdasan', compact('ujian', 'ujianSiswa','soalKecerdasan'));
    }

    public function ujianKecermatan(Request $request)
    {
        $ujian = Ujian::find($request->ujian_id);
        $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);
        $soalKecermatan = Kecermatan::where('kategori', $ujian->kategori_kecermatan)->orderByRaw('RAND()')->take(10)->get();
        return view('ujian.kecermatan', compact('ujian', 'ujianSiswa','soalKecermatan'));
    }


    public function simpanJawabanKecermatan(Request $request)
    {
        if($request->has('status')){
            $ujianSiswa =  UjianSiswa::find($request->ujianSiswaId);

            $nilai = UjianNilai::updateOrCreate(
                ['ujian_siswa_id'=> $ujianSiswa->id],
                ['kecermatan'=>$ujianSiswa->jawabanBenarKecermatan->count() * 0.2]);

            $ujianSiswa->update([
                'kecermatan' => 1
            ]);

            $ujian = Ujian::find($ujianSiswa->ujian_id);

            // return redirect(action('UjianSiswaController@hasilUjian', $ujianSiswa->id));
            // return view('ujian.hasil-ujian', compact('ujian', 'ujianSiswa', 'nilai'));
            return view('siswa.ruang_ujian.index', compact('ujian', 'ujianSiswa'));
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

    public function hasilUjian(Request $request, $id)
    {
        $data = UjianSiswa::find($id);

        return view('ujian.hasil-ujian', compact('data'));

    }

    public function riwayatUjian()
    {
        $data = UjianSiswa::where('user_id',auth()->user()->id)
                ->where('kecermatan',1)
                ->where('kecerdasan',1)
                ->where('kepribadian',1)
                ->orderBy('updated_at', 'DESC' )
                ->get();

        return view('siswa.riwayat_ujian', compact('data'));
    }

    public function ujianKepribadian(Request $request)
    {
        $ujian = Ujian::find($request->ujian_id);
        $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);
        $jawabanSiswa = UjianSiswaJawabanKepribadian::where('ujian_siswa_id', $request->ujian_siswa_id)->where('sesi','1')->get();
        if($jawabanSiswa->count() > 0){
            $jawabanSiswa->each->delete();
        }
        // dd($ujian, $ujianSiswa,$jawabanSiswa);
        $soalPositif = Kepribadian::where('sesi','1')->where('jenis','positif')->orderByRaw('RAND()')->take(25)->get();
        $soalNegatif = Kepribadian::where('sesi','1')->where('jenis','negatif')->orderByRaw('RAND()')->take(25)->get();

        $soalSesi1 = $soalPositif->merge($soalNegatif)->shuffle();
        // $soalSesi2 = Kepribadian::where('sesi','2')->orderByRaw('RAND()')->take(50)->get();

        // dd($ujianSiswa, $soalSesi1->toArray(), $soalSesi2->toArray());
        return view('ujian.kepribadian', compact('ujian', 'ujianSiswa','soalSesi1'));
    }

    public function simpanJawabanKepribadian(Request $request)
    {
        if($request->has('status')){
            $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);

            $jumlahSkor = UjianSiswaJawabanKepribadian::where('ujian_siswa_id', $request->ujian_siswa_id)->where('sesi',1)->get();
            $ujianNilai = UjianNilai::where('ujian_siswa_id',$request->ujian_siswa_id)->first();
            $nilaiAkhir = ($ujianNilai->kecerdasan / 100 * 35 ) + ($ujianNilai->kecermatan / 100 * 30 ) + ((($jumlahSkor->sum('skor') / 5) * 2) / 100 * 35 ) ;

            $nilai = UjianNilai::updateOrCreate(
                ['ujian_siswa_id'=> $request->ujian_siswa_id],
                ['kepribadian'=> ($jumlahSkor->sum('skor') / 5) * 2, 'nilai_akhir' => $nilaiAkhir]);

            $jawabanSiswa = UjianSiswaJawabanKepribadian::where('ujian_siswa_id', $request->ujian_siswa_id)->where('sesi','2')->get();
            // dd($jawabanSiswa);
            if($jawabanSiswa->count() > 0){
                $jawabanSiswa->each->delete();
            }

            $ujianSiswa->update([
                'kepribadian' => 1,
                'status_ujian' => 1
            ]);

            $ujian = Ujian::find($request->ujian_id);
            $soalSesi2 = Kepribadian::where('sesi','2')->orderByRaw('RAND()')->take(50)->get();

            return view('ujian.kepribadian_sesi_2', compact('ujian', 'ujianSiswa','soalSesi2'));
        }

        if ($request->ajax()) {
            try {

                // 'ujian_siswa_id', 'soal_id', 'jawaban', 'skor', 'sesi'

                UjianSiswaJawabanKepribadian::updateOrCreate([
                    'ujian_siswa_id' => $request->ujianSiswaId,
                    'soal_id'=>$request->noSoal],[
                    'jawaban'=>$request->jawaban,
                    'skor'=>$request->skor,
                    'sesi'=>$request->sesi,
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

    public function simpanJawabanKepribadian2(Request $request)
    {
        if($request->has('status')){
            $ujianSiswa =  UjianSiswa::find($request->ujian_siswa_id);

            return redirect(action('UjianSiswaController@hasilUjian', $ujianSiswa->id));

        }

        if ($request->ajax()) {
            try {

                // 'ujian_siswa_id', 'soal_id', 'jawaban', 'skor', 'sesi'

                UjianSiswaJawabanKepribadian::updateOrCreate([
                    'ujian_siswa_id' => $request->ujianSiswaId,
                    'soal_id'=>$request->noSoal],[
                    'jawaban'=>$request->jawaban,
                    'skor'=>$request->skor,
                    'sesi'=>$request->sesi,
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

}

