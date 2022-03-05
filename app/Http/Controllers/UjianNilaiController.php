<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\UjianNilai;
use Illuminate\Http\Request;

class UjianNilaiController extends Controller
{

    public function index()
    {
        $data = UjianNilai::where('nilai_akhir','>', 0)->orderBy('created_at', 'DESC')->take(10)->get();

        return view('admin.nilai.index', compact('data'));
    }
}
