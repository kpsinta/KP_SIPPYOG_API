<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kendaraan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\KendaraanTransformer;

class KendaraanController extends RestController
{
    //miau
    protected $transformer = KendaraanTransformer::class;
    
     ////menampilkan data
     public function show(){
        $kendaraan = Kendaraan::all();
        $response = $this->generateCollection($kendaraan);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById($id_kendaraan){
        $kendaraan = Kendaraan::find($id_kendaraan);
        $response = $this->generateItem($kendaraan);
        return $this->sendResponse($response);
    }

    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'jenis_kendaraan' => 'required',
            'kapasitas_maksimum' => 'required',
            'biaya_parkir' => 'required',
            'biaya_denda' => 'required',
        ]);   
        try{
            $kendaraan = new Kendaraan;
            $kendaraan->jenis_kendaraan = $request->jenis_kendaraan;
            $kendaraan->kapasitas_maksimum = $request->kapasitas_maksimum;
            $kendaraan->biaya_parkir = $request->biaya_parkir;
            $kendaraan->biaya_denda = $request->biaya_denda;
            
            $kendaraan->save();
            
            $response = $this->generateItem($kendaraan);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    //update data
    public function update(request $request, $id_kendaraan){
      
        try{
            $kendaraan = Kendaraan::find($id_kendaraan);
            $kendaraan->jenis_kendaraan = $request->jenis_kendaraan;
            $kendaraan->kapasitas_maksimum = $request->kapasitas_maksimum;
            $kendaraan->biaya_parkir = $request->biaya_parkir;
            $kendaraan->biaya_denda = $request->biaya_denda;
            $kendaraan->save();

            $response = $this->generateItem($kendaraan);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('kendaraan_tidak_ditemukan');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    //hapus data
    public function delete($id_kendaraan){
        try{
            $kendaraan = Kendaraan::find($id_kendaraan);
            $kendaraan->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('kendaraan_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
