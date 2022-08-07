<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramacionLocalModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'programacion_local';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_programacion','id_programacion_ruta','id_local','estado'];

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

    public function findAllComplete($id_programacion){
        return $this->select("programacion_local.id,programacion_local.id_programacion,programacion_local.id_programacion_ruta, programacion_local.id_local, programacion_local.fechaRegistro, l.descripcion l_descripcion, l.ruc l_ruc, l.id_canal, c.descripcion c_descripcion, l.id_zona, z.descripcion z_descripcion, l.id_tipo_via, tv.descripcion tv_descripcion, l.nombre_via, l.numero")
            ->join("local l"," l.id = programacion_local.id_local")
            ->join("canal c","c.id = l.id_canal")
            ->join("zona z","z.id = l.id_zona")
            ->join("tipo_via tv","tv.id = l.id_tipo_via")
            ->where("programacion_local.id_programacion",$id_programacion)
            ->where("programacion_local.estado","1")
            ->get()->getResultArray();
    }
}
