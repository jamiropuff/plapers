<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <?php 
            // echo "menu: ". $menu. "<br>";
            //  echo "<pre>", var_dump($ordenes), "</pre>"; 
            // echo "<pre>", var_dump($estatusPedido), "</pre>";
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ORDEN</th>
                                    <th class="text-center">USUARIO</th>
                                    <th class="text-center">TIPO DE PAGO</th>
                                    <th class="text-center">CONSTANCIA<br>SITUACIÓN<br>FISCAL</th>
                                    <th class="text-center">ENVÍO A DOMICILIO</th>
                                    <th class="text-center">ESTATUS DE PAGO</th>
                                    <th class="text-center">ESTATUS PEDIDO</th>
                                    <th class="text-center">FECHA PEDIDO</th>
                                    <th class="text-center">FECHA ENTREGA PRODUCCIÓN</th>
                                    <th class="text-center">VER PEDIDO</th>
                                    <th class="text-center">VER FICHA DE PAGO</th>
                                    <th class="text-center">MODIFICAR PAGO</th>
                                    <th class="text-center">MODIFICAR PEDIDO</th>
                                    <th class="text-center">DESCARGAR EXCEL</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php $x = 1; ?>
                                <?php foreach ($ordenes as $orden) { ?>
                                    <?php
                                    // Tipo de envío
                                    if ($orden->Id_Tipo_Envio == 1) {
                                        $envio_domicilio = "SI";
                                    } else {
                                        $envio_domicilio = "NO";
                                    }

                                    $fecha_produccion = '';
                                    if ($orden->Fecha_Produccion != '') {
                                        list($fecha_produccion, $hora_produccion) = explode(" ", $orden->Fecha_Produccion);
                                    }

                                    // Comprobante de pago
                                    $comprobante_pago = "";
                                    $comprobante_pago_thumb = "";
                                    if (!empty($orden->Comprobante)) {
                                        $comprobante_pago = '<img style="width: 50vw" class="img img-fluid" src="' . base_url('uploads/comprobantes/' . $orden->Comprobante) . '"> ';
                                        $comprobante_pago_thumb = '<img style="width: 60px; height: 80px; cursor:pointer" src="' . base_url('uploads/comprobantes/' . $orden->Comprobante) . '" data-bs-toggle="modal" data-bs-target="#comprobanteModal_' . $orden->Id_Orden . '"> ';
                                    ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="comprobanteModal_<?php echo $orden->Id_Orden; ?>" tabindex="-1" aria-labelledby="comprobanteModalLabel_<?php echo $orden->Id_Orden; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="comprobanteModalLabel_<?php echo $orden->Id_Orden; ?>">Comprobante de Pago</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $comprobante_pago; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }

                                    // Constancia de Situación Fiscal desde el Panel del Usuario
                                    if (!empty($orden->Constancia)) {
                                        $situacion_fiscal = '<a href="' . base_url('uploads/constancias/' . $orden->Constancia) . '" target="_blank"><i class="fa-solid fa-file-pdf fa-2x"></i></a>';
                                    } else {
                                        $situacion_fiscal = "";
                                    }

                                    ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $orden->Id_Orden; ?></td>
                                        <td><?= $orden->Nombre . ' ' . $orden->Paterno . ' ' . $orden->Materno; ?></td>
                                        <td class="text-center"><?= $orden->Tipo_Pago; ?><br> <?= $comprobante_pago_thumb; ?></td>
                                        <td class="text-center"><?= $situacion_fiscal; ?></td>
                                        <td class="text-center"><?= $envio_domicilio; ?></td>
                                        <td class="text-center">
                                            <div id="resultEstatusPago_<?= $orden->Id_Orden; ?>"><?= $orden->Estatus_Pago; ?></div>
                                        </td>
                                        <td class="text-center">
                                            <div id="resultEstatusPedido_<?= $orden->Id_Orden; ?>"><?= $orden->Estatus_Pedido; ?></div>
                                        </td>
                                        <td class="text-center"><?= $orden->Fecha_Pedido; ?></td>
                                        <td class="text-center"><?= $fecha_produccion; ?></td>
                                        <td class="text-center"><a href="/ordenes/productos/<?= $orden->Id_Orden; ?>"><i class="fa-solid fa-eye fa-2x"></i></a></td>
                                        <td class="text-center"><a href="/ordenes/orden/<?= $orden->Id_Orden; ?>"><i class="fa-regular fa-file-lines fa-2x"></i></a></td>

                                        <?php if (isset($session->Rol) && ($session->Rol == 1 || $session->Rol == 3)) { ?>
                                            <td>
                                                <select id="id_estatus_pago_<?= $orden->Id_Orden; ?>" class="form-select form-select-sm" onchange="cambiar_pago(<?= $orden->Id_Orden; ?>, this.value)">
                                                    <option value="0">Seleccionar</option>
                                                    <?php foreach ($estatusPago as $estatus) { ?>
                                                        <option value="<?= $estatus->id_estatus_pago; ?>"><?= $estatus->estatus_pago; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        <?php } ?>

                                        <td>
                                            <?php //echo "<pre>", var_dump($orden->Cat_Tipo_Envio), "</pre>"; ?>
                                            <select id="id_estatus_pedido_<?= $orden->Id_Orden; ?>" class="form-select form-select-sm" onchange="pedidoModal(<?= $orden->Id_Orden; ?>, this.value, <?= $orden->Id_Estatus_Pago; ?>)">
                                                <option value="0">Seleccionar</option>
                                                <?php foreach ($orden->Cat_Tipo_Envio as $CatTipoEnvio) { ?>
                                                    <?php if (isset($session->Rol) && $session->Rol != 5) { ?>
                                                        <?php if ($CatTipoEnvio->id_estatus_pedido != 3 && $CatTipoEnvio->id_estatus_pedido != 7) { ?>
                                                            <option value="<?= $CatTipoEnvio->id_estatus_pedido; ?>"><?= $CatTipoEnvio->estatus_pedido; ?></option>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if ($CatTipoEnvio->id_estatus_pedido == 3 || $CatTipoEnvio->id_estatus_pedido == 7) { ?>
                                                            <option value="<?= $CatTipoEnvio->id_estatus_pedido; ?>"><?= $CatTipoEnvio->estatus_pedido; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td class="text-center"><i class="fa-solid fa-file-export fa-2x"></i></td>
                                    </tr>
                                    <?php $x++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
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