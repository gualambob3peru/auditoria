<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;
use App\Models\ContratoModel;
use App\Models\CategoriaModel;
use App\Models\FrecuenciaModel;
use App\Models\CanalModel;
use App\Models\ZonaModel;
use App\Models\MagnitudModel;

class Contrato extends BaseController
{
    private $db = "";
    private $table = "contrato";
    private $nombre = "contrato";
    private $lista = "contratos";
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
        $this->model = new ContratoModel();
    }

    public function index()
    {
        $lista_datos = $this->db->table("contrato co")
            ->select("co.id,co.id_categoria,c.descripcion c_descripcion,co.id_frecuencia,f.descripcion f_descripcion,co.id_canal,ca.descripcion ca_descripcion,co.id_zona,z.descripcion z_descripcion,co.fechaInicio,co.fechaFin")
            ->join("categoria c", "c.id = co.id_categoria")
            ->join("frecuencia f", "f.id = co.id_frecuencia")
            ->join("canal ca", "ca.id = co.id_canal")
            ->join("zona z", "z.id = co.id_zona")
            
            ->where("co.estado", "1")
            ->get()->getResult();
        $data = $this->dataView;
        $data["lista_datos"] = $lista_datos;

        $this->template->setTemplate('templates/template2');
        $this->template->render('Admin/' . $this->table . '/list', $data);
    }

    public function agregar()
    {

        if ($this->request->getPost('submit')) {
            $rules = [
                'categoria' => 'required'
            ];

            $errors = [];

            //if (!$validation->withRequest($this->request)->run()) {
            if (!$this->validate($rules, $errors)) {
                $datosView = $this->dataView;
               
                $datosView['validation'] = $this->validator;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/' . $this->table . '/editar', $datosView);
            } else {


                $datosUpdate = [
                    "id_categoria" => $this->request->getVar('categoria'),
                    "id_frecuencia" => $this->request->getVar('frecuencia'),
                    "id_canal" => $this->request->getVar('canal'),
                    "id_zona" => $this->request->getVar('zona'),
                    "fechaInicio" => $this->request->getVar('fechaInicio'),
                    "fechaFin" => $this->request->getVar('fechaFin'),
                    
                ];

                $this->model->save($datosUpdate);
                return redirect()->to(site_url('admin/' . $this->table));
            }
        } else {
            $categorias = (new CategoriaModel())->findAll();
            $frecuencias = (new FrecuenciaModel())->findAll();
            $canals = (new CanalModel())->findAll();
            $zonas = (new ZonaModel())->findAll();
            
            $datosView = $this->dataView;
            $datosView["categorias"] = $categorias;
            $datosView["frecuencias"] = $frecuencias;
            $datosView["canals"] = $canals;
            $datosView["zonas"] = $zonas;
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/' . $this->table . '/agregar', $datosView);
        }
    }

    public function editar($id)
    {
        $f_model = $this->model->find($id);

        if ($this->request->getPost('submit')) {
            $rules = [
                'categoria' => 'required'
            ];

            $errors = [];
           
            //if (!$validation->withRequest($this->request)->run()) {
            if (!$this->validate($rules, $errors)) {
            
                $datosView = $this->dataView;

                $datosView["f_model"] = $f_model;
               
                $datosView['validation'] = $this->validator;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/' . $this->table . '/editar', $datosView);
            } else {


                $datosUpdate = [
                    "id" => $id,
                    "id_categoria" => $this->request->getVar('categoria'),
                    "id_frecuencia" => $this->request->getVar('frecuencia'),
                    "id_canal" => $this->request->getVar('canal'),
                    "id_zona" => $this->request->getVar('zona'),
                    "fechaInicio" => $this->request->getVar('fechaInicio'),
                    "fechaFin" => $this->request->getVar('fechaFin'),
                    
                ];

                $this->model->save($datosUpdate);
                return redirect()->to(site_url('admin/' . $this->table));
            }
        } else {
            $categorias = (new CategoriaModel())->findAll();
            $frecuencias = (new FrecuenciaModel())->findAll();
            $canals = (new CanalModel())->findAll();
            $zonas = (new ZonaModel())->findAll();
            
            $datosView = $this->dataView;
            $datosView["categorias"] = $categorias;
            $datosView["frecuencias"] = $frecuencias;
            $datosView["canals"] = $canals;
            $datosView["zonas"] = $zonas;
            $datosView["f_model"] = $f_model;
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/' . $this->table . '/editar', $datosView);
        }
    }

    public function eliminar($id)
    {
        $datosUpdate = [
            "id" => $id,
            "estado" => '0'
        ];
        $this->model->save($datosUpdate);
        return redirect()->to(site_url('admin/' . $this->table));
    }
}
