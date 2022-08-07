<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;
use App\Models\PersonalModel;
use CodeIgniter\API\ResponseTrait;

class Personal extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $personals = (new PersonalModel())->findComplete();
        return $this->respond($personals);
    }

    public function show($id=null)
    {
        $personal = (new PersonalModel())->findComplete($id);
        if($personal){
            return $this->respond($personal);
        }else{
            return $this->failNotFound('No encontrado');
        }
    }

    // create
    public function create() {

        $datosInsert= [
            "nombres" => $this->request->getVar('nombres'),
            "apellidoPaterno" => $this->request->getVar('apellidoPaterno'),
            "apellidoMaterno" => $this->request->getVar('apellidoMaterno'),
            "idTipoDocumento" => $this->request->getVar('idTipoDocumento'),
            "nroDocumento" => $this->request->getVar('nroDocumento'),
            "idCargo" => $this->request->getVar('idCargo'),
            "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            "password2" => $this->request->getVar('password'),
            "email" => $this->request->getVar('email'),
            "telefono" => $this->request->getVar('telefono')
        ];

        (new PersonalModel())->save($datosInsert);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Personal agregado correctamente'
            ]
        ];
      return $this->respondCreated($response);
    }

    public function update($id = null) {

        $datos= [
            "id" => $id,
            "nombres" => $this->request->getVar('nombres'),
            "apellidoPaterno" => $this->request->getVar('apellidoPaterno'),
            "apellidoMaterno" => $this->request->getVar('apellidoMaterno'),
            "idTipoDocumento" => $this->request->getVar('idTipoDocumento'),
            "nroDocumento" => $this->request->getVar('nroDocumento'),
            "idCargo" => $this->request->getVar('idCargo'),
            "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            "password2" => $this->request->getVar('password'),
            "email" => $this->request->getVar('email'),
            "telefono" => $this->request->getVar('telefono')
        ];

        (new PersonalModel())->save($datos);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Personal Actualizado correctamente'
            ]
        ];
      return $this->respond($response);
    }

    public function delete($id = null) {

        $datos= [
            "id" => $id,
            "estado" => "0"
        ];

        (new PersonalModel())->save($datos);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Personal eliminado correctamente'
            ]
        ];
      return $this->respondDeleted($response);
    }


    

    public function logout(){
    
    }
}