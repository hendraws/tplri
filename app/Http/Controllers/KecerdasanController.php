<?php

namespace App\Http\Controllers;

use App\Models\Kecerdasan;
use App\Models\KecerdasanPilihanJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KecerdasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecerdasan = Kecerdasan::with('getPilihan')->get();
        return view('admin.kecerdasan.index', compact('kecerdasan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.kecerdasan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         DB::beginTransaction();
         try {

                 $contentSoal = $request->pertanyaan;

                 $contents = new \DomDocument();
                 $contents->loadHtml($contentSoal, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                 $imageFileSoal = $contents->getElementsByTagName('img');

                 foreach ($imageFileSoal as $k => $img) {
                     $dataSoal = $img->getAttribute('src');

                     list($type, $dataSoal) = explode(';', $dataSoal);
                     list(, $dataSoal)      = explode(',', $dataSoal);

                     $imgeData = base64_decode($dataSoal);
                     $image_name = "/upload/soal/" . time() . $k . '.png';
                     $path = public_path() . $image_name;
                     file_put_contents($path, $imgeData);

                     $img->removeAttribute('src');
                     $img->setAttribute('src', $image_name);
                 }

                 $contentSoal = $contents->saveHTML();

                 // dd($contentSoal,  $request->mapel_id);
                 $input['pertanyaan'] = $contentSoal;
                 $input['jawaban_id'] = 1;
                 $input['created_by'] = auth()->user()->id;
                 $soal =  Kecerdasan::create($input);

                 foreach ($request->jawaban as $k => $v) {
                     unset($dom, $contentjawaban);
                     $contentjawaban = $v;
                     $dom = new \DomDocument();
                     $dom->loadHtml($contentjawaban, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                     $imageFile = $dom->getElementsByTagName('img');


                     foreach ($imageFile as $item => $image) {
                         $data = $image->getAttribute('src');

                         list($type, $data) = explode(';', $data);
                         list(, $data)      = explode(',', $data);

                         $imgeData = base64_decode($data);
                         $image_name = "/upload/jawaban/" . $k . '-' . time() . $item . '.png';
                         $path = public_path() . $image_name;
                         file_put_contents($path, $imgeData);

                         $image->removeAttribute('src');
                         $image->setAttribute('src', $image_name);
                     }

                     $contentjawaban = $dom->saveHTML();

                     $dataJawaban['kecerdasan_id'] = $soal->id;
                     $dataJawaban['pilihan'] = $k;
                     $dataJawaban['jawaban'] = $contentjawaban;
                     $dataJawaban['benar'] = $request->jawaban_benar == $k || $request->jawaban_benar == 'i'? 'Y' : 'N';
                     $soalPilihanGanda = KecerdasanPilihanJawaban::create($dataJawaban);

                     if($request->jawaban_benar == $k){
                         $soal->update([
                             'jawaban_id' => $soalPilihanGanda->id,
                         ]);
                     }

                 }


             // $mapel['created_by'] = auth()->user()->id;
         } catch (\Exception $e) {
             DB::rollback();
             dd($e->getMessage());
             toastr()->error($e->getMessage(), 'Error');

             return back();
         } catch (\Throwable $e) {
             DB::rollback();
             dd($e->getMessage());
             toastr()->error($e->getMessage(), 'Error');
             throw $e;
         }

         DB::commit();
         toastr()->success('Data telah ditambahkan', 'Berhasil');
         return redirect(action('KecerdasanController@index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecerdasan  $kecerdasan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecerdasan $kecerdasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecerdasan  $kecerdasan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecerdasan $kecerdasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecerdasan  $kecerdasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecerdasan $kecerdasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecerdasan  $kecerdasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecerdasan $kecerdasan)
    {
        //
    }
}
