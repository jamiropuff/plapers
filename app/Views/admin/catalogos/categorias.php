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
                    <div id="tblRegistros" class="table-responsive"></div>
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