<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Ujian;
use App\Models\Kecerdasan;
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

        $soalKecerdasan = Kecerdasan::with('getKategori')->get();

        $jumlahSoalKecerdasan = $soalKecerdasan->mapToGroups(function ($item, $key) {
            return [optional($item->getKategori)->option => $item->id];
        });

        return view('admin.dashboard', compact('soalKecerdasan','jumlahSoalKecerdasan' ));
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
