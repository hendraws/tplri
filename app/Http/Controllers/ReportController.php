<?php

namespace App\Http\Controllers;

use App\Models\IkdinUjianNilai;
use App\Models\IkdinUjianSiswa;
use App\Models\Ujian;
use App\Models\UjianNilai;
use App\Models\UjianSiswa;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $data = IkdinUjianSiswa::with('getSiswa', 'getUjian','getNilai')->get();

        return view('admin.report.index', compact('data'));
    }
}
