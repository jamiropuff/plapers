<?php

namespace App\Models;

use CodeIgniter\Model;

class ProspectoModel extends Model {

    protected $table = 'prospectos';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['nombres','apellidos','email','telefono','plantel','interes','medio_entero','mensaje','fecha_upd'];

}