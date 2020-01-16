<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\TransaksiTransformer;
class TransaksiController extends RestController
{
    protected $transformer = TransaksiTransformer::class;
    
     ////menampilkan data
     public function show(){
        $transaksi = Transaksi::all();
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
            'waktu_transaksi' => 'required',
            'total_transaksi' => 'required',
        ]); 
        // //find dia tipe kendaraan apa, nanti dia bayar sesuai itu.  
        // try{
        //     $shift = new Shift;
        //     $shift->nama_shift = $request->nama_shift;
        //     $shift->jam_masuk = $`request->jam_masuk;
        //     $shift->jam_keluar = $request->jam_keluar;
            
        //     $shift->save();
            
        //     $response = $this->generateItem($shift);

        //     return $this->sendResponse($response,201);
        // }catch(\Exception $e){
        //     return $this->sendIseResponse($e->getMessage());
        // }
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
