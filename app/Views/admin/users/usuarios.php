<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php //echo "<pre>", var_dump($Usuarios), "</pre>";
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="tblRegistros" class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ID USUARIO</th>
                                    <th class="text-center">USUARIO</th>
                                    <th class="text-center">NOMBRE</th>
                                    <th class="text-center">CORREO ELECTRÓNICO</th>
                                    <th class="text-center">ROL</th>
                                    <th class="text-center">ACTIVO</th>
                                    <th class="text-center">EDITAR</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php $x = 1; ?>
                                <?php foreach ($Usuarios["Usuarios"] as $usuario) { ?>
                                    <tr>
                                        <td class="text-center"><?= $x; ?></td>
                                        <td class="text-center"><?= $usuario["Id_User"]; ?></td>
                                        <td class="text-center"><?= $usuario["User"]; ?></td>
                                        <td class="text-center"><?= $usuario["Nombres"] . " " . $usuario["Paterno"] . " " . $usuario["Materno"]; ?></td>
                                        <td class="text-center"><?= $usuario["Email"]; ?></td>
                                        <td class="text-center"><?= $usuario["Nom_Rol"]; ?></td>
                                        <td class="text-center"><?= $usuario["Activo"]; ?></td>
                                        <td class="text-center">
                                            <a href="/usuarios/editar/<?= $usuario['Id_User'] ?>" title="Edita Usuario">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
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