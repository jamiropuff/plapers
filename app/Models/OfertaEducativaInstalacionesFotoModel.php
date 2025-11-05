<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaInstalacionesFotoModel extends Model {

    protected $table = 'oferta_educativa_instalaciones_foto';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_oferta_educativa_instalaciones','foto','orden','is_deleted','updated_at'];

}