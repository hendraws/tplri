<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\UjianNilai;
use App\Models\UjianSiswa;
use Illuminate\Http\Request;

class UjianNilaiController extends Controller
{

    public function index()
    {
        $data = UjianNilai::where('nilai_akhir','>', 0)
        ->whereHas('getUjianSiswa', function($q){
                $q->where('user_id', '!=', 40);
        })
        ->orderBy('created_at', 'DESC')->take(10)->get();

        return view('admin.nilai.index', compact('data'));
    }

    public function detail($id)
    {
        $data = UjianSiswa::findOrFail($id);
        dd($data);
        return view('admin.nilai.detail', compact('data'));
    }


}
