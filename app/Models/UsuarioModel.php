<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {

    protected $table = 't_usuarios';
    protected $primaryKey = 'id_user';
    protected $returnType = 'object';
    protected $allowedFields = ['username','correo_electronico','password', 'remember_token'];

    public function passHash($passHash) {
        return password_hash($passHash, PASSWORD_DEFAULT);
    }

    public function verifyPass($passText, $passHash) {
        return password_verify($passText, $passHash);
    }

}