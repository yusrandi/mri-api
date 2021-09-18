<?php

namespace App\Http\Controllers\api;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengeluaranController extends Controller
{
    
    public function index()
    {
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'pengeluaran' => Pengeluaran::latest()->get(),
            ], 201);
    }

    
    public function store(Request $request)
    {
        //
        $save = Pengeluaran::create([
            'kategori' => $request->kategori,
            'sumber' => $request->sumber,
            'jumlah' => $request->jumlah,
            'catatan' => $request->catatan,
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
        $update = Pengeluaran::find($id)->update([
            'kategori' => $request->kategori,
            'sumber' => $request->sumber,
            'jumlah' => $request->jumlah,
            'catatan' => $request->catatan,
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

    public function destroy($id)
    {
        //
        $delete = Pengeluaran::find($id)->delete();
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
