<?php

namespace App\Models;

use CodeIgniter\Model;

class CatTipoUsuarioModel extends Model {

    protected $table = 'cat_tipo_usuario';
    protected $primaryKey = 'id_tipo_usuario';
    protected $returnType = 'object';
    protected $allowedFields = ['tipo_usuario'];

}