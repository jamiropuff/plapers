<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class ClienteModel extends Model
{

    protected $table = 't_usuarios';
    protected $primaryKey = 'id_user';
    protected $returnType = 'object';
    protected $allowedFields = [];
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function obtiene_datos_cliente($Id_Rol)
    {
        if (empty($Id_Rol)) {
            return [
                "Code" => REQUEST_FAILED,
                "Msg"  => "Rol del Usuario inválido"
            ];
        }

        if (!in_array($Id_Rol, [1, 3])) {
            return [
                "Code" => REQUEST_FAILED,
                "Msg"  => "Rol de usuario no permitido"
            ];
        }

        $builder = $this->db->table('plap_t_usuarios a');
        $builder->select('a.id_user, b.nombres, b.paterno, b.materno, a.correo_electronico, a.id_tipo_usuario, a.active, a.fecha_add');
        $builder->join('plap_t_info_usuarios b', 'a.id_user = b.id_user');
        $builder->where('a.id_rol', 2);
        $builder->orderBy('a.active', 'ASC');
        $builder->orderBy('b.nombres', 'ASC');

        $query = $builder->get();

        $clientes = [];
        foreach ($query->getResult() as $row) {
            $clientes[] = [
                "Id_User"            => $row->id_user,
                "Nombre"             => $row->nombres,
                "Paterno"            => $row->paterno,
                "Materno"            => $row->materno,
                "Correo_Electronico" => $row->correo_electronico,
                "Id_Tipo_Usuario"    => $row->id_tipo_usuario,
                "Active"             => $row->active,
                "Fecha_Add"          => $row->fecha_add
            ];
        }

        return [
            "Code"            => REQUEST_SUCCESS,
            "Clientes"        => $clientes,
            "CatTipo_Usuario" => $this->listado_tipo_usuario()
        ];
    }

    public function obtiene_datos_cliente_id($Id_User)
    {
        $Id_Rol = session()->get("Rol");

        if (!in_array($Id_Rol, [1, 3])) {
            return ["Code" => REQUEST_FAILED, "Msg" => "Rol de usuario no permitido"];
        }

        if (empty($Id_User)) {
            return ["Code" => REQUEST_FAILED, "Msg" => "ID del Usuario inválido"];
        }

        $builder = $this->db->table('plap_t_usuarios a');
        $builder->select('a.id_user, b.nombres, b.paterno, b.materno, a.correo_electronico, a.active, a.fecha_add');
        $builder->join('plap_t_info_usuarios b', 'a.id_user = b.id_user');
        $builder->where('a.id_user', $Id_User);

        $query = $builder->get();

        $clientes = [];
        foreach ($query->getResult() as $row) {
            $clientes[] = [
                "Id_User"            => $row->id_user,
                "Nombre"             => $row->nombres,
                "Paterno"            => $row->paterno,
                "Materno"            => $row->materno,
                "Correo_Electronico" => $row->correo_electronico,
                "Active"             => $row->active,
                "Fecha_Add"          => $row->fecha_add
            ];
        }

        return [
            "Code"     => REQUEST_SUCCESS,
            "Clientes" => $clientes
        ];
    }

    public function obtiene_cliente_info($Id_User)
    {
        if (!in_array(session()->get("Rol"), [1, 3])) {
            return ["Code" => REQUEST_FAILED, "Msg" => "Rol de usuario no permitido"];
        }

        return [
            "Code"                  => REQUEST_SUCCESS,
            "Clientes"              => $this->obtiene_datos_cliente_id($Id_User)["Clientes"],
            "Direccion_Envio"       => $this->obtiene_cliente_direccion_envio($Id_User),
            "Direccion_Facturacion" => $this->obtiene_cliente_direccion_facturacion($Id_User)
        ];
    }

    public function obtiene_cliente_direccion_envio($Id_User)
    {
        $builder = $this->db->table('plap_cat_direcciones');
        $builder->where('id_user', $Id_User);
        $query = $builder->get();

        $data = [];
        foreach ($query->getResult() as $row) {
            $estado = $this->estado($row->estado)[0]['Nombre_Estado'] ?? '';
            $pais   = $this->pais($row->pais)[0]['Nombre_Pais'] ?? '';

            $data[] = [
                "Id_Direccion" => $row->id_direccion,
                "Calle"        => $row->calle,
                "Estado"       => $estado,
                "Pais"         => $pais
            ];
        }

        return $data;
    }

    public function obtiene_cliente_direccion_facturacion($Id_User)
    {
        $builder = $this->db->table('plap_cat_datos_facturacion');
        $builder->where('id_user', $Id_User);
        $query = $builder->get();

        $data = [];
        foreach ($query->getResult() as $row) {
            $estado = $this->estado($row->estado)[0]['Nombre_Estado'] ?? '';
            $pais   = $this->pais($row->pais)[0]['Nombre_Pais'] ?? '';

            $data[] = [
                "Id_Facturacion" => $row->id_facturacion,
                "Razon_Social"   => $row->razon_social,
                "Rfc"            => $row->rfc,
                "Estado"         => $estado,
                "Pais"           => $pais
            ];
        }

        return $data;
    }

    public function cambia_tipo_usuario($id_usuario, $id_tipo_usuario, $id_user)
    {
        $tipo = $this->db->table('plap_cat_tipo_usuario')
            ->where('id_tipo_usuario', $id_tipo_usuario)
            ->get()
            ->getRow();

        $updated = $this->db->table('plap_t_usuarios')
            ->where('id_user', $id_usuario)
            ->update([
                'id_tipo_usuario' => $id_tipo_usuario,
                'id_user_upd'     => $id_user,
                'fecha_upd'       => date('Y-m-d H:i:s')
            ]);

        if (!$updated) {
            return ["DB_Code" => QUERY_FAILED, "Msg" => "Error en BD"];
        }

        return [
            "DB_Code"         => REQUEST_SUCCESS,
            "Msg"             => "Se actualizó el tipo de usuario",
            "Tipo_Usuario"    => $tipo
        ];
    }

    public function listado_tipo_usuario()
    {
        return $this->db->table('plap_cat_tipo_usuario')
            ->orderBy('id_tipo_usuario', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function estado($Id_Estado)
    {
        return $this->db->table('plap_cat_estados')
            ->where('id_estado', $Id_Estado)
            ->get()
            ->getResultArray();
    }

    public function pais($Id_Pais)
    {
        return $this->db->table('plap_cat_paises')
            ->where('id_pais', $Id_Pais)
            ->get()
            ->getResultArray();
    }
}
