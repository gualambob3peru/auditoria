<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramacionLocalCategoriaModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'programacion_local_categoria';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_programacion_local','id_local','id_categoria','id_frecuencia','estado'];

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

    public function findAllComplete($id_programacion_local){
        /*return $this->select("programacion_local_categoria.id,programacion_local_categoria.id_programacion_local,programacion_local_categoria.id_local, programacion_local_categoria.id_categoria, c.descripcion c_descripcion,programacion_local_categoria.id_frecuencia, f.descripcion f_descripcion, programacion_local_categoria.fechaRegistro, programacion_local_categoria.estado,fm.accion")
 
            ->join("categoria c","c.id = programacion_local_categoria.id_categoria")
            ->join("frecuencia f","f.id = programacion_local_categoria.id_frecuencia")
            ->join("frecuencia_mes fm","fm.id_frecuencia = f.id")
            ->where("programacion_local_categoria.id_programacion_local",$id_programacion_local)
            ->where("programacion_local_categoria.estado","1")
            ->where("fm.fecha","CONVERT(SUBSTR('2022-05-19', 6, 2),SIGNED)",FALSE)
            ->get()->getResultArray();*/
        return $this->select("programacion_local_categoria.id,programacion_local_categoria.id_programacion_local,programacion_local_categoria.id_local, programacion_local_categoria.id_categoria, c.descripcion c_descripcion,programacion_local_categoria.id_frecuencia, programacion_local_categoria.fechaRegistro, programacion_local_categoria.estado")
            ->join("categoria c","c.id = programacion_local_categoria.id_categoria")
            ->where("programacion_local_categoria.id_programacion_local",$id_programacion_local)
            ->where("programacion_local_categoria.estado","1")
            ->get()->getResultArray();
    }
}
