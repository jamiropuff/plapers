<?php

namespace App\Models;

use CodeIgniter\Model;

class BoletinModel extends Model
{

    protected $table = 'cat_boletin';
    protected $primaryKey = 'id_boletin';
    protected $returnType = 'object';
    protected $allowedFields = [
        'correo',
        'fecha_add',
        'activo'
    ];
    protected $db;

    public function registra_correo(string $email): array
    {
        $response = [];

        $row = $this->select('activo')
                    ->where('correo', $email)
                    ->first();

        if (!$row) {
            $data = [
                'correo'    => $email,
                'fecha_add' => date('Y-m-d'),
                'activo'    => 1
            ];

            $this->insert($data);
            $response['Code'] = REQUEST_SUCCESS;

        } else {
            $response['Code'] = REQUEST_FAILED;
            $response['Msg']  = 'El correo seleccionado ya está registrado en el boletín';
        }

        return $response;
    }

    public function lista_suscritos()
    {
        return $this->select('correo, fecha_add')
                    ->where('activo', 1)
                    ->findAll();
    }
}
