<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Helpers\ApiFormatter;

class DataSiswaController extends Controller
{
    public function index()
    {
        $siswa = DataSiswa::all();

        if ($siswa) {
            return ApiFormatter::createApi(200, 'success', $siswa);
        }else{
            return ApiFormatter::createApi(400, 'failed');
        }
    }

    public function createToken()
    {
        return csrf_token();
    }

    public function edit(Student $student)
    {
        //
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|min:8',
                'nik' => 'required|min:3',
                'jk' => 'required',
                'tgl_lahir' => 'required',
            ]);

            $newName = '';
            if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->nama.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->move(public_path('/storage/'), $newName);
        }
            
            $request['image'] = $newName;

            $data = DataSiswa::create([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jk' => $request->jk,
                'tgl_lahir' => $request->tgl_lahir,
                'image' => $newName,
            ]);

            $siswa = DataSiswa::where('id', $data->id)->first();

            if ($siswa) {
                return ApiFormatter::createApi(200, 'success', $siswa);
            }else {
                return ApiFormatter::createApi(400, 'failed');
            }

        } catch (Exception $errors) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function show(DataSiswa $data, $id)
    {
        try {
            $dataDetail = DataSiswa::where('id', $id)->first();

            if ($dataDetail) {
                return ApiFormatter::createApi(200, 'success', $dataDetail);
            }else {
                return ApiFormatter::createApi(400, 'failed');
            }

        } catch (Exception $errors) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|min:8',
                'nik' => 'required|min:3',
                'jk' => 'required',
                'tgl_lahir' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2023',
            ]);

            if($request->file('image'))
            {
                $extension = $request->file('image')->getClientOriginalExtension();
                $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
                $request->file('image')->storeAs('cover', $newName);  
                $request['cover'] = $newName;
            }

            $data = DataSiswa::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jk' => $request->jk,
                'tgl_lahir' => $request->tgl_lahir,
                'image' => $request->image,
            ]);

            $updateSiswa = DataSiswa::where('id', $data->id)->first();

            if ($updateSiswa) {
                return ApiFormatter::createApi(200, 'success', $updateSiswa);
            }else {
                return ApiFormatter::createApi(400, 'failed');
            }

        } catch (Exception $errors) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function destroy(DataSiswa $data, $id)
    {
        try {
            $getData = DataSiswa::findOrFail($id);
            $delete = $getData->delete();

            if ($delete) {
                return ApiFormatter::createApi(200, 'success delete data!');
            }else {
                return ApiFormatter::createApi(400, 'failed');
            }
            
        } catch (Exception $errors) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }
}
