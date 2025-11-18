<?php

namespace App\Models;

use CodeIgniter\Model;

class CatTipoEnvioModel extends Model {

    protected $table = 'cat_tipo_envio';
    protected $primaryKey = 'id_tipo_envio';
    protected $returnType = 'object';
    protected $allowedFields = ['tipo_envio'];

}