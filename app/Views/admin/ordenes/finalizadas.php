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

                    <form class="row g-3 align-items-end mb-4">
                        <div class="col-md-3">
                            <label for="fecha_inicio" class="form-label fw-bold">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_fin" class="form-label fw-bold">Fecha Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success" onclick="listarRegistroFinalizadas()">
                                <i class="fa-solid fa-magnifying-glass"></i> Filtrar
                            </button>
                        </div>
                    </form>
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
