<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaEventosModel extends Model {

    protected $table = 'oferta_educativa_eventos';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_oferta_educativa','imagen','titulo','fecha_inicio','fecha_fin','orden','is_deleted','updated_at'];

}