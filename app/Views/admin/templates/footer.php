<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center text-muted">
  Todos los derechos reservados. &copy; 2025 Plapers
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url() ?>/admin/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- apps -->
<!-- apps -->
<script src="<?= base_url() ?>/admin/dist/js/app-style-switcher.js"></script>
<script src="<?= base_url() ?>/admin/dist/js/feather.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url() ?>/admin/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url() ?>/admin/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="<?= base_url() ?>/admin/assets/extra-libs/c3/d3.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/extra-libs/c3/c3.min.js"></script>
<?php if ($menu == 'dashboard'): ?>
<script src="<?= base_url() ?>/admin/assets/libs/chartist/dist/chartist.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<?php endif ?>
<script src="<?= base_url() ?>/admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<?php if ($menu == 'dashboard'): ?>
<script src="<?= base_url() ?>/admin/dist/js/pages/dashboards/dashboard1.min.js"></script>
<?php endif ?>
<!-- Select2 -->
<script src="<?= base_url() ?>/admin/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-select/js/dataTables.select.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-select/js/select.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/admin/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE -->

<script src="<?= base_url() ?>/admin/assets/plugins/xls/xlsx.full.min.js"></script>

<!-- Eventos -->
<?php /*if ($title == 'Eventos'): ?>
    <script src="<?= base_url() ?>/admin/js/events.js"></script>
  <?php endif ?>

  <!-- Usuarios -->
  <?php if ($title == 'Cambiar Contraseña'): ?>
    <script src="<?= base_url() ?>/admin/js/users.js"></script>
  <?php endif */ ?>


<script>
  $(function() {
    // //Initialize Select2 Elements
    // $('.select2').select2()

    // //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   theme: 'bootstrap4'
    // })

    // $("input[data-bootstrap-switch]").each(function() {
    //   $(this).bootstrapSwitch('state', $(this).prop('checked'));
    // })
  })
</script>

</body>

</html>