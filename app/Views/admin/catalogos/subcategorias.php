<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php //echo "<pre>", var_dump($Subcategorias), "</pre>";
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
                                    <th class="text-center">ID SUBCATEGORIA</th>
                                    <th class="text-center">CATEGORIA</th>
                                    <th class="text-center">SUBCATEGORIA</th>
                                    <th class="text-center">ACTIVO</th>
                                    <th class="text-center">EDITAR</th>
                                    <th class="text-center">DESACTIVAR</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php $x = 1; ?>
                                <?php foreach ($Subcategorias as $subcategoria) { ?>
                                    <?php
                                    $activo = ($subcategoria['activo'] == 1) ? "SI" : "NO";
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $x; ?></td>
                                        <td class="text-center"><?= $subcategoria["id_subcategoria"]; ?></td>
                                        <td class="text-center"><?= $subcategoria["nom_categoria"]; ?></td>
                                        <td class="text-center"><?= $subcategoria["nom_subcategoria"]; ?></td>
                                        <td class="text-center"><?= $activo; ?></td>
                                        <td class="text-center"><i class="fa-solid fa-pencil"></i></td>
                                        <td class="text-center">
                                            <button class="btn btn-danger">Desactivar</button>
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