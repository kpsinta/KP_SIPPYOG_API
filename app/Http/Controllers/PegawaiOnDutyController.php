<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai_OnDuty;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\PegawaiOnDutyTransformer;

class PegawaiOnDutyController extends RestController
{
    protected $transformer = PegawaiOnDutyTransformer::class;
    
     ////menampilkan data
     public function show(){
        $pod = Pegawai_OnDuty::withTrashed()->get();
        $response = $this->generateCollection($pod);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById($id_pod){
        $pod = Pegawai_OnDuty::find($id_pod);
        $response = $this->generateItem($pod);
        return $this->sendResponse($response);
    }
    //tampil by id
    public function showByIdTiket($id){
        $pod = Pegawai_OnDuty::where('id_tiket_fk',$id)->where('id_transaksi_fk',null)->withTrashed()->get();
        $response = $this->generateCollection($pod);
        return $this->sendResponse($response);
    }
    public function create_kendaraan_masuk(request $request){
        $this->validate($request,[
            'id_shift_fk' => 'required',
            'id_pegawai_fk' => 'required',
            'id_tiket_fk' => 'required',
        ]);   
        try{
           
            $pod = new Pegawai_OnDuty;

            $pod->id_shift_fk = $request->id_shift_fk;
            $pod->id_pegawai_fk = $request->id_pegawai_fk;
            $pod->id_tiket_fk = $request->id_tiket_fk;
            $pod->id_transaksi_fk = null;
            $pod->save();
            
            $response = $this->generateItem($pod);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function create_kendaraan_keluar(request $request){
        $this->validate($request,[
            'id_shift_fk' => 'required',
            'id_pegawai_fk' => 'required',
            'id_tiket_fk' => 'required',
            'id_transaksi_fk' => 'required',
        ]);   
        try{
                $search_pod = Pegawai_OnDuty::where('id_tiket_fk', $request->id_tiket_fk)
                            ->where('id_shift_fk', $request->id_shift_fk)
                            ->where('id_pegawai_fk', $request->id_pegawai_fk)->first();
                if($search_pod==null)
                {
                    $pod = new Pegawai_OnDuty;

                    $pod->id_shift_fk = $request->id_shift_fk;
                    $pod->id_pegawai_fk = $request->id_pegawai_fk;
                    $pod->id_tiket_fk = $request->id_tiket_fk;
                    $pod->id_transaksi_fk = $request->id_transaksi_fk;
                    $pod->save();
                    
                    $response = $this->generateItem($pod);
                }
                else
                {
                    $search_pod->id_transaksi_fk = $request->id_transaksi_fk;
                    $search_pod->save();
                    $response = $this->generateItem($search_pod);
                }
                return $this->sendResponse($response,201);
        }
        catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('pegawaionduty_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }

        //hapus data
    public function delete($id_pod){
        try{
            $pod = Pegawai_OnDuty::find($id_pod);
            $pod->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('pegawaionduty_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
