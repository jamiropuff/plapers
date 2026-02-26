<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php //echo "<pre>", var_dump($Productos), "</pre>";
?>
<?php
$orden = $Productos['Orden'];
$comprador = $Productos['Comprador'];
$direccion_envio = $Productos['Direccion_Envio'];
$direccion_facturacion = $Productos['Direccion_Facturacion'];
$uso_cfdi = $Productos['Uso_Cfdi'];
$productos = $Productos['Orden_Productos'];

//echo "<pre>", var_dump($productos), "</pre>";
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <h2>Productos de la Orden # <?php echo htmlspecialchars($orden[0]['id_orden'] ?? ''); ?></h2>
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
                                        <h6 class="card-title"><strong><?= $tipo_persona; ?>:</strong> <?php echo htmlspecialchars($nombre_persona ?? ''); ?></h6>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th class="text-center fw-bold">Fecha de<br>Producción</th>
                                            <th class="text-center fw-bold">Usuario<br>Producción</th>
                                            <th class="text-center fw-bold">Fecha de<br>Entrega<br>Producción</th>
                                            <th class="text-center fw-bold">Fecha de<br>Fabricación</th>
                                            <th class="text-center fw-bold">Usuario<br>Fabricación</th>
                                            <th class="text-center fw-bold">Fecha<br>Enviado</th>
                                            <th class="text-center fw-bold">Usuario<br>Enviado</th>
                                            <th class="text-center fw-bold">Fecha<br>Finalizado</th>
                                            <th class="text-center fw-bold">Usuario<br>Finalizado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['fecha_produccion'] ?? ''); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['id_usuario_produccion'] ?? ''); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['fecha_entrega'] ?? ''); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['fecha_fabricado'] ?? ''); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['id_usuario_fabricado'] ?? ''); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['fecha_enviado'] ?? ''); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['id_usuario_enviado'] ?? ''); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['fecha_completo'] ?? ''); ?></td>
                                            <td class="text-center align-middle"><?= htmlspecialchars($orden[0]['id_usuario_finalizado'] ?? ''); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($productos as $producto) { ?>
                    <?php

                    echo "<pre>", var_dump($producto), "</pre>";
                    $id_orden_producto = $producto['id_orden_producto'];
                    $id_producto = $producto['id_producto'];

                    $id_categoria = $producto['id_categoria'];
                    $id_posicion = $producto['id_posicion'];
                    $id_color = $producto['id_color'];

                    $texto_linea1 = $producto['texto_linea1'];
                    $fuente_linea1 = $producto['fuente_linea1'];
                    $caracteres_linea1 = $producto['caracteres_linea1'];

                    $texto_linea2 = $producto['texto_linea2'];
                    $fuente_linea2 = $producto['fuente_linea2'];
                    $caracteres_linea2 = $producto['caracteres_linea2'];

                    $texto_linea3 = $producto['texto_linea3'];
                    $fuente_linea3 = $producto['fuente_linea3'];
                    $caracteres_linea3 = $producto['caracteres_linea3'];

                    $claseL1 = "ff-tipo-" . $fuente_linea1 . " posicion-" . $id_posicion . " personaliza-" . $caracteres_linea1 . " letra-color-" . $id_color . " linea-1";
                    $claseL2 = "ff-tipo-" . $fuente_linea2 . " posicion-" . $id_posicion . " personaliza-" . $caracteres_linea2 . " letra-color-" . $id_color . " linea-2";
                    $claseL3 = "ff-tipo-" . $fuente_linea3 . " posicion-" . $id_posicion . " personaliza-" . $caracteres_linea3 . " letra-color-" . $id_color . " linea-3";

                    $acabado = $producto['id_terminado'];

                    //echo "acabado: ".$acabado."<br>";

                    if (isset($acabado) && $acabado == 1) {
                        $img_acabado = "acabado/" . $id_categoria . "/acabado-" . $id_color . ".png";
                    } elseif ($acabado == 2) {
                        $img_acabado = "acabado/" . $id_categoria . "/acabado-ch.png";
                    } else {
                        $img_acabado = "acabado/" . $id_categoria . "/acabado-pl.png";
                    }
                    ?>

                    <div class="card-body">
                        <div class="row mt-20">
                            <div class="col-md-5 col-sm-5 col-xs-12 categoria-<?php echo $id_categoria; ?>" id="placa">
                                <div style="text-transform: uppercase;" class="<?php echo $claseL1; ?>"><?php echo $texto_linea1; ?></div>
                                <?php if (!empty($texto_linea2)) { ?>
                                    <div style="text-transform: uppercase;" class="<?php echo $claseL2; ?>"><?php echo $texto_linea2; ?></div>
                                <?php } ?>

                                <?php if (!empty($texto_linea3)) { ?>
                                    <div style="text-transform: uppercase;" class="<?php echo $claseL3; ?>"><?php echo $texto_linea3; ?></div>
                                <?php } ?>
                                <div class="imgs-zoom-area" style="position: relative; top:0; left: 0; width: 100%;">
                                    <img class="placa--img" id="zoom_03" src="<?= $producto['foto'] ?>" alt style="position: relative; top:0; left: 0;" />
                                    <img src="<?= base_url() ?>/<?php echo $img_acabado; ?>" style="position: absolute; top:0; left: 0;" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">CATEGORÍA</th>
                                        <th class="text-center">PRODUCTO</th>
                                        <th class="text-center">CANTIDAD</th>
                                        <th class="text-center">DISTRIBUCIÓN</th>
                                        <th class="text-center">COLOR</th>

                                        <th class="text-center">LÍNEA 1</th>
                                        <th class="text-center">FUENTE 1</th>
                                        <th class="text-center">CARACTERES LÍNEA 1</th>
                                        <?php if (!empty($texto_linea2)) { ?>
                                            <th class="text-center">LÍNEA 2</th>
                                            <th class="text-center">FUENTE 2</th>
                                            <th class="text-center">CARACTERES LÍNEA 2</th>
                                        <?php } ?>
                                        <?php if (!empty($texto_linea3)) { ?>
                                            <th class="text-center">LÍNEA 3</th>
                                            <th class="text-center">FUENTE 3</th>
                                            <th class="text-center">CARACTERES LÍNEA 3</th>
                                        <?php } ?>
                                        <th class="text-center">Acabado</th>
                                    </tr>
                                </thead>
                                <tbody class="border border-primary">

                                    <tr>
                                        <td class="text-center align-middle"><?= $producto['nom_categoria']; ?></td>
                                        <td class="text-center align-middle"><?= $producto['nom_producto']; ?></td>
                                        <td class="text-center align-middle"><?= $producto['cantidad']; ?></td>
                                        <td class="text-center align-middle"><img src="https://plapers.com.mx/public/img/posiciones/p<?= $producto['id_posicion'] ?>.jpg" /></td>
                                        <td class="text-center align-middle">
                                            <div style="background-color: #<?= $producto['hex']; ?>; border: 1px solid #000; border-radius: 50%; width:30px; height:30px; display: inline-block;"></div><br><?= $producto['color']; ?>
                                        </td>

                                        <td class="text-center align-middle"><?= $texto_linea1; ?></td>
                                        <td class="text-center align-middle"><?= $fuente_linea1; ?></td>
                                        <td class="text-center align-middle"><?= $caracteres_linea1; ?></td>

                                        <?php if (!empty($texto_linea2)) { ?>
                                            <td class="text-center align-middle"><?= $texto_linea2; ?></td>
                                            <td class="text-center align-middle"><?= $fuente_linea2; ?></td>
                                            <td class="text-center align-middle"><?= $caracteres_linea2; ?></td>
                                        <?php } ?>

                                        <?php if (!empty($texto_linea3)) { ?>
                                            <td class="text-center align-middle"><?= $texto_linea3; ?></td>
                                            <td class="text-center align-middle"><?= $fuente_linea3; ?></td>
                                            <td class="text-center align-middle"><?= $caracteres_linea3; ?></td>
                                        <?php } ?>

                                        <td class="text-center align-middle"><?= $producto['nom_terminado']; ?></td>
                                    </tr>
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                

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