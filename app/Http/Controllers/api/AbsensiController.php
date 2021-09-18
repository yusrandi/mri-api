<?php

namespace App\Http\Controllers\api;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AbsensiController extends Controller
{
    
    public function index()
    {
        //
        $data = Absensi::with('pegawai')->latest()->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'absensi' => $data,
            ], 201);
    }
    
    public function store(Request $request)
    {
       
        $id = $request->id;
        $status = $request->status;
        $pegawaiId = $request->pegawaiId;
        $tanggal = $request->tanggal;
        $foto = $request->modal;
        $image = $request->image;

        $imageName = $request->foto;

        if (!empty($image)) {
            $image->store('public/absensi_photo');
            $imageName = $request->image->hashName();
        }
        
        $data = [
                    'pegawai_id' => $pegawaiId,
                    'foto' => $imageName,
                    'tanggal' => $tanggal,
                    'status' => $status,
        ];
        
        $save = $id  == 0 ? Absensi::create($data) : Absensi::find($id)->update($data) ;
        
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

    
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

   
    public function destroy(Absensi $absensi)
    {
        //
    }
}
