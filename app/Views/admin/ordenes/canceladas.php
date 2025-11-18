<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-danger text-white">
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
                            <tbody class="border border-danger">
                                <?php $x=1; ?>
                                <?php foreach($ordenes as $orden){ ?>
                                    <?php
                                    // Tipo de envío
                                    if ($orden->id_tipo_envio == 1) {
                                        $envio_domicilio = "SI";
                                    } else {
                                        $envio_domicilio = "NO";
                                    }

                                    $fecha_produccion = '';
                                    if($orden->fecha_produccion != ''){
                                        list($fecha_produccion,$hora_produccion) = explode(" ", $orden->fecha_produccion);
                                    }
                                    
                                    ?>
                                    <tr>
                                        <td><?=$x;?></td>
                                        <td><?=$orden->id_orden;?></td>
                                        <td><?=$orden->nombres.' '.$orden->paterno.' '.$orden->materno;?></td>
                                        <td class="text-center"><?=$orden->tipo_pago;?></td>
                                        <td class="text-center"><i class="fa-solid fa-file-pdf fa-2x"></i></td>
                                        <td class="text-center"><?=$envio_domicilio;?></td>
                                        <td class="text-center"><?=$orden->estatus_pago;?></td>
                                        <td class="text-center"><?=$orden->estatus_pedido;?></td>
                                        <td class="text-center"><?=$orden->fecha_pedido;?></td>
                                        <td class="text-center"><?=$fecha_produccion;?></td>
                                        <td class="text-center"><i class="fa-solid fa-eye fa-2x"></i></td>
                                        <td class="text-center"><i class="fa-regular fa-file-lines fa-2x"></i></td>
                                        <td><select></select></td>
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
