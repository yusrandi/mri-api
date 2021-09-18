<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
   
    public function index()
    {
        //
        $data = Produk::orderBy('kategori_id','ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'produk' => $data,
            ], 201);
    }

    
    public function store(Request $request)
    {
                
        $id = $request->id;
        $kategoriId = $request->kategori_id;
        $nama = $request->nama;
        $harga = $request->harga;
        $modal = $request->modal;
        $image = $request->image;

        $imageName = $request->foto;

        if (!empty($image)) {
            $image->store('public/produk_photo');
            $imageName = $request->image->hashName();
        }
        
        $data = [
                    'kategori_id' => $kategoriId,
                    'foto' => $imageName,
                    'nama' => $nama,
                    'harga' => $harga,
                    'modal' => $modal,
        ];
        
        $save = $id  == 0 ? Produk::create($data) : Produk::find($id)->update($data) ;
        
        if ($save) {
                return response()->json([
                    'responsecode' => '1',
                    'responsemsg' => 'Success',
                    
                ], 201);

        } else {
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Something Wrong',
                
                ], 204);
        }
    }

   
    public function show($id)
    {
        //
         $data = Produk::where('kategori_id', $id)
         ->get();
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'produk' => $data,
            ], 201);
    }

    
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $imageName = $produk->foto;

        if (!empty($request->image)){
            $request->image->store('public/produk_photo');
            $imageName = $request->image->hashName();
        }

        $save = Produk::find($id)->update([
                // 'kategori_id' => $request->kategori_id,
                'nama' => $request->nama,
                // 'harga' => $request->harga,
                // 'modal' => $request->modal,
                'foto' => $imageName
        ]);

            if ($save) {
                return response()->json([
                    'responsecode' => '1',
                    'responsemsg' => 'Success',
                    
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
        $delete = Produk::find($id)->delete();
         if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                
            ], 204);
        }
    }
}
