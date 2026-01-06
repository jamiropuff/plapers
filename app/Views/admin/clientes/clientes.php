<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php // echo "<pre>", var_dump($Clientes), "</pre>";
?>
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
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ID CLIENTE</th>
                                    <th class="text-center">CLIENTE</th>
                                    <th class="text-center">CORREO ELECTRÓNICO</th>
                                    <th class="text-center">ACTIVO</th>
                                    <th class="text-center">DESCUENTO</th>
                                    <th class="text-center">VER</th>
                                    <th class="text-center">ACTIVAR DESCUENTO</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php $x = 1; ?>
                                <?php foreach ($Clientes["Clientes"] as $cliente) { ?>
                                    <?php
                                    $activo     = ($cliente['Active'] == 1) ? "SI" : "NO";
                                    $descuento  = ($cliente['Id_Tipo_Usuario'] == 1) ? "NO" : "SI";
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $x; ?></td>
                                        <td class="text-center"><?= $cliente["Id_User"]; ?></td>
                                        <td class="text-center"><?= $cliente["Nombre"] . " " . $cliente["Paterno"] . " " . $cliente["Materno"]; ?></td>
                                        <td class="text-center"><?= $cliente["Correo_Electronico"]; ?></td>
                                        <td class="text-center"><?= $activo; ?></td>
                                        <td class="text-center"><?= $descuento; ?></td>
                                        <td class="text-center">
                                            <a href="/clientes/info/<?= $cliente['Id_User'] ?>" title="Ver Información del Cliente">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <select id="id_tipo_usuario_<?=$cliente['Id_User'];?>" class="form-select form-select-sm" onchange="cambiar_tipo_usuario(<?=$cliente['Id_User'];?>, this.value)">
                                                <option value="0">Seleccionar</option>
                                                <?php foreach ($Clientes["CatTipo_Usuario"] as $Tipo_Usuario) { ?>
                                                <option value="<?=$Tipo_Usuario['id_tipo_usuario']?>"><?=$Tipo_Usuario['tipo_usuario']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
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