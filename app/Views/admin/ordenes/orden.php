<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php //echo "<pre>", var_dump($Data), "</pre>";
?>
<?php
$orden = $Data['Orden'];
$comprador = $Data['Comprador'];
$direccion_envio = $Data['Direccion_Envio'];
$direccion_facturacion = $Data['Direccion_Facturacion'];
$productos = $Data['Orden_Productos'];
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <h2>Ficha de la Orden # <?php echo htmlspecialchars($orden[0]['id_orden'] ?? ''); ?></h2>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-dark">
                                <div class="card-header bg-dark">
                                    <h4 class="mb-0 text-white">Datos de Contacto</h4>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title"><strong>NOMBRE:</strong> <?php echo htmlspecialchars($comprador['Clientes'][0]['nombres'] . ' ' . $comprador['Clientes'][0]['paterno'] . ' ' . $comprador['Clientes'][0]['materno'] ?? ''); ?></h6>
                                    <p class="card-text"><strong>EMAIL:</strong> <?php echo htmlspecialchars($comprador['Clientes'][0]['correo_electronico'] ?? ''); ?></p>
                                    <p class="card-text"><strong>OBSERVACIONES CLIENTE:</strong> <?php echo htmlspecialchars($orden[0]['observaciones_usuario'] ?? ''); ?></p>
                                    <p class="card-text"><strong>OBSERVACIONES PLAPERS:</strong> <?php echo htmlspecialchars($orden[0]['observaciones_plapers'] ?? ''); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-dark">
                                <div class="card-header bg-warning">
                                    <h4 class="mb-0 text-white">Estatus</h4>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Número de orden:</strong> <?php echo htmlspecialchars($orden[0]['id_orden'] ?? ''); ?></h6>
                                    <p class="card-text"><strong>Fecha de pedido:</strong> <?php echo htmlspecialchars($orden[0]['fecha_pedido'] ?? ''); ?></p>
                                    <p class="card-text"><strong>Estatus de pago:</strong> <?php echo htmlspecialchars($orden[0]['estatus_pago'] ?? ''); ?></p>
                                    <p class="card-text"><strong>Estatus de pedido:</strong> <?php echo htmlspecialchars($orden[0]['estatus_pedido'] ?? ''); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <?php
                        $id_direccion_envio = $orden[0]['id_direccion'];
                        if ($id_direccion_envio > 0) {
                        ?>
                            <div class="col-md-6">
                                <div class="card border-secondary">
                                    <div class="card-header bg-secondary">
                                        <h4 class="mb-0 text-white">Dirección de Envío</h4>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title"><strong>TELÉFONO:</strong> <?php echo htmlspecialchars($direccion_envio[0]['telefono'] ?? ''); ?></h6>
                                        <p class="card-text">
                                            <strong>DOMICILIO:</strong><br>
                                            <?php
                                            echo htmlspecialchars($direccion_envio[0]['calle'] ?? '') . ' No.' . htmlspecialchars($direccion_envio[0]['numero'] ?? '') . htmlspecialchars($direccion_envio[0]['interior'] ?? '') . '<br>';
                                            echo 'Col. ' . htmlspecialchars($direccion_envio[0]['colonia'] ?? '') . '<br>';
                                            echo htmlspecialchars($direccion_envio[0]['municipio'] ?? '') . ', ' . htmlspecialchars($direccion_envio[0]['Estado'] ?? '') . '<br>';
                                            echo htmlspecialchars($direccion_envio[0]['pais'] ?? '') . ', C.P.' . htmlspecialchars($direccion_envio[0]['codigo_postal'] ?? '') . '<br>';
                                            ?>
                                        </p>
                                        <h6 class="card-text"><strong>Referencia:</strong> <?php echo htmlspecialchars($direccion_envio[0]['referencia'] ?? ''); ?></h6>
                                        <h6 class="card-text"><strong>Notas Adicionales:</strong> <?php echo htmlspecialchars($direccion_envio[0]['notas_adicionales'] ?? ''); ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php

                        $id_direccion_facturacion = $orden[0]['id_facturacion'];
                        if ($id_direccion_facturacion > 0) {

                            $id_tipo_persona = $direccion_facturacion[0]['Tipo_Persona'];

                            if ($id_tipo_persona == 1) {
                                $tipo_persona = "Nombre";
                                $nombre_persona = $direccion_facturacion[0]['Nombres'] . " " . $direccion_facturacion[0]['Paterno'] . " " . $direccion_facturacion[0]['Materno'];
                            }
                            if ($id_tipo_persona == 2) {
                                $tipo_persona = "Razón Social";
                                $nombre_persona = $direccion_facturacion[0]['Razon_Social'];
                            }

                            if ($Data['Uso_Cfdi'] != null) {
                                $uso_cfdi = $Data['Uso_Cfdi'];
                            } else {
                                $uso_cfdi = $direccion_facturacion[0]['Uso'];
                            }
                        ?>

                            <div class="col-md-6">
                                <div class="card border-secondary">
                                    <div class="card-header bg-secondary">
                                        <h4 class="mb-0 text-white">Dirección de Facturación</h4>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title"><strong><?=  $tipo_persona; ?>:</strong> <?php echo htmlspecialchars($nombre_persona ?? ''); ?></h6>
                                        <p class="card-text"><strong>RFC:</strong> <?php echo htmlspecialchars($direccion_facturacion[0]['Rfc'] ?? ''); ?></p>
                                        <p class="card-text"><strong>CURP:</strong> <?php echo htmlspecialchars($direccion_facturacion[0]['Curp'] ?? ''); ?></p>
                                        <p class="card-text"><strong>Uso CFDI:</strong> <?php echo htmlspecialchars($uso_cfdi ?? ''); ?></p>
                                        <p class="card-text">
                                            <strong>DOMICILIO:</strong><br>
                                            <?php
                                            echo htmlspecialchars($direccion_facturacion[0]['Calle'] ?? '') . ' No.' . htmlspecialchars($direccion_facturacion[0]['Numero'] ?? '') . htmlspecialchars($direccion_facturacion[0]['Interior'] ?? '') . '<br>';
                                            echo 'Col. ' . htmlspecialchars($direccion_facturacion[0]['Colonia'] ?? '') . '<br>';
                                            echo htmlspecialchars($direccion_facturacion[0]['Municipio'] ?? '') . ', ' . htmlspecialchars($direccion_facturacion[0]['Estado'] ?? '') . '<br>';
                                            echo htmlspecialchars($direccion_facturacion[0]['Pais'] ?? '') . ', C.P.' . htmlspecialchars($direccion_facturacion[0]['Codigo_Postal'] ?? '') . '<br>';
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">&nbsp;</th>
                                    <th class="text-center">PRODUCTO</th>
                                    <th class="text-center">PRECIO</th>
                                    <th class="text-center">CANTIDAD</th>
                                    <th class="text-center">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php
                                $x = 1;
                                $cantidad = 0;
                                $precio_unitario = 0;
                                $total = 0;
                                ?>
                                <?php foreach ($productos as $producto) { ?>
                                    <?php
                                    $id_orden_producto = $producto['id_orden_producto'];
                                    $id_producto = $producto['id_producto'];

                                    $id_categoria = $producto['id_categoria'];
                                    $id_posicion = $producto['id_posicion'];
                                    $id_color = $producto['id_color'];

                                    $texto_linea1 = $producto['texto_linea1'];
                                    $fuente_linea1 = $producto['fuente1'];
                                    $caracteres_linea1 = $producto['caracteres_linea1'];

                                    $texto_linea2 = $producto['texto_linea2'];
                                    $fuente_linea2 = $producto['fuente2'];
                                    $caracteres_linea2 = $producto['caracteres_linea2'];

                                    $texto_linea3 = $producto['texto_linea3'];
                                    $fuente_linea3 = $producto['fuente3'];
                                    $caracteres_linea3 = $producto['caracteres_linea3'];

                                    $claseL1 = "ff-tipo-" . $fuente_linea1 . " posicion-" . $id_posicion . " personaliza-" . $caracteres_linea1 . " letra-color-" . $id_color . " linea-1";
                                    $claseL2 = "ff-tipo-" . $fuente_linea2 . " posicion-" . $id_posicion . " personaliza-" . $caracteres_linea2 . " letra-color-" . $id_color . " linea-2";
                                    $claseL3 = "ff-tipo-" . $fuente_linea3 . " posicion-" . $id_posicion . " personaliza-" . $caracteres_linea3 . " letra-color-" . $id_color . " linea-3";

                                    $acabado = $producto['id_terminado'];

                                    //echo "acabado: ".$acabado."<br>";

                                    if (isset($acabado) && $acabado == 1) {
                                        $img_acabado = "public/acabado/" . $id_categoria . "/acabado-" . $id_color . ".png";
                                    } elseif ($acabado == 2) {
                                        $img_acabado = "public/acabado/" . $id_categoria . "/acabado-ch.png";
                                    } else {
                                        $img_acabado = "public/acabado/" . $id_categoria . "/acabado-pl.png";
                                    }


                                    //echo "texto_linea1: ".$texto_linea1;

                                    // $texto_linea1 = $producto['texto_linea1'];
                                    // $texto_linea2 = $producto['texto_linea2'];
                                    // $texto_linea3 = $producto['texto_linea3'];
                                    //echo "texto_linea1: ".$texto_linea1;

                                    // Totales
                                    $precio_unitario = $precio_unitario + $producto['precio_unitario'];
                                    $cantidad = $cantidad + $producto['cantidad'];
                                    $total = $total + $producto['total'];

                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $x; ?></td>
                                        <td class="text-center align-middle"><img src="<?= $producto['foto']; ?>" alt="Imagen del producto" style="max-width: 150px; max-height: 150px;"></td>
                                        <td>
                                            <?= $producto['nom_producto']; ?><br>
                                            Categoría: <?= $producto['nom_categoria']; ?><br>

                                            <?php if ($producto["id_categoria"] != 5 && $producto["id_categoria"] != 6 && $producto["id_categoria"] != 7) { ?>

                                                Línea 1: <?= $producto['texto_linea1']; ?><br>

                                                <?php if (!empty($texto_linea2)) { ?>
                                                    Línea 2: <?= $producto['texto_linea2']; ?><br>
                                                <?php } ?>

                                                <?php if (!empty($texto_linea3)) { ?>
                                                    Línea 3: <?= $producto['texto_linea3']; ?><br>
                                                <?php } ?>

                                                Color: <?= $producto['color']; ?> <div style="background-color: #<?= $producto['hex']; ?>; border: 1px solid #000; border-radius: 50%; width:30px; height:30px; display: inline-block;"></div><br>
                                                
                                                Distribución: <img src="https://plapers.com.mx/public/img/posiciones/p<?= $producto['id_posicion'] ?>.jpg" />

                                            <?php } ?>
                                        </td>
                                        <td class="text-center align-middle fw-bold "><?= $producto['precio_unitario']; ?></td>
                                        <td class="text-center align-middle"><?= $producto['cantidad']; ?></td>
                                        <td class="text-center align-middle fw-bold "><?= $producto['total']; ?></td>
                                    </tr>
                                    <?php $x++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary">
                                    <h4 class="mb-0 text-white"></h4>
                                </div>
                                <div class="card-body fs-5">
                                    <?php
                                    $id_tipo_envio = $orden[0]['id_tipo_envio'];
                                    $tipo_envio = (isset($id_tipo_envio) && $id_tipo_envio == 1) ? 'Envio a domicilio' : 'Recoger en oficina';

                                    $id_tipo_pago = $orden[0]['id_tipo_pago'];
                                    $tipo_pago = (isset($id_tipo_pago) && $id_tipo_pago == 1) ? 'Paypal' : 'Depósito bancario';
                                    ?>
                                    <p class="card-text"><strong>TIPO DE ENVÍO</strong><br><?php echo htmlspecialchars($tipo_envio ?? ''); ?></p>
                                    <p class="card-text mt-5"><strong>MÉTODO DE PAGO</strong><br><?php echo htmlspecialchars($tipo_pago ?? ''); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary">
                                    <h4 class="mb-0 text-white">DETALLES DE PAGO</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $subtotal = $orden[0]['subtotal'];
                                    $iva = $orden[0]['iva'];
                                    $envio = $orden[0]['envio'];

                                    $costo_envio = (isset($envio) && $envio > 0) ? $envio :  0;

                                    $total = $orden[0]['total'];
                                    ?>
                                    <table class="table fs-5">
                                        <tr>
                                            <td>Cantidad de productos:</td>
                                            <td><?php echo $cantidad; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Subtotal:</td>
                                            <td><?php echo '$ ' . number_format($subtotal, 2, '.', ','); ?></td>
                                        </tr>
                                        <?php if ($costo_envio > 0) { ?>
                                            <tr>
                                                <td>Envío</td>
                                                <td><?php echo '$ ' . number_format($costo_envio, 2, '.', ','); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>IVA:</td>
                                            <td><?php echo '$ ' . number_format($iva, 2, '.', ','); ?></td>
                                        </tr>
                                        <tr class="text-danger">
                                            <td class="fw-bold">Total a pagar:</td>
                                            <td class="fw-bold"><?php echo '$ ' . number_format($total, 2, '.', ','); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->