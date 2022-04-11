<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Ujian;
use App\Models\Kecerdasan;
use App\Models\Kecermatan;
use App\Models\Kepribadian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ProgramAkademik;
use App\Models\UjianKecerdasan;
use App\Models\UjianKecermatan;
use App\Models\UjianKepribadian;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('ujian')) {

            $dataUjian = Ujian::where('id', $request->ujian)->first();

            if ($request->kategori == 'kecerdasan') {
                $data = Kecerdasan::get();
            }
            if ($request->kategori == 'kecermatan') {
            }
            if ($request->kategori == 'kepribadian-sesi-1') {
            }
            if ($request->kategori == 'kepribadian-sesi-2') {
            }

            return abort(404);
        }

        $data = Ujian::where('source','cat-kepribadian')->orderBy('created_at', 'desc')->get();
        return view('admin.ujian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('program_akademik_id')) {
                $kelas = Kelas::where('program_akademik_id', $request->program_akademik_id)->pluck('nama_kelas', 'id');
                return response()->json($kelas);
            }
        }
        $programAkademik = ProgramAkademik::pluck('nama_program', 'id');
        return view('admin.ujian.create', compact('programAkademik'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputUjian = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            do {
                $token = 'PRI'.strtoupper(Str::random(3));
            } while (Ujian::where('token', $token)->exists());


            $inputUjian['judul'] = $request->judul;
            $inputUjian['is_active'] = $request->is_active;
            $inputUjian['tanggal'] = date('Y-m-d');
            $inputUjian['token'] = $token;
            $inputUjian['source'] = 'cat-kepribadian';


            Ujian::create($inputUjian);
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
        return redirect(action('UjianController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function show(Ujian $pengaturan_ujian)
    {

        return view('admin.ujian.detail', compact('pengaturan_ujian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Ujian $pengaturan_ujian)
    {

        if ($request->ajax()) {
            if ($request->has('program_akademik_id')) {
                $kelas = Kelas::where('program_akademik_id', $request->program_akademik_id)->pluck('nama_kelas', 'id');
                return response()->json($kelas);
            }
        }
        $programAkademik = ProgramAkademik::pluck('nama_program', 'id');
        return view('admin.ujian.edit', compact('programAkademik', 'pengaturan_ujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ujian $pengaturan_ujian)
    {

        $inputUjian = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $inputUjian['updated_by'] = auth()->user()->id;
            $pengaturan_ujian->update($inputUjian);
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

        return redirect(action('UjianController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ujian $pengaturan_ujian)
    {

        $pengaturan_ujian->delete();
        $result['code'] = '200';
        return response()->json($result);
    }

    public function tambahSoal($kategori, $ujian)
    {

        if ($kategori == 'kecerdasan') {
            $soalTerpilih = UjianKecerdasan::where('ujian_id', $ujian)->pluck('kecerdasan_id');
            $data = Kecerdasan::whereNotIn('id', $soalTerpilih)->get();
            $ujian = Ujian::find($ujian);
            return view('admin.ujian.soal_kecerdasan', compact('data', 'ujian'));
        }
        if ($kategori == 'kecermatan') {
            $soalTerpilih = UjianKecermatan::where('ujian_id', $ujian)->pluck('kecermatan_id');
            $data = Kecermatan::whereNotIn('id', $soalTerpilih)->get();
            $ujian = Ujian::find($ujian);
            return view('admin.ujian.soal_kecermatan', compact('data', 'ujian'));
        }
        if ($kategori == 'kepribadian1') {
            $soalTerpilih = UjianKepribadian::where('ujian_id', $ujian)->where('sesi', 1)->pluck('kepribadian_id');
            $data = Kepribadian::whereNotIn('id', $soalTerpilih)->where('sesi',1)->get();
            $ujian = Ujian::find($ujian);
            return view('admin.ujian.soal_kepribadian_satu', compact('data', 'ujian'));
        }
        if ($kategori == 'kepribadian2') {
            $soalTerpilih = UjianKepribadian::where('ujian_id', $ujian)->where('sesi', 2)->pluck('kepribadian_id');
            $data = Kepribadian::whereNotIn('id', $soalTerpilih)->where('sesi',2)->get();
            $ujian = Ujian::find($ujian);
            return view('admin.ujian.soal_kepribadian_dua', compact('data', 'ujian'));
        }

        return abort(404);
    }

    public function simpanSoal(Request $request)
    {

        DB::beginTransaction();
        try {
            $ujian = Ujian::find($request->id_ujian);
            if ($request->kategori == 'kecerdasan') {
                UjianKecerdasan::create([
                    'ujian_id' => $request->id_ujian,
                    'kecerdasan_id' => $request->id_soal,
                ]);
            }
            if ($request->kategori == 'kecermatan') {
                if($ujian->getSoalKecermatan->count() < 10){
                    UjianKecermatan::create([
                        'ujian_id' => $request->id_ujian,
                        'kecermatan_id' => $request->id_soal,
                    ]);
                }else{
                    $result['code'] = '500';
                    return response()->json($result);
                }
            }
            if ($request->kategori == 'kepribadian_satu') {
                UjianKepribadian::create([
                    'ujian_id' => $request->id_ujian,
                    'kepribadian_id' => $request->id_soal,
                    'sesi' => 1,
                ]);
            }
            if ($request->kategori == 'kepribadian_dua') {
                UjianKepribadian::create([
                    'ujian_id' => $request->id_ujian,
                    'kepribadian_id' => $request->id_soal,
                    'sesi' => 2,
                ]);
            }

        } catch (\Exception $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        } catch (\Throwable $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        DB::commit();
        $result['code'] = '200';
        return response()->json($result);
    }

    public function hapusSoal(Request $request)
    {

        DB::beginTransaction();
        try {

            if ($request->kategori == 'kecerdasan') {
                UjianKecerdasan::where('ujian_id', $request->ujian_id)->where('kecerdasan_id', $request->soal_id)->delete();
            }
            if ($request->kategori == 'kecermatan') {
                UjianKecermatan::where('ujian_id', $request->ujian_id)->where('kecermatan_id', $request->soal_id)->delete();
            }
            if ($request->kategori == 'kepribadian_satu') {
                UjianKepribadian::where('ujian_id', $request->ujian_id)->where('kepribadian_id', $request->soal_id)->delete();
            }
            if ($request->kategori == 'kepribadian_dua') {
                UjianKepribadian::where('ujian_id', $request->ujian_id)->where('kepribadian_id', $request->soal_id)->delete();
            }

        } catch (\Exception $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        } catch (\Throwable $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        DB::commit();
        $result['code'] = '200';
        return response()->json($result);
    }

    public function generate($id)
    {
        DB::beginTransaction();
        try {
            $ujian = Ujian::find($id);

            do {
                $token = 'PRI'.strtoupper(Str::random(3));
            } while (Ujian::where('token', $token)->exists());

            $ujian->update([
                'token' => $token
            ]);


        } catch (\Exception $e) {
            DB::rollback();
            toastr()->warning($e->getMessage(), '?');
            return back();
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->warning($e->getMessage(), '?');
            return back();
        }

        DB::commit();
        toastr()->success('Data telah diubah', 'Berhasil');
        return back();
    }

    public function is_active(Request $request, $id){

        $status = $request->is_active == '1' ? 0 : 1;

        $ujian = Ujian::where('id',$id)->update([
            'is_active' => $status,
            'updated_by' => auth()->user()->id,
        ]);
        $result['code'] = '200';
        return response()->json($result);
    }
}
