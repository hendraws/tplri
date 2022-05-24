<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Ujian;
use App\Models\SoalCatSkd;
use Illuminate\Http\Request;
use App\Models\IkdinUjianNilai;
use App\Models\IkdinUjianSiswa;
use App\Models\IkdinUjianSiswaJawaban;
use Illuminate\Database\Eloquent\Collection;

class IkdinUjianSiswaController extends Controller
{

    public function cekToken(Request $request)
    {

        $ujian = Ujian::where('token', $request->token)
            ->where('is_active', 1)
            ->where('source', 'cat-ikdin')
            ->first();



        if (empty($ujian)) {
            toastr()->error('Token Salah!, Silahkan periksa kembali atau hubungi Admin', 'Error code 404');
            return back();
        }

        if ($ujian->posisi != strtolower(optional(optional(auth()->user())->getProgramAkademik)->nama_program)) {
            toastr()->error('Token Salah!, Silahkan periksa kembali atau hubungi Admin ', 'Error code 405');
            return back();
        }


        $ujianSiswa = IkdinUjianSiswa::firstOrCreate(['token' => $request->token, 'ujian_id' => $ujian->id, 'user_id' => auth()->user()->id], ['sisa_waktu'=>100]);



        return view('siswa.ruang_ujian.per_mapel', compact('ujianSiswa', 'ujian'));
    }

    public function halamanUjian(Request $request)
    {

        $ujian = Ujian::find($request->ujian_id);
        $ujianSiswa =  IkdinUjianSiswa::find($request->ujian_siswa_id);
        $soal = IkdinUjianSiswaJawaban::where('ikdin_ujian_siswa_id', $request->ujian_siswa_id)->get();

        if ($soal->count() == 0) {


            // $jawabanSiswa = IkdinUjianSiswaJawaban::where('ikdin_ujian_siswa_id', $request->ujian_siswa_id)->get();

            // if ($jawabanSiswa->count() > 0) {
            //     $jawabanSiswa->each->delete();
            // }
            $soalColl =  new Collection();

            $twk = SoalCatSkd::where('mapel', 'twk')->orderByRaw('RAND()')->take(30)->get();
            $soalColl = $soalColl->merge($twk);

            $tiuMtk = SoalCatSkd::where('mapel', 'tiu')->where('kategori', 'matematika')->orderByRaw('RAND()')->take(11)->get();
            $soalColl = $soalColl->merge($tiuMtk);

            $tiuSilogisme = SoalCatSkd::where('mapel', 'tiu')->where('kategori', 'silogisme')->orderByRaw('RAND()')->take(8)->get();
            $soalColl = $soalColl->merge($tiuSilogisme);

            $tiuSpasial = SoalCatSkd::where('mapel', 'tiu')->where('kategori', 'spasial')->orderByRaw('RAND()')->take(8)->get();
            $soalColl = $soalColl->merge($tiuSpasial);

            $tiuVerbal = SoalCatSkd::where('mapel', 'tiu')->where('kategori', 'verbal')->orderByRaw('RAND()')->take(8)->get();
            $soalColl = $soalColl->merge($tiuVerbal);

            $tkp = SoalCatSkd::where('mapel', 'tkp')->orderByRaw('RAND()')->take(45)->get();
            $soalColl = $soalColl->merge($tkp);

            foreach ($soalColl as $item) {
                IkdinUjianSiswaJawaban::create([
                    'ikdin_ujian_siswa_id' => $request->ujian_siswa_id,
                    'soal_id' => $item->id,
                    'kategori' => $item->mapel,
                ]);
            }

            $soal = IkdinUjianSiswaJawaban::where('ikdin_ujian_siswa_id', $request->ujian_siswa_id)->get();

            return view('ujian.ikdin.halaman-ujian', compact('ujian', 'ujianSiswa', 'soal'));
        }



        return view('ujian.ikdin.halaman-ujian', compact('ujian', 'ujianSiswa', 'soal'));
    }

    public function storeJawaban(Request $request)
    {

        if ($request->has('status')) {
            $ujianSiswa =  IkdinUjianSiswa::find($request->ujianSiswaId);

            $skor = IkdinUjianSiswaJawaban::where('ikdin_ujian_siswa_id', $request->ujianSiswaId)
                ->selectRaw('sum(skor) as total_skor, kategori')
                ->groupBy('kategori')
                ->pluck('total_skor', 'kategori');



            $tiu = array_key_exists("tiu", $skor->toArray()) ?  $skor['tiu'] : 0;
            $twk = array_key_exists("twk", $skor->toArray()) ?  $skor['twk'] : 0;
            $tkp = array_key_exists("tkp", $skor->toArray()) ?  $skor['tkp'] : 0;

            $nilai = IkdinUjianNilai::updateOrCreate(
                ['ikdin_ujian_siswa_id' => $ujianSiswa->id],
                [
                    'tiu' =>  $tiu,
                    'twk' =>  $twk,
                    'tkp' =>  $tkp,
                    'nilai_akhir' =>  $skor->sum(),

                ]
            );

            $ujianSiswa->update([
                'skd' => 1,
            ]);

            $ujian = Ujian::find($ujianSiswa->ujian_id);

            return view('siswa.ruang_ujian.per_mapel', compact('ujianSiswa', 'ujian'));
        }

        if ($request->ajax()) {
            try {
                $ujianSiswa =  IkdinUjianSiswa::find($request->ujianSiswaId);
                $ujianSiswa->update([
                    'sisa_waktu' => $request->sisa_waktu,
                ]);

                // dd($request->all());
                if ($request->jb == $request->jawaban) {
                    $benar = 1;
                } else {
                    $benar = 0;
                }

                IkdinUjianSiswaJawaban::updateOrCreate(
                    [
                        'ikdin_ujian_siswa_id' => $request->ujianSiswaId,
                        'soal_id' => $request->noSoal,
                    ],
                    [
                        'mapel' => $request->mapel,
                        'jawaban_id' => $request->jawaban,
                        'benar' => $benar,
                        'skor' => $request->skor,
                        'kategori' => $request->mapel
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

    public function riwayatUjian()
    {
        $data = IkdinUjianSiswa::where('user_id', auth()->user()->id)
            ->where('skd',1)
            ->orderBy('updated_at', 'DESC')
            ->take(10)->get();

        return view('siswa.riwayat_ujian', compact('data'));
    }
}
