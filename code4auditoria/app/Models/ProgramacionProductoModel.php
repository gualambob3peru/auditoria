<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramacionProductoModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'programacion_producto';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_programacion_categoria','id_producto','estado'];

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

    public function findAllComplete($id_programacion_categoria){
        return $this->select("programacion_producto.id,programacion_producto.id_programacion_categoria, programacion_producto.id_producto, programacion_producto.fechaRegistro, programacion_producto.estado, p.descripcion p_descripcion, p.sku")
            ->join("producto p","p.id = programacion_producto.id_producto")
            ->where("programacion_producto.id_programacion_categoria",$id_programacion_categoria)
            ->where("programacion_producto.estado","1")
            ->get()->getResultArray();
    }
}
