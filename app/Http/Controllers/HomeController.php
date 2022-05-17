<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Ujian;
use App\Models\Kecerdasan;
use App\Models\Kecermatan;
use App\Models\UjianNilai;
use App\Models\Kepribadian;
use Illuminate\Http\Request;
use App\Models\ProgramAkademik;

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

        $dataUser = User::role('siswa')->get();

        $soal = Soal::selectRaw('count(id) as jumlah, mapel')->groupBy('mapel')->get();
        // dd($soal->toArray());

        return view('admin.dashboard', compact('soal', 'dataUser'));
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
