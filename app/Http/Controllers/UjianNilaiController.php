<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianNilaiController extends Controller
{

    public function index()
    {
        $data = Ujian::get();

        return view('admin.nilai.index', compact('data'));
    }
}
