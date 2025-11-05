<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <div class="card">

          <div class="card-header">
            <div class="row">

              <div class="col-12 col-md-3 pad-top-32">
                <!--<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-add"> <i class="fas fa-plus"></i> Agregar Partido</button>-->
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-12 col-md-4 col-lg-3">
                <label for="clave">Cambiar Contraseña</label>
                <input type="password" name="clave" id="clave" class="form-control">
              </div>

              <div class="col-2 col-md-1 pad-top-32">
                <button type="button" class="form-control btn btn-dark" onclick="changePass()">Guardar cambios</button>
              </div>

            </div>
          </div>

          <div id="divUsers" class="card-body" style="overflow-x: scroll;">
            <!-- table-responsive p-0 -->
          </div>

        </div>

      </div>
    </div>
  </div>
</section>