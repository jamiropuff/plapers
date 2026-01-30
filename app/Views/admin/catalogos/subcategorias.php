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
        <div class="col-12 col-md-4">
            <button name="Buscar" type="button" class="btn btn-primary btn-block" onclick="modalAgregaSubcategoria()">Agregar Subcategoría</button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="tblRegistros" class="table-responsive">
                        <table id="tablaSubcategorias" class="table table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ID SUBCATEGORIA</th>
                                    <th class="text-center">CATEGORIA</th>
                                    <th class="text-center">SUBCATEGORIA</th>
                                    <th class="text-center">ACTIVO</th>
                                    <th class="text-center">OPCIONES</th>
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
                                        <td class="text-center" id="activo-<?= $subcategoria['id_subcategoria']; ?>"><?= $activo; ?></td>
                                        <td class="text-center">
                                            <i class="fa-solid fa-pencil fa-2x text-warning cur-pointer" onclick="modalEditaSubcategoria(<?= $subcategoria['id_subcategoria']; ?>,<?= $subcategoria['id_categoria']; ?>,'<?= $subcategoria['nom_subcategoria']; ?>')"></i>
                                            <i class="fa-solid fa-power-off fa-2x toggle-status cur-pointer
                                            <?= $subcategoria['activo'] == 1 ? 'text-success' : 'text-danger'; ?>"
                                                onclick="cambiaSubcategoriaJS(<?= $subcategoria['id_subcategoria']; ?>, <?= $subcategoria['activo']; ?>)">
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
<div id="modalSubcategorias" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Subcategorías</h4>
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