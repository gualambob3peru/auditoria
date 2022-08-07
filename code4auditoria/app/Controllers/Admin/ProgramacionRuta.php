<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FrecuenciaModel;
use App\Models\PersonalModel;
use Config\Database;
use App\Models\ProgramacionModel;
use App\Models\ProgramacionRutaModel;
use App\Models\RutaModel;

class ProgramacionRuta extends BaseController
{
    private $db = "";
    private $table = "programacion_ruta";
    private $nombre = "programacionRuta";
    private $lista = "programacionRutas";
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
        $this->model = new ProgramacionRutaModel();
    }

    public function index()
    {
        $lista_datos = $this->db->table("programacion_ruta pr")
            ->select("pr.id, pr.id_ruta, pr.estado, pr.fechaRegistro, r.descripcion r_descripcion")
            ->join("ruta r","r.id = pr.id_ruta")
            ->where("pr.estado","1")
            ->get()->getResult();
        $data = $this->dataView;
        $data["lista_datos"] = $lista_datos;
      
        $this->template->setTemplate('templates/template2');
        $this->template->render('Admin/'.$this->table.'/list', $data);
    }

    public function rutas($id){
        $locales = $this->db->table("ruta_local rl")
            ->select("rl.id, rl.id_ruta, rl.id_local, rl.secuencia, rl.fechaRegistro, rl.estado, l.descripcion l_descripcion, l.id l_id")
            ->join("local l","l.id = rl.id_local")
            ->where("rl.id_ruta",$id)->get()->getResult();
    
        $ruta = (new RutaModel())->find($id);
        
        $datosView = $this->dataView;
        $datosView["locales"] = $locales;
        $datosView["ruta"] = $ruta;
        $datosView["id_programacion_ruta"] = $id;
           
        $this->template->setTemplate('templates/template2');
        $this->template->render('Admin/programacion_ruta/rutas',$datosView);
    }

    public function rutaCategoria($id_programacion_ruta,$id_local){
        $fecha = date("Y-m-d");
        $local = $this->db->table("local l")
            ->select("l.id,l.descripcion, l.id_canal, l.id_zona, z.descripcion z_descripcion, c.descripcion c_descripcion")
            ->join("zona z","z.id = l.id_zona")
            ->join("canal c","c.id = l.id_canal")
            ->where("l.id",$id_local)
            ->get()->getRowArray();

          
        $contratos = $this->db->table("contrato co")
            ->select("co.id, co.id_categoria, co.id_frecuencia, co.id_canal, co.id_zona, co.fechaInicio, co.fechaFin, co.fechaRegistro, co.estado, c.descripcion c_descripcion")
            ->join("categoria c","c.id = co.id_categoria")
            ->where("co.id_canal",$local["id_canal"])
            ->where("co.id_zona",$local["id_zona"])
            ->where("co.fechaInicio <",$fecha)
            ->where("co.fechaFin >",$fecha)
            ->get()->getResultArray();

        $categorias = $this->db->table("programacion_ruta_categoria prc")
            ->select("prc.id, prc.id_programacion_ruta,prc.id_local, prc.id_categoria, prc.id_frecuencia, prc.fechaRegistro, prc.estado, c.descripcion c_descripcion")
            ->join("programacion_ruta pr","pr.id = prc.id_programacion_ruta")
            ->join("categoria c","c.id = prc.id_categoria")
            ->where("prc.id_programacion_ruta",$id_programacion_ruta)
            ->where("prc.id_local",$id_local)
            ->get()->getResult();

        $datosView = $this->dataView;
        $datosView["contratos"] = $contratos;
        $datosView["categorias"] = $categorias;
        $datosView["local"] = $local;

        if ($this->request->getPost('submit')) {

            $rules = [
                'id_categoria' => 'required'
            ];

            $errors = [
              
            ];
            if (!$this->validate($rules, $errors)) {
                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/programacion_ruta/categoria',$datosView);
             
            } else {
                //agregando el local
                $datosInsert= [
                    "id_categoria" => $this->request->getVar('id_categoria'),
                    "id_programacion_ruta" => $id_programacion_ruta,
                    "id_local" => $id_local
                ];

                $this->db->table("programacion_ruta_categoria")->insert($datosInsert);

                //Agregando categorias
                $datosInsert= [
                    "id_categoria" => $this->request->getVar('id_categoria'),
                    "id_programacion_local" => $id_programacion_ruta,
                    "id_local" => $id_local
                ];

                $this->db->table("programacion_local_categoria")->insert($datosInsert);
              
                return redirect()->to(site_url('admin/programacionRuta/rutaCategoria/'.$id_programacion_ruta.'/'.$id_local));    
            }
        } else {
         
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/programacion_ruta/categoria',$datosView);
        }
    }

    public function agregar(){

        if ($this->request->getPost('submit')) {

            $rules = [
                'id_ruta' => 'required'
            ];

            $errors = [
              
            ];
            if (!$this->validate($rules, $errors)) {
             
                $rutas = (new RutaModel())->findAll();

                $datosView = $this->dataView;
                $datosView['validation'] = $this->validator;
             
             
                $datosView["rutas"] = $rutas;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/'.$this->table.'/agregar',$datosView);
            } else {
                $datosInsert= [
                  

                    "id_ruta" => $this->request->getVar('id_ruta'),
                ];

                $this->model->save($datosInsert);
                return redirect()->to(site_url('admin/programacionRuta'));    
            }
        } else {

            $personals = (new PersonalModel())->findAll();
            $frecuencias = (new FrecuenciaModel())->findAll();
            $rutas = (new RutaModel())->findAll();

            
            $datosView = $this->dataView;
  
            $datosView["rutas"] = $rutas;
 
            $this->template->setTemplate('templates/template2');
            $this->template->render('Admin/'.$this->table.'/agregar',$datosView);
        }
    }

    public function editar($id){
        $f_model = $this->model->find($id);

        if ($this->request->getPost('submit')) {
            $rules = [
                'personal' => 'required'
            ];

            $errors = [
               
            ];

            //if (!$validation->withRequest($this->request)->run()) {
            if (!$this->validate($rules, $errors)) {
                $personals = (new PersonalModel())->findAll();
                $frecuencias = (new FrecuenciaModel())->findAll();
                $rutas = (new RutaModel())->findAll();

                $datosView = $this->dataView;
                $datosView["f_model"] = $f_model;
                $datosView["personals"] = $personals;

                $datosView["rutas"] = $rutas;
                $datosView['validation'] = $this->validator;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/'.$this->table.'/editar',$datosView);
            } else {
                $datosUpdate= [
                    "id" => $id,
                    "id_personal" => $this->request->getVar('personal'),
   
                    "id_ruta" => $this->request->getVar('ruta'),
                    "fecha_visita" => $this->request->getVar('fecha_visita'),
                ];

                $this->model->save($datosUpdate);
                return redirect()->to(site_url('admin/'.$this->table));    
            }
        } else {
            $personals = (new PersonalModel())->findAll();
            $frecuencias = (new FrecuenciaModel())->findAll();
            $rutas = (new RutaModel())->findAll();

            
            $datosView = $this->dataView;
            $datosView["f_model"] = $f_model;
            $datosView["personals"] = $personals;
       
            $datosView["rutas"] = $rutas;
 
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