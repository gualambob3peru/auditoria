<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BancoModel;
use App\Models\CentroModel;
use App\Models\ClasecostoModel;
use App\Models\Cuenta3Model;
use App\Models\EmpresaModel;
use App\Models\KeyModel;
use App\Models\OcModel;

use App\Models\MonedaModel;
use App\Models\OrdenDetalleModel;
use App\Models\PersonalModel;
use App\Models\RendicionItemCentroModel;
use App\Models\RendicionItemModel;
use App\Models\TipoOrdenModel;
use App\Models\TipoSolicitudModel;
use App\Models\RendicionModel;

use Config\Database;

class Frecuencia extends BaseController
{
    private $db = "";
    private $table = "frecuencia";
    private $nombre = "frecuencia";
    private $lista = "frecuencias";
    private $dataView = [];
    private $model = "";

    public function __construct()
    {
        helper('todo');
        $this->db =  Database::connect();
        $this->dataView = [
            "lista" => $this->lista,
            "table" => $this->table,
            "nombre" => $this->nombre,
        ];
        
    }

    public function index()
    {


        $data = $this->dataView;
        $frecuencias = $this->db->table("frecuencia")
            ->get()->getResult();

        foreach ($frecuencias as $key => $value) {
            $meses = $this->db->table("frecuencia_mes")
                ->where("id_frecuencia", $value->id)
                ->get()->getResult();


            foreach ($meses as $key2 => $value2) {
                $meses[$key2]->acciones =  array();
                if ($value2->accion != "") {
                    $aa = explode(",", $value2->accion);


                    $acciones = array();
                    foreach ($aa as $key3 => $value3) {
                        $accion = $this->db->table("accion")
                            ->where("id", $value3)
                            ->get()->getRow();
                        array_push($acciones, $accion);
                    }
                    $meses[$key2]->acciones =  $acciones;
                }
            }


            $frecuencias[$key]->meses = $meses;
        }


        $data["meses"] = getMonthList();
        $data["frecuencias"] = $frecuencias;
        $this->template->setTemplate('templates/template2');
        $this->template->render('Admin/frecuencia/list', $data);
    }

    public function agregar()
    {
        if ($this->request->getPost('submit')) {

            $descripcion = $_POST["nombrefrecuencia"];

            $data = [
                'descripcion' => $descripcion
            ];

            $this->db->table("frecuencia")->insert($data);
            $id = $this->db->insertID();
            /************************ */

            $accion = $_POST["accion"];

            $this->db->table("frecuencia_mes")
                ->where("id_frecuencia", $id)
                ->delete();

            foreach ($accion as $key => $value) {

                $data = [
                    'id_frecuencia' => $id,
                    'fecha'  => $key + 1,
                    'accion'  => implode(",", $value)
                ];

                $this->db->table("frecuencia_mes")->insert($data);
            }

            return redirect()->to(site_url('admin/frecuencia'));
        }else{

            $accionesT = $this->db->table("accion")
                ->get()->getResult();
            $listMeses = getMonthList();
    
            $data["accionesT"] = $accionesT;
            $data["listMeses"] = $listMeses;
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/frecuencia/agregar', $data);
        }
   
    }

    public function editar($id)
    {


        if ($this->request->getPost('submit')) {

            $accion = $_POST["accion"];


            $this->db->table("frecuencia_mes")
                ->where("id_frecuencia", $id)
                ->delete();

            foreach ($accion as $key => $value) {

                $data = [
                    'id_frecuencia' => $id,
                    'fecha'  => $key + 1,
                    'accion'  => implode(",", $value)
                ];

                $this->db->table("frecuencia_mes")->insert($data);
            }

            return redirect()->to(site_url('admin/frecuencia'));
        } else {
            $frecuencia = $this->db->table("frecuencia")
                ->where("id", $id)
                ->get()->getRow();

            $accionesT = $this->db->table("accion")
                ->get()->getResult();
            $listMeses = getMonthList();

            $meses = $this->db->table("frecuencia_mes")
                ->where("id_frecuencia", $frecuencia->id)
                ->get()->getResult();

            foreach ($meses as $key2 => $value2) {
                $meses[$key2]->acciones =  array();
                if ($value2->accion != "") {
                    $aa = explode(",", $value2->accion);


                    $acciones = array();
                    foreach ($aa as $key3 => $value3) {
                        $accion = $this->db->table("accion")
                            ->where("id", $value3)
                            ->get()->getRow();
                        array_push($acciones, $accion);
                    }
                    $meses[$key2]->acciones =  $acciones;
                }
            }

            $frecuencia->meses = $meses;
            $data["frecuencia"] = $frecuencia;
            $data["accionesT"] = $accionesT;
            $data["listMeses"] = $listMeses;
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/frecuencia/editar', $data);
        }
    }




    /***************** */
    
}
