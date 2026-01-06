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
                                    <th class="text-left">CORREO REGISTRADO</th>
                                    <th class="text-center">FECHA</th>
                                </tr>
                            </thead>
                            <tbody class="border border-primary">
                                <?php $x = 1; ?>
                                <?php foreach ($Suscritos as $suscrito) { ?>
                                    <tr>
                                        <td class="text-center"><?= $x; ?></td>
                                        <td class="text-left"><?= $suscrito->correo; ?></td>
                                        <td class="text-center"><?= $suscrito->fecha_add; ?></td>
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