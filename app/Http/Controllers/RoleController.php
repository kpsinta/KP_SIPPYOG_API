<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\RoleTransformer;

class RoleController extends RestController
{
    protected $transformer = RoleTransformer::class;
     //menampilkan data
     public function show(){
        $role = Role::all();
         $response = $this->generateCollection($role);
         return $this->sendResponse($response);
    }

    //tampil by id
    public function showById($id_role){
        $role = Role::find($id_role);
        $response = $this->generateItem($role);
        return $this->sendResponse($response);
        
    }
    //nambah data
    public function create(request $request){
        $this->validate($request,[
            'nama_role' => 'required',
        ]);   
        try{
            $role = new Role;
            $role->nama_role = $request->nama_role;
            $role->save();
            
            $response = $this->generateItem($role);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
    //update data
    public function update(request $request, $id_role){
        try{
            $role = Role::find($id_role);
            $role->nama_role = $request->nama_role;
            
            $role->save();

            $response = $this->generateItem($role);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('role_tidak_ditemukan');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    //hapus data
    public function delete($id_role){
        try{
            $role = Role::find($id_role);
            $role->delete();
            return response()->json('Success', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('role_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
