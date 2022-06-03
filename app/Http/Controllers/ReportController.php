<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Ujian;
use App\Models\UjianNilai;
use App\Models\UjianSiswa;
use Illuminate\Http\Request;
use App\Models\IkdinUjianNilai;
use App\Models\IkdinUjianSiswa;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            if($request->data == 'judul'){
                $data = Ujian::withTrashed()->when($request->has('q'), function($q){
                    $q->where('judul','like','%'.request()->q.'%');
                })->get();
            }
            if($request->data == 'kelas'){
                $data = Kelas::when($request->has('q'), function($q){
                    $q->where('nama_kelas','like','%'.request()->q.'%');
                })->get();
            }
            return response()->json($data);
        }
        // dd($request->all(),);
        $data = IkdinUjianSiswa::with('getSiswa', 'getUjian','getNilai')
                ->when($request->filled('from') &&  $request->filled('until'), function($q){
                    $q->whereBetween('created_at',[request()->from." 00:00:00",request()->until." 23:59:59"]);
                })
                ->when($request->filled('judul_cat'), function($q){
                    $q->where('ujian_id', request()->judul_cat);
                })
                ->when($request->filled('kelas'), function($q){
                    $q->whereHas('getSiswa', function($query){
                        $query->where('kelas_id', request()->kelas);
                    });
                })
                ->orderBy('created_at', 'desc')
                ->get();
        // dd($data, request()->from , request()->until);
        return view('admin.report.index', compact('data'));
    }
}
