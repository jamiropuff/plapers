<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <div class="card">

        <div class="card-header">
            <div class="row">

              <div class="col-12 col-md-3 pad-top-32">
                <button class="btn btn-primary" onclick="degreeAddModal();">Agregar Oferta Educativa</button>
              </div>
            </div>

          </div>

          <div id="divDegree" class="card-body" style="overflow-x: scroll;"></div>

        </div>

      </div>
    </div>
  </div>
</section>



<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Oferta Educativa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">

            <div class="form-group">
                <label for="grado_academico_id">Grado Académico</label>
                <select id="grado_academico_id" name="grado_academico_id" class="form-control">
                  <option value="">Seleccionar</option>
                  <option value="1">Bachillerato Tecnológico</option>
                  <option value="2">Licenciatura</option>
                  <option value="3">Maestría</option>
                  <option value="4">Doctorado</option>
                </select>
            </div>


            <div class="form-group">
                <label for="titulo">Título de la Oferta Educativa</label>
                <input type="text" id="titulo" name="titulo" class="form-control">
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="createDegree();">Guardar</button>
      </div>
    </div>
  </div>
</div>