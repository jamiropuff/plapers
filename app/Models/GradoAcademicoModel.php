<?php

namespace App\Models;

use CodeIgniter\Model;

class GradoAcademicoModel extends Model {

    protected $table = 'cat_grado_academico';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['nombre','updated_at'];

}