<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;
use App\Models\CategoriaModel;

class Categoria extends BaseController
{
    private $db = "";
    private $table = "categoria";
    private $nombre = "categoria";
    private $lista = "categorias";
    private $dataView = [];
    private $model = "";

    public function __construct()
    {
        $this->db =  Database::connect();
        $this->dataView = [
            "lista" => $this->lista,
            "table" => $this->table,
            "nombre" => $this->nombre,
        ];
        $this->model = new CategoriaModel();
    }

    public function index()
    {
        $lista_datos = $this->db->table($this->table)
            ->where("estado","1")
            ->get()->getResult();
        $data = $this->dataView;
        $data["lista_datos"] = $lista_datos;
      
        $this->template->setTemplate('templates/template2');
        $this->template->render('Admin/'.$this->table.'/list', $data);
    }

    public function agregar(){

        if ($this->request->getPost('submit')) {

            $rules = [
                'descripcion' => 'required'
            ];

            $errors = [
              
            ];
            if (!$this->validate($rules, $errors)) {
                $datosView = $this->dataView;
                $datosView['validation'] = $this->validator;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/'.$this->table.'/agregar',$datosView);
            } else {
                

                $datosInsert = [
                    "descripcion" => $this->request->getVar('descripcion')
                ];

                $this->model->save($datosInsert);
                return redirect()->to(site_url('admin/'.$this->table));    
            }
        } else {
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/'.$this->table.'/agregar',$this->dataView);
        }
    }

    public function editar($id){
        $f_model = $this->model->find($id);

        if ($this->request->getPost('submit')) {
            $rules = [
                'descripcion' => 'required'
            ];

            $errors = [
               
            ];

            //if (!$validation->withRequest($this->request)->run()) {
            if (!$this->validate($rules, $errors)) {
                $datosView = $this->dataView;
                $datosView["f_model"] = $f_model;
                $datosView['validation'] = $this->validator;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/'.$this->table.'/editar',$datosView);
            } else {
                $datosUpdate= [
                    "id" => $id,
                    "descripcion" => $this->request->getVar('descripcion')
                ];

                $this->model->save($datosUpdate);
                return redirect()->to(site_url('admin/'.$this->table));    
            }
        } else {
            $datosView = $this->dataView;
            $datosView["f_model"] = $f_model;
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/'.$this->table.'/editar',$datosView);
        }
    }

    public function eliminar($id){
        $datosUpdate= [
            "id" => $id,
            "estado" => '0'
        ];
        $this->model->save($datosUpdate);
        return redirect()->to(site_url('admin/'.$this->table)); 
    }
}