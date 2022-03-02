<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\ProgramAkademik;
use App\Models\UjianSiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;

class SiswaController extends Controller
{
    public function updateProfile(Request $request)
    {
        // dd($request);
        $inputSiswa = $request->validate([
            "nama" => 'required',
            "tempat_lahir" => 'required',
            "tanggal_lahir" => 'required',
            "alamat" => 'required',
            "telepon" => 'required',
            "program_id" => 'required',
        ]);


        DB::beginTransaction();
        try {
            $user = auth()->user();

            // if($request->has('foto')){

            //     if(!empty($user->foto)){
            //         Storage::delete($user->foto);
            //     }

            //     $extension = $request->file('foto')->extension();
            //     $imgName = 'images/'.date('dmhHis').'-'.$user->name.'.'.$extension;
            //     $path = Storage::putFileAs('public', $request->file('foto'), $imgName);
            //     $inputSiswa['foto'] = $path;
            // }

            $user->update($inputSiswa);

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
        toastr()->success('Data telah diupdate', 'Berhasil');
        return redirect(action('HomeController@cek'));


    }

    public function editProfile(Request $request)
    {
        if($request->ajax()){
            if($request->has('program_akademik_id')){
                $kelas = Kelas::where('program_akademik_id', $request->program_akademik_id)->pluck('nama_kelas','id');
                return response()->json($kelas);
            }
        }

        $user  = auth()->user();
        $programAkademik = ProgramAkademik::pluck('nama_program', 'id');
        $kelas = Kelas::where('program_akademik_id', $user->program_id)->pluck('nama_kelas','id');
        return view('siswa.profile.edit_profile', compact('programAkademik', 'user','kelas'));
    }

    public function riwayatUjian()
    {
        $data = UjianSiswa::where('user_id',auth()->user()->id)
                ->where('kecermatan',1)
                ->get();

        return view('siswa.riwayat_ujian', compact('data'));
    }
}
