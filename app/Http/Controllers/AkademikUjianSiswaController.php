<?php

namespace App\Http\Controllers;

use App\Models\AkademikUjianNilai;
use App\Models\Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;
use App\Models\AkademikUjianSiswa;
use App\Models\AkademikUjianSiswaJawaban;

class AkademikUjianSiswaController extends Controller
{

    public function cekToken(Request $request)
    {

        $ujian = Ujian::where('token', $request->token)
            ->where('is_active', 1)
            ->where('source', 'cat-akademik')
            ->first();


        if (empty($ujian)) {
            toastr()->error('Token Salah!, Silahkan periksa kembali atau hubungi Admin', 'Error code 404');
            return back();
        }

        if ($ujian->posisi != strtolower(optional(optional(auth()->user())->getProgramAkademik)->nama_program)) {
            toastr()->error('Token Salah!, Silahkan periksa kembali atau hubungi Admin ', 'Error code 405');
            return back();
        }


        $ujianSiswa = AkademikUjianSiswa::firstOrCreate(['token' => $request->token, 'ujian_id' => $ujian->id, 'user_id' => auth()->user()->id], []);

        if ($ujian->kategori == 'all') {
            return view('siswa.ruang_ujian.all_mapel', compact('ujianSiswa', 'ujian'));
        }


        return view('siswa.ruang_ujian.per_mapel', compact('ujianSiswa', 'ujian'));
    }

    public function halamanUjian(Request $request)
    {


        $ujian = Ujian::find($request->ujian_id);
        $ujianSiswa =  AkademikUjianSiswa::find($request->ujian_siswa_id);

        $jawabanSiswa = AkademikUjianSiswaJawaban::where('akademik_ujian_siswa_id', $request->ujian_siswa_id)->get();

        if ($jawabanSiswa->count() > 0) {
            $jawabanSiswa->each->delete();
        }

        $jumlahSoal = $request->jumlah_soal;
        $waktu = $request->waktu;
        $mapel = $request->mapel;
        $soal = Soal::where('mapel', $mapel)->where('jabatan', $ujian->posisi)->orderByRaw('RAND()')->take($jumlahSoal)->get();

        return view('ujian.akademik.halaman-ujian', compact('ujian', 'ujianSiswa', 'soal', 'waktu', 'mapel'));
    }

    public function storeJawaban(Request $request)
    {

        if ($request->has('status')) {
            $ujianSiswa =  AkademikUjianSiswa::find($request->ujianSiswaId);

            $jawabanBenar = AkademikUjianSiswaJawaban::where('akademik_ujian_siswa_id', $request->ujianSiswaId)->where('benar', '1')->where('mapel', $request->ujian_mapel)->get()->count();

            if ($request->ujian_mapel == 'mtk') {
                $nilai = $jawabanBenar * 2.5;
            } else {
                $nilai = $jawabanBenar * 2;
            }

            $nilai = AkademikUjianNilai::updateOrCreate(
                ['akademik_ujian_siswa_id' => $ujianSiswa->id],
                [$request->ujian_mapel => $nilai,]
            );

            $generateNilaiAkhir = AkademikUjianNilai::where('akademik_ujian_siswa_id', $ujianSiswa->id)->first();
            $nilaiAkhir = ($generateNilaiAkhir->mtk * 20) / 100 + ($generateNilaiAkhir->wk * 20) / 100 + ($generateNilaiAkhir->pu * 30) / 100 + ($generateNilaiAkhir->bind * 30) / 100 + ($generateNilaiAkhir->bing * 30) / 100;

            $generateNilaiAkhir->update([
                'nilai_akhir' => $nilaiAkhir
            ]);

            if ($request->ujian_mapel == 'bind' || $request->ujian_mapel == 'bing') {
                $ujianSiswa->update([
                    'bahasa' => 1,
                    'status' => 1
                ]);
            } else {
                $ujianSiswa->update([
                    $request->ujian_mapel => 1
                ]);
            }

            $ujian = Ujian::find($ujianSiswa->ujian_id);

            if($ujian != 'all'){
                return view('siswa.ruang_ujian.per_mapel', compact('ujianSiswa', 'ujian'));
            }

            return view('siswa.ruang_ujian.all_mapel', compact('ujianSiswa', 'ujian'));
        }

        if ($request->ajax()) {
            try {

                if ($request->jb == $request->jawaban) {
                    $benar = 1;
                } else {
                    $benar = 0;
                }

                AkademikUjianSiswaJawaban::updateOrCreate(
                    [
                        'akademik_ujian_siswa_id' => $request->ujianSiswaId,
                        'soal_id' => $request->noSoal,
                    ],
                    [
                        'mapel' => $request->mapel,
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
}
