<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['usuario','email','pass'];

    public function passHash($passHash) {
        return password_hash($passHash, PASSWORD_DEFAULT);
    }

    public function verifyPass($passText, $passHash) {
        return password_verify($passText, $passHash);
    }

}