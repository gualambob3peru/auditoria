<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramacionRutaModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'programacion_ruta';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_ruta','estado'];

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
        return $this->select("programacion.id, programacion.id_personal, programacion.id_ruta, programacion.fecha_visita, programacion.accion, programacion.fechaRegistro, r.descripcion r_descripcion")
            ->join("ruta r","r.id = programacion.id_ruta")
            ->where("programacion.fecha_visita",$fecha)
            ->where("programacion.id_personal",$idPersonal)
            ->where("programacion.estado","1")
            ->get()->getRowArray();
    }
}
