<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaInscripcionModel extends Model {

    protected $table = 'oferta_educativa_inscripcion';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_oferta_educativa','url','descripcion','is_deleted','updated_at'];

}