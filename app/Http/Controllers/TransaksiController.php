<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Pegawai_OnDuty;
use App\Tiket;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\TransaksiTransformer;
use Carbon\Carbon;
class TransaksiController extends RestController
{
 
  
     //menampilkan data
     public function show(){
        $transaksi = Transaksi::all();
        $response = $this->generateCollection($transaksi);
        return $this->sendResponse($response);
    }
   
    public function showToday(){
        // $now = Carbon::now('Asia/Jakarta');
        // return($now);
       // $transaksi = Transaksi::whereDate('waktu_transaksi','=',$now)->get();
       $transaksi = Transaksi::whereDate('waktu_transaksi',Carbon::today())->get();
        $response = $this->generateCollection($transaksi);
        return $this->sendResponse($response);
    }
    //tampil by id
    public function showById($id_transaksi)
    {
        try {
            $transaksi=Transaksi::find($id_transaksi);
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response);
        } catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('$transaksi_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'id_tiket_fk' => 'required',
            'waktu_transaksi' => 'required',
            'total_transaksi' => 'required',
            'status_tiket' => 'required',

        ]); 
        try{

            $transaksi = new Transaksi;

            $transaksi->id_tiket_fk = $request->id_tiket_fk;
            $transaksi->waktu_transaksi = $request->waktu_transaksi;
            $transaksi->total_transaksi = $request->total_transaksi;
            
            $tiket = Tiket::find($request->id_tiket_fk);
            
            $tiket->waktu_keluar = $request->waktu_transaksi;
            $tiket->status_parkir = 'Selesai Parkir';
            $tiket->status_tiket = $request->status_tiket;
            $tiket->save();
            $transaksi->save();

            $response = $this->generateItem($transaksi);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    //update data
    //bisakah??
    public function update(request $request, $id_transaksi){
      
    }

    //hapus data
    //bisakah?
    public function delete($id_transaksi){
        try{
            $transaksi = Transaksi::find($id_transaksi);
            $transaksi->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('transaksi_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
