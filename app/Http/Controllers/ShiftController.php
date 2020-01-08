<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\ShiftTransformer;
class ShiftController extends RestController
{
    protected $transformer = ShiftTransformer::class;
    
     ////menampilkan data
     public function show(){
        $shift = Shift::all();
        $response = $this->generateCollection($shift);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById($id_shift){
        try{
                $shift = Shift::find($id_shift);
                $response = $this->generateItem($shift);
                return $this->sendResponse($response);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('shift_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
        
    }

    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'nama_shift' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
        ]);   
        try{
            $shift = new Shift;
            $shift->nama_shift = $request->nama_shift;
            $shift->jam_masuk = $request->jam_masuk;
            $shift->jam_keluar = $request->jam_keluar;
            
            $shift->save();
            
            $response = $this->generateItem($shift);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    //update data
    public function update(request $request, $id_shift){
      
            $nama_shift = $request->nama_shift;
            $jam_masuk = $request->jam_masuk;
            $jam_keluar = $request->jam_keluar;
        try{
            $shift = Shift::find($id_shift);
            $shift->nama_shift = $request->nama_shift;
            $shift->jam_masuk = $request->jam_masuk;
            $shift->jam_keluar = $request->jam_keluar;
            
            $shift->save();

            $response = $this->generateItem($shift);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('shift_tidak_ditemukan');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    //hapus data
    public function delete($id_shift){
        try{
            $shift = Shift::find($id_shift);
            $shift->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('shift_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
