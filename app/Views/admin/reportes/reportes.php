<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<?php //echo "<pre>", var_dump($TipoPago), "</pre>"; 
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Filtros de Búsqueda</h4> -->
                    <form action="#">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label>Fecha inicio</label>
                                    <input id="fecha_inicio" name="fecha_inicio" type="date" placeholder="Fecha inicio" class="form-control" 
                                    <?php if (isset($_POST['fecha_inicio']) && !empty($_POST['fecha_inicio'])) { echo 'value="' . $_POST['fecha_inicio'] . '"'; } ?>>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>Fecha fin</label>
                                    <input id="fecha_fin" name="fecha_fin" type="date" placeholder="Fecha fin" class="form-control" 
                                    <?php if (isset($_POST['fecha_fin']) && !empty($_POST['fecha_fin'])) { echo 'value="' . $_POST['fecha_fin'] . '"'; } ?>>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12 col-md-4">
                                    <label>Categoría</label>
                                    <select id="id_categoria" name="id_categoria"  class="custom-select" onchange="select_categoria(this.value)">
                                        <option value="0">Todas</option>
                                        <?php foreach ($Categorias as $Categoria) { ?>
                                        <option value="<?=$Categoria['id_categoria'];?>" 
                                        <?php if (isset($_POST['id_categoria']) && !empty($_POST['id_categoria']) && $Categoria['id_categoria'] == $_POST['id_categoria']) { echo 'selected="true"'; } ?>><?=$Categoria['nom_categoria'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="resultSubcategoria" class="col-12 col-md-4">
                                    <label>Subcategoría</label>
                                    <select id="id_subcategoria" name="id_subcategoria"  class="custom-select">
                                        <option value="0">Selecciona una categoría</option>
                                        <?php if (isset($_POST['id_categoria']) && !empty($_POST['id_categoria'])) { ?>
                                            <?php foreach ($Subcategorias as $Subcategoria) { ?>
                                                <?php if ($Subcategoria['id_categoria'] == $_POST['id_categoria']) { ?>
                                                    <option value="<?=$Subcategoria['id_subcategoria'];?>" 
                                                    <?php if (isset($_POST['id_subcategoria']) && !empty($_POST['id_subcategoria']) && $Subcategoria['id_subcategoria'] == $_POST['id_subcategoria']) { echo 'selected="true"'; } ?>><?=$Subcategoria['nom_subcategoria'];?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="resultProducto" class="col-12 col-md-4">
                                    <label>Producto</label>
                                    <select id="id_producto" name="id_producto"  class="custom-select">
                                        <option value="0">Selecciona una subcategoría</option>
                                        <?php if (isset($_POST['id_categoria']) && !empty($_POST['id_categoria']) && isset($_POST['id_subcategoria']) && !empty($_POST['id_subcategoria'])) { ?>
                                            <?php foreach ($Productos as $Producto) { ?>
                                                <?php if ($Producto['id_categoria'] == $_POST['id_categoria'] && $Producto['id_subcategoria'] == $_POST['id_subcategoria']) { ?>
                                                    <option value="<?=$Producto['id_producto'];?>" <?php if (isset($_POST['id_producto']) && !empty($_POST['id_producto']) && $Producto['id_producto'] == $_POST['id_producto']) { echo 'selected="true"'; } ?>><?=$Producto['nom_producto'];?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12 col-md-4">
                                    <label>Tipo de pago</label>
                                    <select id="id_tipo_pago" name="id_tipo_pago" class="custom-select">
                                        <option value="0">Todos</option>
                                        <?php foreach ($TipoPago as $Tipopago) { ?>
                                            <option value="<?=$Tipopago->id_tipo_pago;?>" 
                                            <?php if (isset($_POST['id_tipo_pago']) && !empty($_POST['id_tipo_pago']) && $Tipopago->id_tipo_pago == $_POST['id_tipo_pago']) { echo 'selected="true"'; } ?>><?=$Tipopago->tipo_pago;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="resultSubcategoria" class="col-12 col-md-4">
                                    <label>Estatus de pago</label>
                                    <select id="id_estatus_pago" name="id_estatus_pago" class="custom-select">
                                        <option value="0">Todos</option>
                                        <?php foreach ($EstatusPago as $Estatuspago) { ?>
                                        <option value="<?=$Estatuspago->id_estatus_pago;?>" 
                                        <?php if (isset($_POST['id_estatus_pago']) && !empty($_POST['id_estatus_pago']) && $Estatuspago->id_estatus_pago == $_POST['id_estatus_pago']) { echo 'selected="true"'; } ?>><?=$Estatuspago->estatus_pago;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label>Estatus de pedido</label>
                                    <select id="id_estatus_pedido" name="id_estatus_pedido" class="custom-select">
                                        <option value="0">Todos</option>
                                        <?php foreach ($EstatusPedido as $Estatuspedido) { ?>
                                            <option value="<?=$Estatuspedido->id_estatus_pedido;?>" 
                                            <?php if (isset($_POST['id_estatus_pedido']) && !empty($_POST['id_estatus_pedido']) && $Estatuspedido->id_estatus_pedido == $_POST['id_estatus_pedido']) { echo 'selected="true"'; } ?>><?=$Estatuspedido->estatus_pedido;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>                            
                        </div>
                        <div class="form-actions mt-5">
                            <div class="text-end">
                                <button name="Buscar" type="submit" class="btn btn-primary btn-block">Buscar</button>
                                <button type="reset" class="btn btn-dark">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="page-content" class="mt-20 mb-20">
        <div class="row">
            <div class="col-12">
                <form id="reporte_excel" method="post" action="<?php echo base_url(); ?>reportes/excel_export" class="p-30">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <button name="Buscar" type="button" class="btn btn-success btn-block" onclick="excelExport()">Descargar Excel</button>
                        </div>
                    </div>
                    <input id="export_fecha_inicio" type="hidden">
                    <input id="export_fecha_fin" type="hidden">
                    <input id="export_id_categoria" type="hidden">
                    <input id="export_id_subcategoria" type="hidden">
                    <input id="export_id_producto" type="hidden">
                    <input id="export_id_tipo_pago" type="hidden">
                    <input id="export_id_estatus_pago" type="hidden">
                    <input id="export_id_estatus_pedido" type="hidden">
                </form>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">CATEGORIA</th>
                                    <th class="text-center">SUBCATEGORIA</th>
                                    <th class="text-center">PRODUCTO</th>
                                    <th class="text-center">TIPO DE PAGO</th>
                                    <th class="text-center">TIPO DE ENVIO</th>
                                    <th class="text-center">ESTATUS DE PAGO</th>
                                    <th class="text-center">ESTATUS PEDIDO</th>
                                    <th class="text-center">CANTIDAD</th>
                                    <th class="text-center">PRECIO</th>
                                    <th class="text-center">IVA</th>
                                    <th class="text-center">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php $x = 1; ?>
                                <?php foreach ($reporte as $venta) { ?>

                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $venta["Nom_Categoria"]; ?></td>
                                        <td><?= $venta["Nom_Subcategoria"]; ?></td>
                                        <td><?= $venta["Nom_Producto"]; ?></td>
                                        <td><?= $venta["Tipo_Pago"]; ?></td>
                                        <td><?= $venta["Tipo_Envio"]; ?></td>
                                        <td><?= $venta["Estatus_Pago"]; ?></td>
                                        <td><?= $venta["Estatus_Pedido"]; ?></td>
                                        <td><?= $venta["Cantidad"]; ?></td>
                                        <td><?= $venta["Precio"]; ?></td>
                                        <td><?= $venta["Iva"]; ?></td>
                                        <td><?= $venta["Total"]; ?></td>
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