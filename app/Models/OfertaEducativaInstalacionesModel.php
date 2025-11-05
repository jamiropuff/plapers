<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaInstalacionesModel extends Model {

    protected $table = 'oferta_educativa_instalaciones';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_oferta_educativa','texto','orden','is_deleted','updated_at'];

}