<?php

namespace App\Controllers\Api;

use App\Models\ProgramacionAccionModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Sincronizacion extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        /*$canals = (new CanalModel())->where("estado",1)->findAll();
        return $this->respond($canals);*/
    }

    public function sincronizar(){
        $acciones =$this->request->getVar('acciones');

        foreach($acciones as $key => $value){
            $accion = (new ProgramacionAccionModel())->find($value->id);
            if(!$accion){
                $value->id = intval($value->id);
                (new ProgramacionAccionModel())->insert($value);
            }else{
                (new ProgramacionAccionModel())->save($value);
            }
        }

        $response = [
            'status'   => 201,
            'body' => $acciones,
            'error'    => null,
            'messages' => 'Correctamente'
        ];
        return $this->respond($response);
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