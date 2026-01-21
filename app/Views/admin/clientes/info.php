<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php // echo "<pre>", var_dump($Cliente_Info), "</pre>";
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
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
                                    <h6 class="card-title"><strong>NOMBRE:</strong> <?php echo htmlspecialchars($Cliente_Info['Clientes'][0]['Nombre'] ?? ''); ?></h6>
                                    <p class="card-text"><strong>CORREO ELECTRÓNICO:</strong> <?php echo htmlspecialchars($Cliente_Info['Clientes'][0]['Correo_Electronico'] ?? ''); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php foreach ($Cliente_Info["Direccion_Envio"] as $direccion) { ?>
                            <div class="col-md-6">
                                <div class="card border-info">
                                    <div class="card-header bg-info">
                                        <h4 class="mb-0 text-white">Direcciones de Envío</h4>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title"><strong>RECIBE:</strong> <?php echo htmlspecialchars($direccion['Recibe'] ?? ''); ?></h6>
                                        <p class="card-text"><strong>TELÉFONO:</strong> <?php echo htmlspecialchars($direccion['Telefono'] ?? ''); ?></p>
                                        <p class="card-text"><strong>DOMICILIO:</strong>
                                            <?php
                                            echo "<br>" . htmlspecialchars($direccion['Calle'] ?? '') . " No." . htmlspecialchars($direccion['Numero'] ?? '');
                                            if (!empty($direccion['Interior'])) {
                                                echo " Int. " . htmlspecialchars($direccion['Interior'] ?? '');
                                            }
                                            echo ",<br> Col. " . htmlspecialchars($direccion['Colonia'] ?? '');
                                            echo ",<br>" . htmlspecialchars($direccion['Municipio'] ?? '');
                                            echo ",<br> " . htmlspecialchars($direccion['Estado'][0]['nombre_estado'] ?? '') . ", " . htmlspecialchars($direccion['Pais'][0]['nombre_pais'] ?? '');
                                            echo ", C.P. " . htmlspecialchars($direccion['Codigo_Postal'] ?? '');

                                            if (!empty($direccion['Referencia'])) {
                                                echo "<br><br>Referencias: " . htmlspecialchars($direccion['Referencia'] ?? '');
                                            }
                                            if (!empty($direccion['Notas_Adicionales'])) {
                                                echo "<br><br>Notas Adicionales: " . htmlspecialchars($direccion['Notas_Adicionales'] ?? '');
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php foreach ($Cliente_Info["Direccion_Facturacion"] as $facturacion) { ?>
                            <div class="col-md-6">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning">
                                        <h4 class="mb-0 text-white">Direcciones de Facturación</h4>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title"><strong>NOMBRE:</strong>
                                            <?php
                                            echo htmlspecialchars(
                                                !empty($facturacion['Razon_Social'])
                                                    ? $facturacion['Razon_Social']
                                                    : trim($facturacion['Nombres'] . " " . $facturacion['Paterno'] . " " . $facturacion['Materno'])
                                            );
                                            ?></h6>
                                        <p class="card-text"><strong>RFC:</strong> <?php echo htmlspecialchars($facturacion['Rfc'] ?? ''); ?></p>
                                        <p class="card-text"><strong>CURP:</strong> <?php echo htmlspecialchars($facturacion['Curp'] ?? ''); ?></p>
                                        <p class="card-text"><strong>USO CFDI:</strong> <?php echo htmlspecialchars($facturacion['Uso'][0]['nombre_uso'] ?? ''); ?></p>
                                        <p class="card-text"><strong>DOMICILIO FISCAL:</strong>
                                            <?php
                                            echo "<br>" . htmlspecialchars($facturacion['Calle'] ?? '') . " No." . htmlspecialchars($facturacion['Numero'] ?? '');
                                            if (!empty($facturacion['Interior'])) {
                                                echo " Int. " . htmlspecialchars($facturacion['Interior'] ?? '');
                                            }
                                            echo ",<br> Col. " . htmlspecialchars($facturacion['Colonia'] ?? '');
                                            echo ",<br>" . htmlspecialchars($facturacion['Municipio'] ?? '');
                                            echo ",<br> " . htmlspecialchars($facturacion['Estado'][0]['nombre_estado'] ?? '') . ", " . htmlspecialchars($facturacion['Pais'][0]['nombre_pais'] ?? '');
                                            echo ", C.P. " . htmlspecialchars($facturacion['Codigo_Postal'] ?? '');

                                            if (!empty($facturacion['Referencia'])) {
                                                echo "<br><br>Referencias: " . htmlspecialchars($facturacion['Referencia'] ?? '');
                                            }
                                            if (!empty($facturacion['Notas_Adicionales'])) {
                                                echo "<br><br>Notas Adicionales: " . htmlspecialchars($facturacion['Notas_Adicionales'] ?? '');
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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