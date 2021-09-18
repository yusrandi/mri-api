<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    
    public function index()
    {
        //
        $data = Stok::orderBy('nama','ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'stok' => $data,
            ], 201);
    }

   
    public function store(Request $request)
    {
        //
        $save = Stok::create([
            'satuan' => $request->satuan,
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
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

    public function update(Request $request, $id)
    {
        //
        $update = Stok::find($id)->update([
            'satuan' => $request->satuan,
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        if ($update) {
                return response()->json([
                    'responsecode' => '1',
                    'responsemsg' => 'Updated!',
                    
                ], 201);

            } else {
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Something Wrong',
                
                ], 204);
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete = Stok::find($id)->delete();
         if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted!',
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                
            ], 204);
        }
    }
}
