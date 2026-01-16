<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php //echo "<pre>", var_dump($Categorias), "</pre>";
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12 col-md-4">
            <button name="Buscar" type="button" class="btn btn-primary btn-block" onclick="modalAgregaCategoria()">Agregar Categoría</button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ID CATEGORIA</th>
                                    <th class="text-center">CATEGORIA</th>
                                    <th class="text-center">ACTIVO</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php $x = 1; ?>
                                <?php foreach ($Categorias as $categoria) { ?>
                                    <?php
                                    $activo     = ($categoria['activo'] == 1) ? "SI" : "NO";
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $x; ?></td>
                                        <td class="text-center"><?= $categoria["id_categoria"]; ?></td>
                                        <td class="text-center"><?= $categoria["nom_categoria"]; ?></td>
                                        <td class="text-center"><?= $activo; ?></td>
                                        <td class="text-center">
                                            <i class="fa-solid fa-pencil fa-2x text-warning cur-pointer" onclick="modalEditaCategoria(<?= $categoria['id_categoria']; ?>, '<?= $categoria['nom_categoria']; ?>')"></i>
                                            <i class="fa-solid fa-power-off fa-2x toggle-status cur-pointer
                                            <?= $categoria['activo'] == 1 ? 'text-success' : 'text-danger'; ?>"
                                                onclick="cambiaCategoriaJS(<?= $categoria['id_categoria']; ?>, <?= $categoria['activo']; ?>)">
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
<div id="modalCategorias" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Categorías</h4>
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