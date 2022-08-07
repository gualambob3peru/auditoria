<?php

namespace App\Controllers\Api;

use App\Models\RutaLocalModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\RutaModel;

class Ruta extends ResourceController
{

    public function index()
    {
        /*$canals = (new CanalModel())->where("estado",1)->findAll();
        return $this->respond($canals);*/
    }

    public function get($id= null){
    
        
      
        $rutas = (new RutaModel())->find($id);

      
        if($rutas){
            $rutas["locals"] = (new RutaLocalModel())->findComplete($id);
          

            return $rutas;
        }
        return [];

    }

    public function show($id=null)
    {
        /*$canal = (new CanalModel())->where("estado",1)->findAll();

        if($canal){
            return $this->respond($canal);
        }else{
            return $this->failNotFound('No encontrado');
        }*/
    }

    // create
    public function create() {

        /*$datosInsert= [
            "descripcion" => $this->request->getVar('descripcion')
        ];

        (new CanalModel())->save($datosInsert);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Canal agregado correctamente'
            ]
        ];
      return $this->respondCreated($response);*/
    }

    public function update($id = null) {

        /*$datos= [
            "id" => $id,
            "descripcion" => $this->request->getVar('descripcion')
        ];

        (new CanalModel())->save($datos);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Canal Actualizado correctamente'
            ]
        ];
      return $this->respond($response);*/
    }

    public function delete($id = null) {

        /*$datos= [
            "id" => $id,
            "estado" => "0"
        ];

        (new CanalModel())->save($datos);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Canal eliminado correctamente'
            ]
        ];
      return $this->respondDeleted($response);*/
    }


    

    public function logout(){
    
    }
}