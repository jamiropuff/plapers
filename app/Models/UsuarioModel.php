<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;
use Config\Services;

class UsuarioModel extends Model
{

    protected $table = 't_usuarios';
    protected $primaryKey = 'id_user';
    protected $returnType = 'object';
    protected $allowedFields = ['username', 'correo_electronico', 'password', 'remember_token', 'active'];
    protected $db;

    public function passHash($passHash)
    {
        return password_hash($passHash, PASSWORD_DEFAULT);
    }

    public function verifyPass($passText, $passHash)
    {
        return password_verify($passText, $passHash);
    }

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    /* ======================================================
       REGISTRO
    ====================================================== */
    public function try_register($Nombres, $Paterno, $Materno, $Correo, $User, $Pass)
    {
        $builder = $this->db->table('t_usuarios');
        $builder->groupStart()
            ->where('username', $User)
            ->orWhere('correo_electronico', $Correo)
            ->groupEnd();

        if ($builder->countAllResults() > 0) {
            return [
                'Code' => REQUEST_FAILED,
                'Msg'  => 'Ese correo o usuario ya existe'
            ];
        }

        $this->db->transStart();

        $this->db->table('t_usuarios')->insert([
            'username' => $User,
            'id_rol'   => 2,
            'password' => password_hash($Pass, PASSWORD_BCRYPT),
            'correo_electronico' => $Correo
        ]);

        $Id_User = $this->db->insertID();

        $this->db->table('t_info_usuarios')->insert([
            'id_user' => $Id_User,
            'nombres' => $Nombres,
            'paterno' => $Paterno,
            'materno' => $Materno
        ]);

        $token = 'plap' . date('YmdHis') . '-u' . $Id_User . '-' . bin2hex(random_bytes(8));

        $this->db->table('t_usuarios')
            ->where('id_user', $Id_User)
            ->update(['remember_token' => $token]);

        session()->set([
            'User'    => $User,
            'Nombres' => $Nombres,
            'Rol'     => 2,
            'Nom_Rol' => 'Usuario'
        ]);

        $this->db->transComplete();

        return [
            'Code'           => REQUEST_SUCCESS,
            'Status'         => 1,
            'Msg'            => 'Registro exitoso',
            'Remember_Token' => $token
        ];
    }

    /* ======================================================
       VALIDAR TOKEN
    ====================================================== */
    public function valida_token($Token)
    {
        $tokenArr = explode('-', $Token);
        $Id_User = substr($tokenArr[1], 1);

        $builder = $this->db->table('t_usuarios');
        $builder->where([
            'id_user' => $Id_User,
            'remember_token' => $Token
        ]);

        return [
            'Code'   => $builder->countAllResults() > 0 ? REQUEST_SUCCESS : REQUEST_FAILED,
            'Status' => $builder->countAllResults() > 0 ? 1 : 0,
            'Msg'    => $builder->countAllResults() > 0 ? 'Token válido' : 'Sesión expirada'
        ];
    }

    public function obtiene_datos_facturacion($Token)
    {
        $tokenArr = explode('-', $Token);
        $Id_User  = substr($tokenArr[1], 1);

        $Valid = $this->valida_token($Token);

        $Response = [
            'Code' => REQUEST_FAILED,
            'Msg'  => 'Token inválido'
        ];

        if ($Valid['Status'] === 1) {

            $builder = $this->db->table('cat_datos_facturacion');
            $builder->select('id_facturacion, nombres, paterno, materno, razon_social, rfc, curp, calle, numero, interior, colonia, municipio, estado, codigo_postal, pais, uso, tipo_persona');
            $builder->where('id_user', $Id_User);

            $query = $builder->get();

            $direcciones = [];

            foreach ($query->getResult() as $row) {
                $direcciones[] = [
                    'Id_Facturacion' => $row->id_facturacion,
                    'Nombres'        => $row->nombres,
                    'Paterno'        => $row->paterno,
                    'Materno'        => $row->materno,
                    'Razon_Social'   => $row->razon_social,
                    'RFC'            => $row->rfc,
                    'CURP'           => $row->curp,
                    'Calle'          => $row->calle,
                    'Numero'         => $row->numero,
                    'Interior'       => $row->interior,
                    'Colonia'        => $row->colonia,
                    'Codigo_Postal'  => $row->codigo_postal,
                    'Municipio'      => $row->municipio,
                    'Estado'         => $row->estado,
                    'Pais'           => $row->pais,
                    'Uso'            => $row->uso,
                    'Tipo_Persona'   => $row->tipo_persona
                ];
            }

            $Response = [
                'Code'         => REQUEST_SUCCESS,
                'Msg'          => 'Token válido',
                'Direcciones'  => $direcciones
            ];
        }

        return $Response;
    }

    public function obtiene_datos_direcciones($Token)
    {
        $tokenArr = explode('-', $Token);
        $Id_User  = substr($tokenArr[1], 1);

        $Valid = $this->valida_token($Token);

        $Response = [
            'Code' => REQUEST_FAILED,
            'Msg'  => 'Token inválido'
        ];

        if ($Valid['Status'] === 1) {

            $builder = $this->db->table('cat_direcciones');
            $builder->select('id_direccion, recibe, calle, numero, interior, colonia, municipio, estado, codigo_postal, pais, referencia, notas_adicionales, telefono');
            $builder->where('id_user', $Id_User);

            $query = $builder->get();

            $direcciones = [];

            foreach ($query->getResult() as $row) {
                $direcciones[] = [
                    'Id_Direccion'     => $row->id_direccion,
                    'Recibe'           => $row->recibe,
                    'Calle'            => $row->calle,
                    'Numero'           => $row->numero,
                    'Interior'         => $row->interior,
                    'Colonia'          => $row->colonia,
                    'Codigo_Postal'    => $row->codigo_postal,
                    'Municipio'        => $row->municipio,
                    'Estado'           => $row->estado,
                    'Pais'             => $row->pais,
                    'Referencia'       => $row->referencia,
                    'Telefono'         => $row->telefono,
                    'Notas_Adicionales' => $row->notas_adicionales
                ];
            }

            $Response = [
                'Code'        => REQUEST_SUCCESS,
                'Msg'         => 'Token válido',
                'Direcciones' => $direcciones
            ];
        }

        return $Response;
    }

    public function registra_direccion(
        $Token,
        $Recibe,
        $Calle,
        $Numero,
        $Interior,
        $Colonia,
        $Municipio,
        $Estado,
        $Codigo_Postal,
        $Referencia,
        $Notas,
        $Pais,
        $Telefono
    ) {
        $tokenArr = explode('-', $Token);
        $Id_User  = substr($tokenArr[1], 1);

        $Valid = $this->valida_token($Token);

        $Response = [
            'Code' => REQUEST_FAILED,
            'Msg'  => 'Token inválido'
        ];

        if ($Valid['Status'] === 1) {

            $dataDireccion = [
                'id_user'          => $Id_User,
                'recibe'           => $Recibe,
                'calle'            => $Calle,
                'numero'           => $Numero,
                'interior'         => $Interior,
                'colonia'          => $Colonia,
                'telefono'         => $Telefono,
                'municipio'        => $Municipio,
                'estado'           => $Estado,
                'codigo_postal'    => $Codigo_Postal,
                'referencia'       => $Referencia,
                'notas_adicionales' => $Notas,
                'pais'             => $Pais
            ];

            $builder = $this->db->table('cat_direcciones');

            if ($builder->insert($dataDireccion)) {
                $Response = [
                    'Code' => REQUEST_SUCCESS,
                    'Id'   => $this->db->insertID(),
                    'Msg'  => 'Token válido'
                ];
            }
        }

        return $Response;
    }

    public function registra_facturacion(
        $Token,
        $Razon_Social,
        $RFC,
        $CURP,
        $Nombres,
        $Paterno,
        $Materno,
        $Calle,
        $Numero,
        $Interior,
        $Colonia,
        $Municipio,
        $Estado,
        $Codigo_Postal,
        $Pais,
        $Uso,
        $Tipo_Persona,
        $Documento_situacion_fiscal
    ) {
        $tokenArr = explode('-', $Token);
        $Id_User  = substr($tokenArr[1], 1);

        $Valid = $this->valida_token($Token);

        $Response = [
            'Code' => REQUEST_FAILED,
            'Msg'  => 'Token inválido'
        ];

        if ($Valid['Status'] === 1) {

            $dataDireccion = [
                'id_user'                   => $Id_User,
                'razon_social'              => $Razon_Social,
                'rfc'                       => $RFC,
                'curp'                      => $CURP,
                'nombres'                   => $Nombres,
                'paterno'                   => $Paterno,
                'materno'                   => $Materno,
                'calle'                     => $Calle,
                'numero'                    => $Numero,
                'interior'                  => $Interior,
                'colonia'                   => $Colonia,
                'municipio'                 => $Municipio,
                'estado'                    => $Estado,
                'codigo_postal'             => $Codigo_Postal,
                'pais'                      => $Pais,
                'uso'                       => $Uso,
                'tipo_persona'              => $Tipo_Persona,
                'documento_situacion_fiscal' => $Documento_situacion_fiscal
            ];

            $builder = $this->db->table('cat_datos_facturacion');

            if ($builder->insert($dataDireccion)) {
                $Response = [
                    'Code' => REQUEST_SUCCESS,
                    'Id'   => $this->db->insertID(),
                    'Msg'  => 'Token válido'
                ];
            }
        }

        return $Response;
    }

    public function registra_orden(
        $Token,
        $Id_Tipo_Pago,
        $Id_Estatus_Pago,
        $Id_Tipo_Envio,
        $Id_Estatus_Pedido,
        $Subtotal,
        $Iva,
        $Envio,
        $Total,
        $Id_Direccion,
        $Id_Facturacion,
        $Notas_Adicionales,
        $Id_uso
    ) {
        $tokenArr = explode('-', $Token);
        $Id_User  = substr($tokenArr[1], 1);

        $Valid = $this->valida_token($Token);

        $Response = [
            'Code' => REQUEST_FAILED,
            'Msg'  => 'Token inválido'
        ];

        if ($Valid['Status'] === 1) {

            $dataOrden = [
                'id_user'              => $Id_User,
                'id_tipo_pago'         => $Id_Tipo_Pago,
                'id_tipo_envio'        => $Id_Tipo_Envio,
                'id_estatus_pago'      => $Id_Estatus_Pago,
                'id_estatus_pedido'    => $Id_Estatus_Pedido,
                'subtotal'             => $Subtotal,
                'iva'                  => $Iva,
                'envio'                => $Envio,
                'total'                => $Total,
                'id_direccion'         => $Id_Direccion,
                'id_facturacion'       => $Id_Facturacion,
                'id_uso'               => $Id_uso,
                'fecha_pedido'         => date('Y-m-d'),
                'observaciones_usuario' => $Notas_Adicionales
            ];

            $builder = $this->db->table('plap_t_orden');

            if ($builder->insert($dataOrden)) {

                $orderId = $this->db->insertID();

                $Response = [
                    'Code' => REQUEST_SUCCESS,
                    'Id'   => $orderId,
                    'Msg'  => 'Token válido'
                ];

                // Depósito Bancario
                if ((int) $Id_Tipo_Pago === 2) {
                    $this->envia_correo_orden(
                        $Id_User,
                        $orderId,
                        $Id_Tipo_Pago,
                        $dataOrden
                    );
                }
            }
        }

        return $Response;
    }

    public function envia_correo_orden($Id_User, $Id_Pedido, $Id_Tipo_Pago, $Datos_Orden)
    {
        $Datos_User = $this->obtiene_usuario_por_id($Id_User);

        $correo = 'Hola, te confirmamos que ya recibimos tu pedido y para que lo podamos fabricar, '
            . 'necesitas subir tu comprobante de pago, dando click '
            . '<a href="https://plapers.com.mx/login" target="_blank">aquí</a>. '
            . 'Te recordamos que nuestra información bancaria es:<br><br>';

        // Depósito Bancario
        if ((int) $Id_Tipo_Pago === 2) {

            $datos_bancarios = $this->saca_datos_bancarios();

            foreach ($datos_bancarios as $cuenta) {
                $correo .= '<table border="0" cellpadding="4">';
                $correo .= '<tr><td>BENEFICIARIO</td><td>' . $cuenta['Beneficiario'] . '</td></tr>';
                $correo .= '<tr><td>BANCO</td><td>' . $cuenta['Banco'] . '</td></tr>';
                $correo .= '<tr><td>NO. CUENTA</td><td>' . $cuenta['Cuenta'] . '</td></tr>';
                $correo .= '<tr><td>CLABE</td><td>' . $cuenta['CLABE'] . '</td></tr>';

                if (!empty($cuenta['Sucursal'])) {
                    $correo .= '<tr><td>SUCURSAL</td><td>' . $cuenta['Sucursal'] . '</td></tr>';
                }

                $correo .= '<tr><td>NO. TARJETA DE DÉBITO</td><td>' . $cuenta['Tarjeta_Debito'] . '</td></tr>';
                $correo .= '</table><br><br>';
            }

            $correo .= 'Cualquier duda y/o aclaración estamos a tus órdenes.<br><br>';
            $correo .= 'Muchas gracias.';
        }

        // Servicio de Email CI4
        $email = Services::email();

        $email->setFrom('ventas@plapers.com.mx', 'PLAPERS');
        $email->setTo($Datos_User['Email']);
        $email->setSubject(
            'Tu pedido [# ' . $Id_Pedido . '] en PLAPERS con fecha ' . date('d-m-Y') . ' ha sido registrado'
        );
        $email->setMessage($correo);
        $email->setMailType('html');

        if (!$email->send()) {
            return [
                'Status' => 0,
                'Msg'    => 'Falló el envío de correo'
            ];
        }

        return [
            'Status' => 1,
            'Msg'    => 'Envío de correo exitoso.'
        ];
    }

    public function saca_datos_bancarios()
    {
        $builder = $this->db->table('cat_cuenta_deposito');

        $builder->select('cuenta, sucursal, banco, beneficiario, clabe, tarjeta_debito');
        $builder->where('activo', 1);

        $query = $builder->get();

        $datos = [];

        foreach ($query->getResultArray() as $row) {
            $datos[] = [
                'Cuenta'          => $row['cuenta'],
                'Sucursal'        => $row['sucursal'],
                'Banco'           => $row['banco'],
                'Beneficiario'    => $row['beneficiario'],
                'CLABE'            => $row['clabe'],
                'Tarjeta_Debito'  => $row['tarjeta_debito']
            ];
        }

        return $datos;
    }

    public function registra_producto(
        $Token,
        $Id_Orden,
        $Id_Producto,
        $Nom_Categoria,
        $Nom_Producto,
        $Id_Posicion,
        $Texto_Linea1,
        $Fuente_Linea1,
        $Caracteres_Linea1,
        $Texto_Linea2,
        $Fuente_Linea2,
        $Caracteres_Linea2,
        $Texto_Linea3,
        $Fuente_Linea3,
        $Caracteres_Linea3,
        $Id_Color,
        $Id_Terminado,
        $Foto,
        $Cantidad,
        $Precio_Unitario,
        $Total
    ) {
        $tokenArr = explode('-', $Token);
        $Id_User  = substr($tokenArr[1], 1);

        $Valid = $this->valida_token($Token);

        $Response = [
            'Code' => REQUEST_FAILED,
            'Msg'  => 'Token inválido'
        ];

        if ($Valid['Status'] === 1) {

            $dataProducto = [
                'id_user'              => $Id_User,
                'id_orden'             => $Id_Orden,
                'id_producto'          => $Id_Producto,
                'nom_categoria'        => $Nom_Categoria,
                'nom_producto'         => $Nom_Producto,
                'id_posicion'          => $Id_Posicion,
                'texto_linea1'         => $Texto_Linea1,
                'fuente_linea1'        => $Fuente_Linea1,
                'caracteres_linea1'    => $Caracteres_Linea1,
                'texto_linea2'         => $Texto_Linea2,
                'fuente_linea2'        => $Fuente_Linea2,
                'caracteres_linea2'    => $Caracteres_Linea2,
                'texto_linea3'         => $Texto_Linea3,
                'fuente_linea3'        => $Fuente_Linea3,
                'caracteres_linea3'    => $Caracteres_Linea3,
                'id_color'             => $Id_Color,
                'id_terminado'         => $Id_Terminado,
                'foto'                 => $Foto,
                'cantidad'             => $Cantidad,
                'precio_unitario'      => $Precio_Unitario,
                'total'                => $Total
            ];

            $builder = $this->db->table('plap_t_orden_producto');

            if ($builder->insert($dataProducto)) {
                $Response['Code'] = REQUEST_SUCCESS;
                $Response['Id']   = $Id_Orden;
                $Response['Msg']  = 'Token válido';
            }
        }

        return $Response;
    }

    public function obtiene_usuario_por_id($Id_User)
    {
        $builder = $this->db->table('t_usuarios tu');

        $builder->select('
        tu.id_user,
        cr.id_rol,
        cr.nom_rol,
        tiu.nombres,
        tiu.paterno,
        tiu.materno,
        tiu.correo_electronico,
        tu.username,
        tu.active
    ');

        $builder->join('t_info_usuarios tiu', 'tu.id_user = tiu.id_user');
        $builder->join('cat_roles cr', 'tu.id_rol = cr.id_rol');
        $builder->where('tu.id_user', $Id_User);

        $query = $builder->get();

        if ($query->getNumRows() === 0) {
            return null;
        }

        $row = $query->getRow();

        return [
            'Nombres' => $row->nombres,
            'Paterno' => $row->paterno,
            'Materno' => $row->materno,
            'Email'   => $row->correo_electronico,
            'User'    => $row->username,
            'Id_User' => $row->id_user,
            'Id_Rol'  => $row->id_rol,
            'Nom_Rol' => $row->nom_rol,
            'Activo'  => $row->active == 1 ? 'Si' : 'No'
        ];
    }

    public function lista_usuarios($tipo = 'user')
    {
        $builder = $this->db->table('plap_t_usuarios a');
        $builder->select('a.id_user, c.id_rol, c.nom_rol, b.nombres, b.paterno, b.materno, a.correo_electronico, a.username, a.active');
        $builder->join('plap_t_info_usuarios b', 'a.id_user = b.id_user');
        $builder->join('plap_cat_roles c', 'a.id_rol = c.id_rol');

        // 🔥 Filtro por tipo
        if ($tipo === 'user') {
            $builder->where('a.id_rol', 2);
        } elseif ($tipo === 'staff') {
            $builder->where('a.id_rol !=', 2);
        }

        $builder->orderBy('c.id_rol', 'ASC');
        $builder->orderBy('b.nombres', 'ASC');

        $query = $builder->get();


        // 🔥 Validación obligatoria en CI4
        if ($query === false) {
            log_message('error', print_r($this->db->error(), true));
            return [];
        }

        $datos = [];

        foreach ($query->getResult() as $row) {
            $datos[] = [
                'Nombres' => $row->nombres,
                'Paterno' => $row->paterno,
                'Materno' => $row->materno,
                'Email'   => $row->correo_electronico,
                'User'    => $row->username,
                'Id_User' => $row->id_user,
                'Id_Rol'  => $row->id_rol,
                'Nom_Rol' => $row->nom_rol,
                'Activo'  => $row->active == 1 ? 'Si' : 'No'
            ];
        }

        return [
            "Code"            => REQUEST_SUCCESS,
            "Usuarios"        => $datos
        ];
    }

    public function edita_usuario(array $data)
    {
        $db = $this->db;
        $response = ['Code' => REQUEST_SUCCESS];

        $db->transStart();

        // 🔹 Actualiza t_usuarios
        $updateUsuarios = [
            'username'          => $data['user'],
            'correo_electronico' => $data['email'],
            'id_rol'            => $data['id_rol']
        ];

        if (!empty($data['password'])) {
            $updateUsuarios['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $db->table('t_usuarios')
            ->where('id_user', $data['id_user'])
            ->update($updateUsuarios);

        // 🔹 Actualiza t_info_usuarios
        $updateInfo = [
            'nombres' => $data['nombres'],
            'paterno' => $data['paterno'],
            'materno' => $data['materno']
        ];

        $db->table('t_info_usuarios')
            ->where('id_user', $data['id_user'])
            ->update($updateInfo);

        $db->transComplete();

        if ($db->transStatus() === false) {
            $response['Code'] = REQUEST_FAILED;
        }

        return $response;
    }

    public function obtiene_usuario_por_correo(string $correo)
    {
        $builder = $this->db->table('plap_t_usuarios tu');

        $builder->select('
        tu.id_user,
        tiu.nombres,
        tiu.paterno,
        tiu.materno,
        tu.correo_electronico
    ');

        $builder->join('plap_t_info_usuarios tiu', 'tu.id_user = tiu.id_user');
        $builder->where('tu.correo_electronico', $correo);
        $builder->where('tu.active', 1);

        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();

            return [
                'Nombres' => $row->nombres,
                'Paterno' => $row->paterno,
                'Materno' => $row->materno,
                'Email'   => $row->correo_electronico,
                'Id_User' => $row->id_user,
                'status'  => 1
            ];
        }

        return [
            'Msg'    => 'no se encontro el usuario',
            'status' => 0
        ];
    }

    public function try_recovery(string $correo): array
    {
        $datosUser = $this->obtiene_usuario_por_correo($correo);

        if (($datosUser['status'] ?? 0) !== 1) {
            return [
                'Msg'    => 'Correo no encontrado',
                'status' => 0
            ];
        }

        $idUser = $datosUser['Id_User'];

        $tokenRecovery = 'r' . date('YmdHis') . '-u' . $idUser . '-' . bin2hex(random_bytes(8));

        $mensaje = '
        Hola, te confirmamos que estás solicitando el cambio de tu contraseña,
        por favor, da click 
        <a href="https://plapers.com.mx/login/change_pass/?t=' . $tokenRecovery . '" target="_blank">aquí</a>.
        <br><br>
        Cualquier duda y/o aclaración estamos a tus órdenes.
        <br><br>
        Muchas gracias.
    ';

        $email = Services::email();

        $email->setFrom('ventas@plapers.com.mx', 'PLAPERS');
        $email->setTo($datosUser['Email']);
        $email->setSubject('Modifica tu contraseña en PLAPERS');
        $email->setMessage($mensaje);
        $email->setMailType('html');

        if (!$email->send()) {
            return [
                'Msg'    => 'Falló el envío de correo',
                'status' => 0
            ];
        }

        return [
            'Msg'    => 'Envío de correo exitoso.',
            'status' => 1,
            'token'  => $tokenRecovery // opcional, útil para pruebas
        ];
    }

    /* ======================================================
       CAMBIO DE PASSWORD
    ====================================================== */
    public function try_changepass($Pass, $Token)
    {
        $tokenArr = explode('-', $Token);
        $Id_User = substr($tokenArr[1], 1);

        $builder = $this->db->table('plap_t_usuarios');
        $builder->where(['id_user' => $Id_User, 'active' => 1]);

        if ($builder->countAllResults() === 0) {
            return [
                'Code'   => REQUEST_FAILED,
                'Status' => 0,
                'Msg'    => 'Usuario inválido'
            ];
        }

        $builder->where('id_user', $Id_User)
            ->update(['password' => password_hash($Pass, PASSWORD_BCRYPT)]);

        return [
            'Code'   => REQUEST_SUCCESS,
            'Status' => 1,
            'Msg'    => 'Password actualizado'
        ];
    }
}
