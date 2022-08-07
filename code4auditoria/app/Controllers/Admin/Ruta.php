<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;
use App\Models\CategoriaModel;
use App\Models\LocalModel;
use App\Models\RutaLocalModel;
use App\Models\RutaModel;

class Ruta extends BaseController
{
    private $db = "";
    private $table = "ruta";
    private $nombre = "ruta";
    private $lista = "rutas";
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
        $this->model = new RutaModel();
    }

    public function index()
    {
        $lista_datos = $this->db->table($this->table)
            ->where("estado", "1")
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
                'descripcion' => 'required'
            ];

            $errors = [];
            if (!$this->validate($rules, $errors)) {
                $datosView = $this->dataView;
                $datosView['validation'] = $this->validator;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/' . $this->table . '/agregar', $datosView);
            } else {


                $datosInsert = [
                    "descripcion" => $this->request->getVar('descripcion')
                ];

                $this->model->save($datosInsert);
                return redirect()->to(site_url('admin/' . $this->table));
            }
        } else {
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/' . $this->table . '/agregar', $this->dataView);
        }
    }

    public function editar($id)
    {
        $f_model = $this->model->find($id);

        if ($this->request->getPost('submit')) {
            $rules = [
                'descripcion' => 'required'
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
                    "descripcion" => $this->request->getVar('descripcion')
                ];

                $this->model->save($datosUpdate);
                return redirect()->to(site_url('admin/' . $this->table));
            }
        } else {
            $datosView = $this->dataView;
            $datosView["f_model"] = $f_model;
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/' . $this->table . '/editar', $datosView);
        }
    }

    public function locales($id)
    {
        $f_model = $this->model->find($id);

        $locals = (new LocalModel())->findAll();

        $ruta_locales = $this->db->table("ruta_local rl")
            ->select("rl.id, rl.id_ruta, r.descripcion r_descripcion, rl.id_local, l.descripcion l_descripcion, rl.secuencia")
            ->join("ruta r", "r.id = rl.id_ruta")
            ->join("local l", "l.id = rl.id_local")
            ->where("rl.id_ruta", $id)
            ->where("rl.estado", '1')
            ->get()->getResult();

        if ($this->request->getPost('submit')) {
            $rules = ['local' => 'required'];

            $errors = [];

            if (!$this->validate($rules, $errors)) {
                $datosView = $this->dataView;
                $datosView["f_model"] = $f_model;
                $datosView['validation'] = $this->validator;
                $datosView["locals"] = $locals;
                $datosView["ruta_locales"] = $ruta_locales;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/' . $this->table . '/locales', $datosView);
            } else {
                $datosInsert = [
                    "id_ruta" => $id,
                    "id_local" => $this->request->getVar('local')
                ];
                (new RutaLocalModel())->save($datosInsert);
                
                return redirect()->to(site_url('admin/' . $this->table . '/locales/' . $id));
            }
        } else {
            $datosView = $this->dataView;
            $datosView["f_model"] = $f_model;
            $datosView["locals"] = $locals;
            $datosView["ruta_locales"] = $ruta_locales;
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/' . $this->table . '/locales', $datosView);
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

    public function eliminarLocal($id)
    {
        $datosUpdate = [
            "id" => $id,
            "estado" => '0'
        ];
 
        (new RutaLocalModel())->save($datosUpdate);
        return redirect()->to(site_url('admin/' . $this->table));
    }
}
