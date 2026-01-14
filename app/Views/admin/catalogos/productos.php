<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php //echo "<pre>", var_dump($Productos), "</pre>";
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
                                    <th class="text-center">ID PRODUCTO</th>
                                    <th class="text-center">CATEGORIA</th>
                                    <th class="text-center">SUBCATEGORIA</th>
                                    <th class="text-center">PRODUCTO</th>
                                    <th class="text-center">FOTO</th>
                                    <th class="text-center">MEDIDAS</th>
                                    <th class="text-center">PRECIO</th>
                                    <th class="text-center">ACTIVO</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php $x = 1; ?>
                                <?php foreach ($Productos as $producto) { ?>
                                    <?php
                                    $activo = ($producto['activo'] == 1) ? "SI" : "NO";
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $x; ?></td>
                                        <td class="text-center"><?= $producto["id_producto"]; ?></td>
                                        <td class="text-center"><?= $producto["nom_categoria"]; ?></td>
                                        <td class="text-center"><?= $producto["nom_subcategoria"]; ?></td>
                                        <td class="text-center"><?= $producto["nom_producto"]; ?></td>
                                        <td class="text-center"><img src="/fotos/<?= $producto["id_subcategoria"]; ?>/<?= $producto["foto"]; ?>" alt="Foto de <?= $producto["nom_producto"]; ?>" style="max-width: 100px; max-height: 100px;"></td>
                                        <td class="text-center"><?= $producto["largo"]." x ".$producto["ancho"]." cms."; ?></td>
                                        <td class="text-center"><?= $producto["precio_unitario"]; ?></td>
                                        <td class="text-center"><?= $activo; ?></td>
                                        <td class="text-center">
                                            <i class="fa-solid fa-eye fa-2x text-primary"></i> 
                                            <!-- <i class="fa-solid fa-pencil"></i> -->
                                            <i class="fa-solid fa-trash-can fa-2x text-danger"></i>
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