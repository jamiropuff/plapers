<?php

namespace App\Models;

use CodeIgniter\Model;

class CatRolesModel extends Model {

    protected $table = 'cat_roles';
    protected $primaryKey = 'id_rol';
    protected $returnType = 'object';
    protected $allowedFields = ['nom_rol'];

}