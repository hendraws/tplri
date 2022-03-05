<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Ujian;
use App\Models\Kecerdasan;
use App\Models\Kecermatan;
use App\Models\Kepribadian;
use Illuminate\Http\Request;
use App\Models\ProgramAkademik;
use App\Models\UjianNilai;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $soalKecerdasan = Kecerdasan::with('getKategori')->get();
        $soalKecermatan = Kecermatan::get();
        $soalKepribadianSesi1 = Kepribadian::where('sesi','1')->get();
        $soalKepribadianSesi2 = Kepribadian::where('sesi','2')->get();

        $dataUser = User::role('siswa')->get();

        $nilai = UjianNilai::where('nilai_akhir','>', 0)->orderBy('nilai_akhir', 'DESC')->take(10)->get();

        $jumlahSoalKecerdasan = $soalKecerdasan->mapToGroups(function ($item, $key) {
            return [optional($item->getKategori)->option => $item->id];
        });

        $jumlahSoalKecermatan = $soalKecermatan->mapToGroups(function ($item, $key) {
            return [$item->kategori => $item->id];
        });
        $jumlahSoalKepribadianSesi1 = $soalKepribadianSesi1->mapToGroups(function ($item, $key) {
            return [$item->jenis => $item->id];
        });

        return view('admin.dashboard', compact('soalKecerdasan','jumlahSoalKecerdasan','jumlahSoalKecermatan' ,'dataUser','jumlahSoalKepribadianSesi1','soalKepribadianSesi2','nilai'));
    }

    public function cek(Request $request)
    {
        if($request->ajax()){
            if($request->has('program_akademik_id')){
                $kelas = Kelas::where('program_akademik_id', $request->program_akademik_id)->pluck('nama_kelas','id');
                return response()->json($kelas);
            }
        }

        $user = auth()->user();
        if($user->hasRole('administrator')){

        }
        if($user->hasRole('siswa')){
            $user  = auth()->user();
            $programAkademik = ProgramAkademik::pluck('nama_program', 'id');
            return view('siswa.home', compact('programAkademik', 'user'));
        }

        return redirect()->action([HomeController::class, 'index']);
    }

    public function token()
    {
        $data = Ujian::where('is_active', 1)->get();

        return view('token', compact('data'));
    }
}
