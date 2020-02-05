<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeskripsiParkir;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\DeskripsiParkirTransformer;

class DeskripsiParkirController extends RestController
{
    protected $transformer = DeskripsiParkirTransformer::class;

    //menampilkan data
    public function show(){
        $dp = DeskripsiParkir::all();
         $response = $this->generateCollection($dp);
         return $this->sendResponse($response);
    }

    //nambah data
    public function create(request $request){
        $this->validate($request,[
            'waktu_operasional' => 'required',
            'alamat_tkp' => 'required',
            'nomor_telepon' => 'required',
            'deskripsi' => 'required',
        ]);   
        try{
            $dp = new DeskripsiParkir;
            $dp->waktu_operasional = $request->waktu_operasional;
            $dp->alamat_tkp = $request->alamat_tkp;
            $dp->nomor_telepon = $request->nomor_telepon;
            $dp->deskripsi = $request->deskripsi;
            $dp->save();
            
            $response = $this->generateItem($dp);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
     //update data
     public function update(request $request, $id){
        try{
            $dp = DeskripsiParkir::find($id);
            $dp->waktu_operasional = $request->waktu_operasional;
            $dp->alamat_tkp = $request->alamat_tkp;
            $dp->nomor_telepon = $request->nomor_telepon;
            $dp->deskripsi = $request->deskripsi;
            $dp->save();

            $response = $this->generateItem($dp);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('deskripsi_parkir_tidak_ditemukan');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    //hapus data
    public function delete($id){
        try{
            $dp = DeskripsiParkir::find($id);
            $dp->delete();
            return response()->json('Success', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('deskripsi_parkir_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
