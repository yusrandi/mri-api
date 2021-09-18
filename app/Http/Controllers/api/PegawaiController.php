<?php

namespace App\Http\Controllers\api;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class PegawaiController extends Controller
{
    
    public function index()
    {
        //
         return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Data Ditemukan',
                'pegawai' => Pegawai::orderby('nama', 'ASC')->get()
        ], 201);
    }

    
    public function store(Request $request)
    {
        $save = Pegawai::create([
            'kategori_pegawai' => $request->kategori,
            'nama' => $request->nama,
            'hp' => $request->hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($save) {
                return response()->json([
                    'responsecode' => '1',
                    'responsemsg' => 'Created!',
                    
                ], 201);

            } else {
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Data Gagal Ditambahkan',
                ], 204);
        }

    }

    public function show(Pegawai $pegawai)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $data = Pegawai::find($id);

        $request->password  == "" ? $password = $data['password'] = $data->password: $password = Hash::make($request->password) ;

        $update = $data->update([
            'kategori_pegawai' => $request->kategori,
            'nama' => $request->nama,
            'hp' => $request->hp,
            'email' => $request->email,
            'password' => $password,
        ]);
        if ($update) {
                return response()->json([
                    'responsecode' => '1',
                    'responsemsg' => 'Updated!',
                ], 201);

            } else {
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Data Gagal Diubah',
                ], 204);
        }
    }

    public function destroy($id)
    {
        //
        $delete = Pegawai::find($id)->delete();
        if ($delete) {
                return response()->json([
                    'responsecode' => '1',
                    'responsemsg' => 'Deleted!',
                ], 201);
            } else {
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Data Gagal Dihapus',
                ], 204);
        }
    }
}
