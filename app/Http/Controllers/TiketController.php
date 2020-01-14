<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\TiketTransformer;

class TiketController extends RestController
{
    protected $transformer = TiketTransformer::class;
    
     ////menampilkan data
     public function show(){
        $tiket = Tiket::all();
        $response = $this->generateCollection($tiket);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_tiket){
        $tiket = Tiket::find($id_tiket);
        $response = $this->generateItem($tiket);
        return $this->sendResponse($response);
    }

    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'waktu_masuk' => 'required',
            'no_plat' => 'required',
            'id_kendaraan_fk' => 'required',
        ]);   
        try{
            date_default_timezone_set('Asia/Jakarta');
            $tiket = new Tiket;

            $id = array();

            $id = Tiket::orderBy('id_tiket','DESC')->first();
            if(!$id)
            $no = 1;
            else {
                $no_str = explode('-',$id->kode_tiket);
                $no = ++$no_str[2];
            }
            $tiket->kode_tiket = 'TIK-'.date("d").date("m").date("y").'-'.$no;
            $tiket->waktu_masuk = $request->waktu_masuk;
            $tiket->waktu_keluar = null;
            $tiket->no_plat = $request->no_plat;
            $tiket->id_kendaraan_fk = $request->id_kendaraan_fk;
            $tiket->status_parkir ="Sedang Parkir";
            $tiket->status_tiket ="Ada";
            
            $tiket->save();
            
            $response = $this->generateItem($tiket);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    //update data
    //bisakah sebuah tiket diedit manual oleh petugas? harusnya sih engga~
    public function update(request $request, $id_kapasitasparkir){
      
        // try{
        //     $kapasitasparkir = KapasitasParkir::find($id_kapasitasparkir);
        //     $kapasitasparkir->jenis_kendaraan = $request->jenis_kendaraan;
        //     $kapasitasparkir->kapasitas_maksimum = $request->kapasitas_maksimum;
        //     $kapasitasparkir->biaya_parkir = $request->biaya_parkir;
            
        //     $kapasitasparkir->save();

        //     $response = $this->generateItem($kapasitasparkir);

        //     return $this->sendResponse($response,201);
        // }catch (ModelNotFoundException $e) {
        //     return $this->sendNotFoundResponse('kapasitas_kendaraan_tidak_ditemukan');
        // } catch (\Exception $e) {
        //     return $this->sendIseResponse($e->getMessage());
        // }
    }

    //hapus data
    //bisakah sebuah tiket dihapus manual oleh petugas? harusnya sih engga~
    public function delete($id_tiket){
        try{
            $tiket = Tiket::find($id_tiket);
            $tiket->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('tiket_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
