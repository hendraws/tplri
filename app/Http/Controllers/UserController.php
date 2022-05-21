<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = User::role('siswa')->orderBy('updated_at', 'DESC')->get();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create_modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $user = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_active' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user['username'] = Str::slug($request->name);
            $user['password'] = Hash::make($request->password);
            User::create($user);
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
        toastr()->success('Data telah ditambahkan', 'Berhasil');
        return redirect(action('UserController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $manajemen_pengguna)
    {

        return view('admin.user.edit_modal', compact('manajemen_pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $manajemen_pengguna)
    {
        $user = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$manajemen_pengguna->id,
            'is_active' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // $user['username'] = Str::slug($request->name);
            // $user['password'] = Hash::make($request->password);
            $manajemen_pengguna->update($user);
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
        toastr()->success('Data telah diubah', 'Berhasil');
        return redirect(action('UserController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $manajemen_pengguna)
    {

        $manajemen_pengguna->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }

    public function aktifkanAkun(User $manajemen_pengguna)
    {
        DB::beginTransaction();
        try {
            if($manajemen_pengguna->is_active == 'N'){
                $status = 'Y';
            }else{
                $status = 'N';
            }
            $manajemen_pengguna->update([
                'is_active' => $status
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        } catch (\Throwable $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        DB::commit();
        $result['code'] = '200';
    	return response()->json($result);

    }

    public function resetPassword(User $manajemen_pengguna)
    {
        DB::beginTransaction();
        try {

            $manajemen_pengguna->update(['password' => Hash::make(date('dmY',strtotime($manajemen_pengguna->tanggal_lahir)))]);

        } catch (\Exception $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        } catch (\Throwable $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        DB::commit();
        $result['code'] = '200';
    	return response()->json($result);

    }

    public function nonakfitAll()
    {

        DB::beginTransaction();
        try {

            $data = User::whereNotIn('email',['twinreborn1325@gmail.com','super-admin@mail.com'])->get();

            foreach($data as $key => $val){
                $val->update([
                    'is_active' => 'N'
                ]);

            }
        } catch (\Exception $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        } catch (\Throwable $e) {
            DB::rollback();
            $result['code'] = '500';
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        DB::commit();
        toastr()->success('Data telah dinonaktifkan', 'Berhasil');
        return redirect(action('UserController@index'));
    }
}
