<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonalModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'personal';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['nombres', 'apellidoPaterno', 'apellidoMaterno', 'password', 'password2', 'email', 'telefono', 'idCargo', 'estado', 'idTipoDocumento', 'nroDocumento'];

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

    public function findComplete($id = null)
    {



        if ($id) {
            $personals = $this->select("personal.id , personal.nombres, personal.apellidoPaterno, personal.apellidoMaterno, personal.email, personal.telefono, personal.idCargo, personal.estado, personal.idTipoDocumento, personal.nroDocumento, personal.created_at, c.descripcion c_descripcion, tp.descripcion tp_descripcion")
                ->join("cargo c", "c.id = personal.idCargo")
                ->join("tipo_documento tp", "tp.id = personal.idTipoDocumento")
                ->where("personal.estado", "1")
                ->where("personal.id",$id)
                ->get()->getResult();
        } else {
            $personals = $this->select("personal.id , personal.nombres, personal.apellidoPaterno, personal.apellidoMaterno, personal.email, personal.telefono, personal.idCargo, personal.estado, personal.idTipoDocumento, personal.nroDocumento, personal.created_at, c.descripcion c_descripcion, tp.descripcion tp_descripcion")
                ->join("cargo c", "c.id = personal.idCargo")
                ->join("tipo_documento tp", "tp.id = personal.idTipoDocumento")
                ->where("personal.estado", "1")
                ->get()->getResult();
        }

        return $personals;
    }
}
