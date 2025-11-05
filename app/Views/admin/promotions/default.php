<?php //echo "<pre>", var_dump($oferta_educativa), "</pre>"; ?>
<?php //echo "<pre>", var_dump($promociones), "</pre>"; ?>
<?php echo "<pre>", var_dump($archivos), "</pre>"; ?>
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <div class="card">

        <div class="card-header">
            <div class="row">

              <div class="col-12 col-md-3 pad-top-32">
                
              </div>
            </div>

          </div>

          <div id="divPromociones" class="card-body" style="overflow-x: scroll;">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <?php foreach($archivos as $archivo){ ?>
                  <th>
                    <img src="<?= base_url() ?>/assets/images/promo/<?=$archivo;?>" height="150">
                  </th>                
                  <?php } ?>
                </tr>
                <tr>
                  <?php foreach($archivos as $archivo){ ?>
                  <th>
                    <?=$archivo;?>
                  </th>
                  <?php } ?>
                </tr>

              </thead>
              
            </table>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>