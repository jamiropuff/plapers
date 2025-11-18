<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <?php //echo "<pre>", var_dump($ordenes), "</pre>"; ?>
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
                                    if ($orden->id_tipo_envio == 1) {
                                        $envio_domicilio = "SI";
                                    } else {
                                        $envio_domicilio = "NO";
                                    }

                                    $fecha_produccion = '';
                                    if ($orden->fecha_produccion != '') {
                                        list($fecha_produccion, $hora_produccion) = explode(" ", $orden->fecha_produccion);
                                    }

                                    // Comprobante de pago
                                    $comprobante_pago = "";
                                    $comprobante_pago_thumb = "";
                                    if (!empty($orden->comprobante)) {
                                        $comprobante_pago = '<img style="width: 50vw" class="img img-fluid" src="' . base_url('uploads/comprobantes/' . $orden->comprobante) . '"> ';
                                        $comprobante_pago_thumb = '<img style="width: 60px; height: 80px; cursor:pointer" src="' . base_url('uploads/comprobantes/' . $orden->comprobante) . '" data-bs-toggle="modal" data-bs-target="#comprobanteModal_' . $orden->id_orden . '"> ';
                                    ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="comprobanteModal_<?php echo $orden->id_orden; ?>" tabindex="-1" aria-labelledby="comprobanteModalLabel_<?php echo $orden->id_orden; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="comprobanteModalLabel_<?php echo $orden->id_orden; ?>">Comprobante de Pago</h1>
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
                                    if (!empty($orden->constancia)) {
                                        $situacion_fiscal = '<a href="' . base_url('uploads/constancias/' . $orden->constancia) . '" target="_blank"><i class="fa-solid fa-file-pdf fa-2x"></i></a>';
                                    } else {
                                        $situacion_fiscal = "";
                                    }

                                    ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $orden->id_orden; ?></td>
                                        <td><?= $orden->nombres . ' ' . $orden->paterno . ' ' . $orden->materno; ?></td>
                                        <td class="text-center"><?= $orden->tipo_pago; ?><br> <?= $comprobante_pago_thumb; ?></td>
                                        <td class="text-center"><?= $situacion_fiscal; ?></td>
                                        <td class="text-center"><?= $envio_domicilio; ?></td>
                                        <td class="text-center">
                                            <div id="resultEstatusPago_<?= $orden->id_orden; ?>"><?= $orden->estatus_pago; ?></div>
                                        </td>
                                        <td class="text-center">
                                            <div id="resultEstatusPedido_<?= $orden->id_orden; ?>"><?= $orden->estatus_pedido; ?></div>
                                        </td>
                                        <td class="text-center"><?= $orden->fecha_pedido; ?></td>
                                        <td class="text-center"><?= $fecha_produccion; ?></td>
                                        <td class="text-center"><a href="/ordenes/productos/<?= $orden->id_orden; ?>"><i class="fa-solid fa-eye fa-2x"></i></a></td>
                                        <td class="text-center"><a href="/ordenes/orden/<?= $orden->id_orden; ?>"><i class="fa-regular fa-file-lines fa-2x"></i></a></td>
                                        <td>
                                            <select></select>
                                        </td>
                                        <td><select></select></td>
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