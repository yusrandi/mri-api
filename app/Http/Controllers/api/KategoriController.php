<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    
    public function index(){
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Data Has Found',
                'kategori' => Kategori::orderby('name', 'ASC')->get()
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $save = Kategori::create(['name' => $request->name]);
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

  
    public function show(Kategori $kategori)
    {
        //

    }

    public function update(Request $request, $id)
    {
        
        $update = Kategori::find($id)->update([
            'name' => $request->name
        ]);
        if ($update) {
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
        
        $delete = Kategori::find($id)->delete();
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
