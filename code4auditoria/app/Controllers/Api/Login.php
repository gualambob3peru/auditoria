<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;
use App\Models\PersonalModel;
use CodeIgniter\API\ResponseTrait;

class Login extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        /*$canals = (new CanalModel())->where("estado",1)->findAll();
        return $this->respond($canals);*/
    }

    public function login(){
    

        $model = new PersonalModel();
        $user = $model->where('email', $this->request->getVar('email'))
                    ->first();
        
     
        if(!$user){
            $response = [
                'status'   => 200,
                'error'    => 1,
                'user'      => [],
                'messages' =>'Usuario no encontrado'
                
            ];
            return $this->respond($response);
        }else if(password_verify($password = $this->request->getVar('password'), $user['password'])){
            $user = $model->findComplete($user["id"]);
            $response = [
                'status'   => 200,
                'error'    => 0,
                'user'      => $user,
                'messages' => 'Exito'
            ];
            return $this->respond($response);
        }else{
            $response = [
                'status'   => 200,
                'error'    => 1,
                'user'      => [],
                'messages' => 'Usuario o contraseña incorrecta'
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