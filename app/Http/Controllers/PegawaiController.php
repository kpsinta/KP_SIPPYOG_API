<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\PegawaiTransformer;
use Hash;

class PegawaiController extends RestController
{
    protected $transformer = PegawaiTransformer::class;
    //menampilkan data
    public function show(){
        $pegawai = Pegawai::all();
        $response = $this->generateCollection($pegawai);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_pegawai){
        $pegawai = Pegawai::find($id_pegawai);
        $response = $this->generateItem($pegawai);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        $this->validate($request,[
            'id_role_fk' => 'required',
            'nama_pegawai' => 'required',
            'nip_pegawai' => 'required',
            'username_pegawai' => 'required',
            'password_pegawai' => 'required',
        ]); 
        
        try{
            $pegawai = new Pegawai;
    
            $pegawai->id_role_fk = $request->id_role_fk;
    
            $pegawai->nama_pegawai = $request->nama_pegawai;
            $pegawai->nip_pegawai = $request->nip_pegawai;
            $pegawai->username_pegawai = $request->username_pegawai;
            $pegawai->password_pegawai =bcrypt($request->password_pegawai);
            
            $pegawai->save();
    
            $response = $this->generateItem($pegawai);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
       
    }
    //update data
    public function update(request $request, $id_pegawai){
        $id_role_fk = $request->id_role_fk;
        $nama_pegawai = $request->nama_pegawai;
        $nip_pegawai = $request->nip_pegawai;
        $username_pegawai = $request->username_pegawai;

        try{
            $pegawai = Pegawai::find($id_pegawai);
            $pegawai->id_role_fk = $id_role_fk;
    
            $pegawai->nama_pegawai = $nama_pegawai;
            $pegawai->nip_pegawai = $nip_pegawai;
            $pegawai->username_pegawai = $username_pegawai;
            $pegawai->save();

            $response = $this->generateItem($pegawai);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('pegawai_tidak_ditemukan');
        }
        
    }

    //hapus data
    public function delete($id_pegawai){
        try{
            $pegawai = Pegawai::find($id_pegawai);
            $pegawai->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('pegawai_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }

    public function validateUser($username,$password)
    {
        try{
            $user = Pegawai::where('username_pegawai',$username)->firstOrFail();
            
            if (!password_verify($password, $user->password_pegawai)) {
                dd('i am here');
                throw new InvalidCredentialException();
            }
            return $user;
        } catch(ModelNotFoundException $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function mobileauthenticate(Request $request)
    {
        try {
            $user = $this->validateUser($request->get('username_pegawai'), $request->get('password_pegawai'));
            
            $response = $this->generateItem($user,PegawaiTransformer::class);
            return $this->sendResponse($response, 201);
        } catch (InvalidCredentialExcpetion $e) {
            return $this->sendNotAuthorizeResponse($e->getMessage());
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            $user = $this->validateUser($request->get('username_pegawai'), $request->get('password_pegawai'));
            $user->password_pegawai = bcrypt($request->password_pegawai_baru);
            $user->save();
            $response = $this->generateItem($user,PegawaiTransformer::class);
           // dd('sukses ubah password');
            return $this->sendResponse($response, 201);
        } catch (InvalidCredentialExcpetion $e) {
            return $this->sendNotAuthorizeResponse($e->getMessage());
        } catch (\Exception $e) {
            throw $e;
        }
    }
   
    
    // //login untuk website
    // public function login(Request $request)
    // {
    //     $pegawai = Pegawai::where('username_pegawai',$request->username_pegawai)->first();


    //     if (!Hash::check($request->password_pegawai,$pegawai->password_pegawai)) {
            
    //         return response()->json('Fail Login', 500);
    //     }
    //     else
    //         return response()->json($pegawai,200);
    // }
}
