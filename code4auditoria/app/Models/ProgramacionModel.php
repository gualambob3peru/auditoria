<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramacionModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'programacion';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_personal','id_programacion_ruta','fecha_visita','accion','estado'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];


    public function getAll_fecha($fecha,$idPersonal){
        return $this->select("programacion.id, programacion.id_personal, programacion.id_programacion_ruta, programacion.fecha_visita, programacion.accion, programacion.fechaRegistro, r.descripcion r_descripcion")
            ->join("programacion_ruta pr","pr.id = programacion.id_programacion_ruta")
            ->join("ruta r","r.id = pr.id_ruta")
            ->where("programacion.fecha_visita",$fecha)
            ->where("programacion.id_personal",$idPersonal)
            ->where("programacion.estado","1")
            ->get()->getRowArray();
    }
}
