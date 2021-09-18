<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
   
    public function index()
    {
        //
        $sumOfPengeluaran = Pengeluaran::all()->sum('jumlah');
        
        $data = Transaksi::with('detail_transaksis')->latest()->get();
        return response()->json([
                    'responsecode' => '1',
                    'responsemsg' => 'Success',
                    'pengeluaran' => $sumOfPengeluaran,
                    'transaksi' => $data,
                ], 201);
    }
    public function indexByDate(Request $request)
    {
        //
        $sumOfPengeluaran = Pengeluaran::all()->sum('jumlah');

        $startDate = date($request->startDate);
        $endDate = date($request->endDate);
         
        $data = Transaksi::with('detail_transaksis')
        ->WhereBetween('tanggal', [$startDate, $endDate])
        ->latest()->get();
        
         return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Data Has Found',
                'pengeluaran' => $sumOfPengeluaran,
                'transaksi' => $data,
                
                // ->groupBy('spk_no')
        ], 201);

    }



   
    public function store(Request $request)
    {
        //
        $todayDate = now()->format('Y/m/d');
        $kode = $this->quickRandom();

        $qty = $request->qty;
        $produk_id = explode(',', $request->produk_id);

        $transaksi = Transaksi::create([
            'kode_transaksi' => $kode,
            'tanggal' => $todayDate,
            'total' => $request->total
        ]);
        foreach (explode(',', $qty) as $key => $value) {
            $detailTransaksi = DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk_id[$key],
                'qty' => $value 
            ]) ;
        }
        if ($transaksi) {
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

   
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

   
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public static function quickRandom()
    {
        $length = 10;

        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
