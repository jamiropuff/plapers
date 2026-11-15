<?php

namespace App\Controllers;

use App\Models\CatalogosModel;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Models\UsuarioModel;

class CarritoController extends BaseController
{

    protected $catalogosModel;
    protected $productoModel;
    protected $categoriaModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->catalogosModel = new CatalogosModel();
        $this->productoModel = new ProductoModel();
        $this->categoriaModel = new CategoriaModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function carrito()
    {

        $data = array(
            'Titulo' => "Carrito",
            'Descripcion' => "Carrito de compras",
            'cargarScriptsCarrito' => true
        );

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('store/cart', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    public function catalogos()
    {
        $method = $this->request->getMethod(true);
        if ($method === 'GET') {
            $response = $this->catalogosModel->catalogos();
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg'] = MSG_METHOD_NOT_ALLOWED;
        }
        return $this->response->setJSON($response);
    }


    public function procesarCompra()
    {
        $db = \Config\Database::connect();
        $session = session();

        try {

            // 1. Validar sesión
            $idUsuario = (int) $session->get('User_ID');
            $tipoUsuario = (int) $session->get('Tipo_Usuario');
            $token = (string) $session->get('Token');

            if (!$idUsuario || !$token || !in_array($tipoUsuario, [1, 2], true)) {
                return $this->response->setStatusCode(401)->setJSON([
                    'Code' => 400,
                    'Msg' => 'Tu sesión no es válida. Inicia sesión nuevamente.'
                ]);
            }

            // 2. Recibir productos
            $productosCarrito = $this->request->getPost('productos');

            if (is_string($productosCarrito)) {
                $productosCarrito = json_decode($productosCarrito, true);
            }

            if (!is_array($productosCarrito) || empty($productosCarrito)) {
                throw new \RuntimeException('El carrito está vacío o no es válido.');
            }

            if ($this->request->getPost('autorizacion_compra') !== '1') {
                throw new \RuntimeException('Debes autorizar tu compra.');
            }

            // 3. Datos de envío y pago
            $idTipoEnvio = (int) $this->request->getPost('id_tipo_envio');
            $idTipoPago = (int) $this->request->getPost('id_tipo_pago');

            $idDireccion = (int) $this->request->getPost('id_direccion');
            $idFacturacion = (int) $this->request->getPost('id_facturacion');
            $requiereFactura = (int) $this->request->getPost('requiere_factura');

            $notas = trim((string) $this->request->getPost('notas_adicionales'));

            if (!in_array($idTipoEnvio, [1, 2], true)) {
                throw new \RuntimeException('El tipo de envío no es válido.');
            }

            if (!in_array($idTipoPago, [1, 2], true)) {
                throw new \RuntimeException('El método de pago no es válido.');
            }

            if ($idTipoEnvio === 1 && $idDireccion < 1) {
                throw new \RuntimeException('Selecciona una dirección de entrega.');
            }

            if ($requiereFactura === 1 && $idFacturacion < 1) {
                throw new \RuntimeException('Selecciona tus datos de facturación.');
            }

            if ($idTipoEnvio === 2) {
                $idDireccion = 0;
            }

            if ($requiereFactura !== 1) {
                $idFacturacion = 0;
            }

            // 4. Validar productos y contar TODAS las placas
            $productosValidados = [];
            $totalPlacas = 0;

            foreach ($productosCarrito as $item) {

                $idProducto = (int) ($item['id_producto'] ?? 0);
                $cantidad = (int) ($item['cantidad'] ?? 0);

                if ($idProducto < 1 || $cantidad < 1) {
                    throw new \RuntimeException('Producto o cantidad no válida.');
                }

                $producto = $this->productoModel->find($idProducto);

                if (!$producto || (int) $producto['activo'] !== 1) {
                    throw new \RuntimeException(
                        "El producto {$idProducto} no está disponible."
                    );
                }

                $totalPlacas += $cantidad;

                $productosValidados[] = [
                    'item' => $item,
                    'producto' => $producto,
                    'cantidad' => $cantidad
                ];
            }

            // 5. Calcular precios reales desde MySQL
            $detalle = [];
            $totalProductos = 0;

            foreach ($productosValidados as $registro) {

                $item = $registro['item'];
                $producto = $registro['producto'];
                $cantidad = $registro['cantidad'];

                $precio = $this->catalogosModel->obtenerPrecioCheckout(
                    (int) $producto['id_producto'],
                    $totalPlacas,
                    $tipoUsuario
                );

                $precioUnitario = round(
                    (float) $precio['precio_unitario'],
                    2
                );

                $importe = round($precioUnitario * $cantidad, 2);

                $totalProductos += $importe;

                $detalle[] = [
                    'item' => $item,
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioUnitario,
                    'importe' => $importe
                ];
            }

            $totalProductos = round($totalProductos, 2);

            // 6. Calcular IVA incluido en los precios
            $subtotal = round($totalProductos / 1.16, 2);
            $iva = round($totalProductos - $subtotal, 2);

            // 7. Calcular envío: $192 por cada bloque de hasta 20 placas
            $envio = 0;

            if ($idTipoEnvio === 1) {
                $envio = ceil($totalPlacas / 20) * 192;
            }

            $total = round($totalProductos + $envio, 2);

            // 8. Obtener el token y preparar registro
            $idEstatusPago = 1;   // Sin pagar
            $idEstatusPedido = 1; // Pendiente
            $idUso = 0;

            // 9. Iniciar transacción
            $db->transBegin();

            $respuestaOrden = $this->usuarioModel->registra_orden(
                $token,
                $idTipoPago,
                $idEstatusPago,
                $idTipoEnvio,
                $idEstatusPedido,
                $subtotal,
                $iva,
                $envio,
                $total,
                $idDireccion,
                $idFacturacion,
                $notas,
                $idUso
            );

            if (
                !isset($respuestaOrden['Code']) ||
                (int) $respuestaOrden['Code'] !== REQUEST_SUCCESS
            ) {
                throw new \RuntimeException(
                    $respuestaOrden['Msg'] ?? 'No se pudo registrar la orden.'
                );
            }

            $idOrden = (int) $respuestaOrden['Id'];

            if ($idOrden < 1) {
                throw new \RuntimeException('No se obtuvo el identificador de la orden.');
            }

            // 10. Registrar todos los productos personalizados
            foreach ($detalle as $registro) {

                $item = $registro['item'];
                $producto = $registro['producto'];
                $personalizacion = $item['personalizacion'] ?? [];

                $linea1 = $personalizacion['linea1'] ?? [];
                $linea2 = $personalizacion['linea2'] ?? [];
                $linea3 = $personalizacion['linea3'] ?? [];

                $respuestaProducto = $this->usuarioModel->registra_producto(
                    $token,
                    $idOrden,
                    (int) $producto['id_producto'],
                    $item['nom_categoria'] ?? '',
                    $producto['nom_producto'] ?? ($item['nom_producto'] ?? ''),
                    $personalizacion['posicion'] ?? 0,
                    $linea1['texto'] ?? '',
                    (int) ($linea1['fuente'] ?? 0),
                    (int) ($linea1['caracteres'] ?? 0),
                    $linea2['texto'] ?? '',
                    (int) ($linea2['fuente'] ?? 0),
                    (int) ($linea2['caracteres'] ?? 0),
                    $linea3['texto'] ?? '',
                    (int) ($linea3['fuente'] ?? 0),
                    (int) ($linea3['caracteres'] ?? 0),
                    (int) ($personalizacion['color'] ?? 0),
                    (int) ($personalizacion['acabado'] ?? 0),
                    $item['foto'] ?? '',
                    $registro['cantidad'],
                    $registro['precio_unitario'],
                    $registro['importe']
                );

                if (
                    !isset($respuestaProducto['Code']) ||
                    (int) $respuestaProducto['Code'] !== REQUEST_SUCCESS
                ) {
                    throw new \RuntimeException(
                        $respuestaProducto['Msg'] ?? 'No se pudo registrar un producto.'
                    );
                }
            }

            // 11. Verificar y confirmar transacción
            if ($db->transStatus() === false) {
                throw new \RuntimeException('Error al guardar la orden y sus productos.');
            }

            $db->transCommit();

            // 12. Enviar correo de depósito DESPUÉS del commit
            if ($idTipoPago === 2) {
                try {
                    $datosOrden = [
                        'id_user' => $idUsuario,
                        'id_tipo_pago' => $idTipoPago,
                        'id_tipo_envio' => $idTipoEnvio,
                        'id_estatus_pago' => $idEstatusPago,
                        'id_estatus_pedido' => $idEstatusPedido,
                        'subtotal' => $subtotal,
                        'iva' => $iva,
                        'envio' => $envio,
                        'total' => $total,
                        'id_direccion' => $idDireccion,
                        'id_facturacion' => $idFacturacion,
                        'id_uso' => $idUso,
                        'observaciones_usuario' => $notas
                    ];

                    $this->usuarioModel->envia_correo_orden(
                        $idUsuario,
                        $idOrden,
                        $idTipoPago,
                        $datosOrden
                    );
                } catch (\Throwable $e) {
                    log_message('error', 'Error enviando correo de orden ' . $idOrden . ': ' . $e->getMessage());
                }
            }

            return $this->response->setJSON([
                'Code' => REQUEST_SUCCESS,
                'success' => true,
                'Msg' => 'La orden y sus productos se registraron correctamente.',
                'Id' => $idOrden,
                'total' => $total,
                'tipo_pago' => $idTipoPago,
                'tipo_envio' => $idTipoEnvio
            ]);
        } catch (\Throwable $e) {

            if ($db->transStatus() !== false) {
                $db->transRollback();
            } else {
                $db->transRollback();
            }

            log_message('error', 'Error procesando compra: ' . $e->getMessage());

            return $this->response->setStatusCode(400)->setJSON([
                'Code' => 400,
                'success' => false,
                'Msg' => $e->getMessage()
            ]);
        }
    }
}
