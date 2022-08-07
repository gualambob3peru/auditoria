<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FrecuenciaModel;
use App\Models\PersonalModel;
use App\Models\ProgramacionAccionModel;
use App\Models\ProgramacionLocalCategoriaModel;
use App\Models\ProgramacionLocalModel;
use Config\Database;
use App\Models\ProgramacionModel;
use App\Models\ProgramacionProductoModel;
use App\Models\ProgramacionRutaModel;
use App\Models\RutaModel;

class Programacion extends BaseController
{
    private $db = "";
    private $table = "programacion";
    private $nombre = "programacion";
    private $lista = "programacions";
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
        $this->model = new ProgramacionModel();
    }

    public function index()
    {
        $lista_datos = $this->db->table("programacion pr")
            ->select("pr.id, pr.id_personal, pe.nombres,pe.apellidoPaterno,pe.apellidoMaterno, r.descripcion r_descripcion,pr.fecha_visita")
            ->join("personal pe",'pe.id = pr.id_personal')
            ->join("programacion_ruta pror",'pror.id = pr.id_programacion_ruta')
            ->join("ruta r","r.id = pror.id_ruta")
            
            ->where("pr.estado","1")
            ->get()->getResult();
        $data = $this->dataView;
        $data["lista_datos"] = $lista_datos;
       
      
        $this->template->setTemplate('templates/template2');
        $this->template->render('Admin/'.$this->table.'/list', $data);
    }

    public function programar(){
        $id_programacion = $this->request->getVar('id_programacion');
        $programacion = (new ProgramacionModel())->find($id_programacion);

        $locales = $this->db->table("programacion_ruta_categoria prc")
            ->select("l.id l_id,l.id_canal,l.id_zona")
            ->join("local l","l.id = prc.id_local")
            ->where("prc.id_programacion_ruta",$programacion["id_programacion_ruta"])
            ->get()->getResultArray();
        
        $arr_loc = [];
        $n_locales = [];
        foreach($locales as $local){
            if(!in_array($local["l_id"],$arr_loc)){
                array_push($arr_loc, $local["l_id"]);
                array_push($n_locales, $local);
            }
        }
        $locales = $n_locales;

        $fecha_num_mes = intval(substr($programacion["fecha_visita"],5,2));
     
        foreach($locales as $key => $local){
            $data = [
                "id_programacion" => $id_programacion,
                "id_programacion_ruta" => $programacion["id_programacion_ruta"],
                "id_local" => $local["l_id"]
            ];
            $plModel = new ProgramacionLocalModel();
            $plModel->save($data);
            $idpl = $plModel->getInsertID();

            /////////////////////Generar Categorias/////////////////////////
            $categorias = $this->db->table("programacion_ruta_categoria")
                ->where("id_programacion_ruta",$programacion["id_programacion_ruta"])
                ->where("id_local",$local["l_id"])
                ->get()->getResultArray();
             
            foreach($categorias as $key2 =>$categoria){

                /****** HALLANDO FRECUENCIA OPTIMA*/
                $id_canal = $local["id_canal"];
                $id_zona = $local["id_zona"];

                //Hallando todas las frecuencias de maestros "vigentes"
                $contratos = $this->db->table("contrato")
                    ->where("id_canal",$id_canal)
                    ->where("id_zona",$id_zona)
                    ->where("id_categoria",$categoria["id_categoria"])
                    ->where("fechaInicio<",$programacion["fecha_visita"])
                    ->where("fechaFin>",$programacion["fecha_visita"])
                    ->where("estado","1")->get()->getResultArray()
                    ;
                 
                $arr_frecuencias = [];
                foreach($contratos as $keyContrato => $contrato){
                    $c_frecuencia = $contrato["id_frecuencia"];
                    $frecuencia_mes = $this->db->table("frecuencia_mes")
                        ->where("fecha",$fecha_num_mes)
                        ->where("id_frecuencia",$c_frecuencia)
                        ->get()->getRowArray();
                    $acciones = $frecuencia_mes["accion"];
                    $acciones = explode(",",$acciones);
                

                    foreach($acciones as $accion){
                        if(!in_array($accion,$arr_frecuencias)){
                            array_push($arr_frecuencias,$accion);
                        }
                    }
                }
                $frecuencia_final = implode(",",$arr_frecuencias);

                /************** */
                if($contratos){
                 
                    $dataCategoria = [
                     "id_programacion_local" => $idpl,
                     "id_local" => $local["l_id"],
                     "id_categoria" => $categoria["id_categoria"], 
                   //  "id_frecuencia" => $categoria["id_frecuencia"]
                     "id_frecuencia" => $frecuencia_final
                    ];
                    
    
                    $plcModel = new ProgramacionLocalCategoriaModel();
                    $plcModel->save($dataCategoria);
                    $idplc = $plcModel->getInsertID();
                    
                    ////////////////////// Generar Productos ////////////////////////
                    $productos = $this->db->table("producto")
                        ->where("id_categoria",$categoria["id_categoria"])->get()->getResultArray();
    
                    foreach($productos as $key3 => $producto){
                        $dataProducto = [
                            "id_programacion_categoria" => $idplc,
                            "id_producto" => $producto["id"]
                        ];
                        $ppModel = new ProgramacionProductoModel();
                        $ppModel->save($dataProducto);
                        $id_pp = $ppModel->getInsertID();
    
                       
                        
                        $acciones =  $arr_frecuencias;  
    
                        foreach($acciones as $key4 => $accion){
                            $dataAccion = [
                                "id_programacion_producto" => $id_pp,
                                "id_accion" => $accion,
                                "valor" => ""
                            ];
                            (new ProgramacionAccionModel())->save($dataAccion);
                        }
                    }
                }

            }

        }

        
     
        


        //Generar Productos


        /////
        echo json_encode(array("response" => $locales));
    }

    public function agregar(){

        $personals = (new PersonalModel())->findAll();
        $rutas = $this->db->table("programacion_ruta pr")
                ->select("pr.id, pr.id_ruta,r.descripcion r_descripcion")
                ->join("ruta r","r.id = pr.id_ruta")
                ->where("pr.estado","1")
                ->get()->getResultArray();

        if ($this->request->getPost('submit')) {
           
            $rules = [
                'personal' => 'required'
            ];
            $errors = [
              
            ];
            if (!$this->validate($rules, $errors)) {
                

                $datosView = $this->dataView;
                $datosView['validation'] = $this->validator;
                $datosView["personals"] = $personals;
             
                $datosView["rutas"] = $rutas;

                $this->template->setTemplate('templates/template2');
                $this->template->render('Admin/'.$this->table.'/agregar',$datosView);
            } else {
                $datosInsert= [
                    "id_personal" => $this->request->getVar('personal'),
             
                    "id_programacion_ruta" => $this->request->getVar('ruta'),
                    "fecha_visita" => $this->request->getVar('fecha_visita'),
                ];

                $this->model->save($datosInsert);
                return redirect()->to(site_url('admin/'.$this->table));    
            }
        } else {   
            $datosView = $this->dataView;
            $datosView["personals"] = $personals;
  
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
   
                    "id_programacion_ruta" => $this->request->getVar('ruta'),
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