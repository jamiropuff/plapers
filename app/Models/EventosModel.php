<?php

namespace App\Models;

use CodeIgniter\Model;

class EventosModel extends Model {

    protected $table = 'eventos';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['imagen','titulo','fecha_inicio','fecha_fin','archivo_presencial','archivo_zoom','orden','is_deleted'];

}