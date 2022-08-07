<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Models\MagnitudModel;

class Producto extends BaseController
{
    private $db = "";
    private $table = "producto";
    private $nombre = "producto";
    private $lista = "productos";
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
        $this->model = new ProductoModel();
    }

    public function index()
    {
        $lista_datos = $this->db->table("producto p")
            ->select("p.id,p.descripcion,p.id_categoria,p.sku,p.valor,p.id_magnitud,c.descripcion c_descripcion,m.descripcion m_descripcion")
            ->join("categoria c", "c.id = p.id_categoria")
            ->join("magnitud m", "m.id = p.id_magnitud")
            ->where("p.estado", "1")
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

            //if (!$validation->withRequest($this->request)->run()) {
            if (!$this->validate($rules, $errors)) {
                $datosView = $this->dataView;
               
                $datosView['validation'] = $this->validator;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/' . $this->table . '/editar', $datosView);
            } else {


                $datosUpdate = [
                    "sku" => $this->request->getVar('sku'),
                    "descripcion" => $this->request->getVar('descripcion'),
                    "id_categoria" => $this->request->getVar('categoria'),
                    "id_magnitud" => $this->request->getVar('magnitud'),
                    "valor" => $this->request->getVar('valor'),
                ];

                $this->model->save($datosUpdate);
                return redirect()->to(site_url('admin/' . $this->table));
            }
        } else {
            $categorias = (new CategoriaModel())->findAll();
            $magnitudes = (new MagnitudModel())->findAll();
            
            $datosView = $this->dataView;
            $datosView["categorias"] = $categorias;
            $datosView["magnitudes"] = $magnitudes;
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/' . $this->table . '/agregar', $datosView);
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
                    "sku" => $this->request->getVar('sku'),
                    "descripcion" => $this->request->getVar('descripcion'),
                    "id_categoria" => $this->request->getVar('categoria'),
                    "id_magnitud" => $this->request->getVar('magnitud'),
                    "valor" => $this->request->getVar('valor'),
                ];

                $this->model->save($datosUpdate);
                return redirect()->to(site_url('admin/' . $this->table));
            }
        } else {
            $categorias = (new CategoriaModel())->findAll();
            $magnitudes = (new MagnitudModel())->findAll();
            
            $datosView = $this->dataView;
            $datosView["categorias"] = $categorias;
            $datosView["magnitudes"] = $magnitudes;
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
