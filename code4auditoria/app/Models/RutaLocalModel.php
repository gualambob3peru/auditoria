<?php

namespace App\Models;

use CodeIgniter\Model;

class RutaLocalModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'ruta_local';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_ruta','id_local',"secuencia","secuencia","estado"];

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

    public function findComplete($id){
        return $this->select("ruta_local.id rl_id, ruta_local.id_ruta, ruta_local.id_local, l.id l_id, l.descripcion l_descripcion, l.ruc l_ruc, l.id_canal, c.descripcion c_descripcion, l.id_zona, z.descripcion z_descripcion, l.id_tipo_via, tv.descripcion tv_descripcion")
                ->join("local l","l.id = ruta_local.id_local")
                ->join("canal c","c.id = l.id_canal")
                ->join("zona z","z.id = l.id_zona")
                ->join("tipo_via tv","tv.id = l.id_tipo_via")
                ->where("ruta_local.id_ruta",$id)
                ->get()->getResultArray();

    
    }
}
