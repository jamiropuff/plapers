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

            <hr>

            <div class="row">
              <div class="col-6 col-md-4 col-lg-3">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
              </div>

              <div class="col-6 col-md-4 col-lg-3">
                <label for="fecha_fin">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
              </div>

              <div class="col-12 col-md-2 col-lg-1 pad-top-32">
                <button type="button" id="btn-search" name="btn-search" class="form-control btn btn-dark" onclick="searchProspectives()"><i class="fas fa-search"></i></button>
              </div>

            </div>
          </div>

          <div id="divProspectives" class="card-body" style="overflow-x: scroll;"></div>

        </div>

      </div>
    </div>
  </div>
</section>