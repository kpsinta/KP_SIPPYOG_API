<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\TiketTransformer;

class LaporanTiketController extends RestController
{
    protected $transformer = TiketTransformer::class;
    
    public function showByStatusTiketAll_Harian($status, $waktu_keluar)
    {
        $tiket = Tiket::whereDate('waktu_keluar',$waktu_keluar)->where('status_tiket',$status)->get();
        $response = $this->generateCollection($tiket);
        return $this->sendResponse($response);
    }
    public function showByStatusTiketAll_Bulanan($status, $waktu_keluar)
    {
        $year = explode('-',$waktu_keluar)[0];
        $month = explode('-',$waktu_keluar)[1];

        $tiket = Tiket::whereMonth('waktu_keluar',$month)->whereYear('waktu_keluar',$year)->where('status_tiket',$status)->get();
        $response = $this->generateCollection($tiket);
        return $this->sendResponse($response);
     }
     public function showByStatusTiketAll_Tahunan($status, $waktu_keluar)
     {
        $tiket = Tiket::whereYear('waktu_keluar',$waktu_keluar)->where('status_tiket',$status)->get();
        $response = $this->generateCollection($tiket);
        return $this->sendResponse($response);
     } 
}
