<?php

namespace App\Controllers\Api;

use App\Models\ProgramacionAccionModel;
use App\Models\ProgramacionLocalCategoriaModel;
use App\Models\ProgramacionLocalModel;
use App\Models\ProgramacionModel;
use App\Models\ProgramacionProductoModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Programacion extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        /*$canals = (new CanalModel())->where("estado",1)->findAll();
        return $this->respond($canals);*/
    }

    public function get_fecha($fecha= null,$idPersonal=0){
        $programacion = (new ProgramacionModel())->getAll_fecha($fecha,$idPersonal);
        $programacion["fecha_mes"] = intval(substr($programacion["fecha_visita"],5,2));

     
        if($programacion){
            $programacion["programacion_local"] = (new ProgramacionLocalModel())->findAllComplete($programacion["id"]);
    
            foreach($programacion["programacion_local"] as $key => $value){
        
                $categorias = (new ProgramacionLocalCategoriaModel())->findAllComplete($value["id"]);
              
                $programacion["programacion_local"][$key]["categorias"] = $categorias;

                foreach($programacion["programacion_local"][$key]["categorias"] as $key2 => $value2){
                    $productos = (new ProgramacionProductoModel())->findAllComplete($value2["id"]);

                    $programacion["programacion_local"][$key]["categorias"][$key2]["productos"] = $productos;

                    foreach ($programacion["programacion_local"][$key]["categorias"][$key2]["productos"] as $key3 => $value3) {
                        $acciones = (new ProgramacionAccionModel())->findAllComplete($value3["id"]);
                        $programacion["programacion_local"][$key]["categorias"][$key2]["productos"][$key3]["acciones"] = $acciones;
                    }

                }
            }

            $response = [
                'status'   => 200,
                'error'    => 0,
                'body'      => $programacion,
                'messages' => 'Respuesta correcta'
            ];

            return $this->respond($response);
        }else{
            $response = [
                'status'   => 404,
                'error'    => 1,
                'body'      => [
                    "id" => "",
                    "id_personal" => "",
                    "id_programacion_ruta" => "",
                    "fecha_visita" => "",
                    "accion" => "",
                    "fechaRegistro" => "",
                    "r_descripcion" => "",
                    "programacion_local" => []
                ],
                'messages' => 'No se encuentra la programación'
            ];

            return $this->respond($response);
        }

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