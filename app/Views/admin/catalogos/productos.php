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
        <div class="col-12 col-md-4">
            <button name="Buscar" type="button" class="btn btn-primary btn-block" onclick="modalAgregaProducto()">Agregar Producto</button>
        </div>
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
                                    $activo = ($producto['activo'] == 1) ? 'SI' : '<span class="activo-false">NO</span>';

                                    if (!empty($producto['foto']) && file_exists(FCPATH . "fotos/" . $producto['id_subcategoria'] . "/" . $producto['foto'])) {
                                        $foto = base_url() . "/fotos/" . $producto['id_subcategoria'] . "/" . $producto['foto'];
                                    } else {
                                        $foto = "no-image.png";
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $x; ?></td>
                                        <td class="text-center"><?= $producto["id_producto"]; ?></td>
                                        <td class="text-center"><?= $producto["nom_categoria"]; ?></td>
                                        <td class="text-center"><?= $producto["nom_subcategoria"]; ?></td>
                                        <td class="text-center"><?= $producto["nom_producto"]; ?></td>
                                        <td class="text-center"><img src="<?= $foto; ?>" alt="Foto de <?= $producto["nom_producto"]; ?>" style="max-width: 100px; max-height: 100px;"></td>
                                        <td class="text-center"><?= $producto["largo"] . " x " . $producto["ancho"] . " cms."; ?></td>
                                        <td class="text-center"><?= $producto["precio_unitario"]; ?></td>
                                        <td class="text-center" id="activo-<?= $producto['id_producto']; ?>"><?= $activo; ?></td>
                                        <td class="text-center">
                                            <i class="fa-solid fa-eye fa-2x text-primary cur-pointer" onclick="mostrarProducto('<?= $producto['nom_producto']; ?>','<?= $producto['nom_subcategoria']; ?>','<?= $producto['nom_categoria']; ?>','<?= $foto; ?>','<?= $producto['clave']; ?>','<?= $producto['descripcion']; ?>','<?= $producto['largo']; ?>','<?= $producto['ancho']; ?>','<?= $producto['precio_unitario']; ?>')"></i>
                                            <!-- <i class="fa-solid fa-pencil"></i> -->
                                            <i class="fa-solid fa-power-off fa-2x toggle-status cur-pointer
                                            <?= $producto['activo'] == 1 ? 'text-success' : 'text-danger'; ?>"
                                                onclick="cambiaProductoJS(<?= $producto['id_producto']; ?>, <?= $producto['activo']; ?>)">
                                            </i>
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

<!-- sample modal content -->
<div id="modalProducto" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Producto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-hidden="true"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar</button> -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->