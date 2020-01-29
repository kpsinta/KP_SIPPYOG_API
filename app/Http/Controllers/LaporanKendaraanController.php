<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\TransaksiTransformer;

class LaporanKendaraanController extends RestController
{
    protected $transformer = TransaksiTransformer::class;

    public function showTransaksiAll_Harian($waktu_transaksi){
       $transaksi = Transaksi::whereDate('waktu_transaksi',$waktu_transaksi)->get();
        $response = $this->generateCollection($transaksi);
        return $this->sendResponse($response);
    }
    public function showTransaksiAll_Bulanan($waktu_transaksi){
        $year = explode('-',$waktu_transaksi)[0];
        $month = explode('-',$waktu_transaksi)[1];
        $transaksi = Transaksi::whereMonth('waktu_transaksi',$month)->whereYear('waktu_transaksi',$year)->get();
         $response = $this->generateCollection($transaksi);
         return $this->sendResponse($response);
     }
     public function showTransaksiAll_Tahunan($waktu_transaksi){
        $transaksi = Transaksi::whereYear('waktu_transaksi',$waktu_transaksi)->get();
         $response = $this->generateCollection($transaksi);
         return $this->sendResponse($response);
     }
}
