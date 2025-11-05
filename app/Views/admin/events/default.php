<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <div class="card">

        <div class="card-header">
            <div class="row">

              <div class="col-12 col-md-3 pad-top-32">
                <button class="btn btn-primary" onclick="eventAddModal();">Agregar Evento</button>
              </div>
            </div>

          </div>

          <div id="divEvents" class="card-body" style="overflow-x: scroll;"></div>

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
        <h5 class="modal-title">Agregar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">

            <div class="form-group">
              <label for="imagen">Imagen</label>
              <input type="file" id="imagen" name="imagen" class="form-control">
              <div id="imagen_show"></div>
            </div>

            <div class="form-group">
              <label for="titulo">Título de la Oferta Educativa</label>
              <input type="text" id="titulo" name="titulo" class="form-control">
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="fecha_inicio">Fecha Inicio</label>
                  <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="fecha_fin">Fecha Finalización</label>
                  <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="archivo_presencial">Archivo Presencial</label>
              <input type="file" id="archivo_presencial" name="archivo_presencial" class="form-control">
              <div id="archivo_presencial_show"></div>
            </div>

            <div class="form-group">
              <label for="archivo_zoom">Archivo Zoom</label>
              <input type="file" id="archivo_zoom" name="archivo_zoom" class="form-control">
              <div id="archivo_zoom_show"></div>
            </div>

            <input type="hidden" id="evento_id">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button id="btnAdd" type="button" class="btn btn-primary" onclick="save();" style="display: none;">Guardar</button>
        <button id="btnUpd" type="button" class="btn btn-primary" onclick="edit();" style="display: none;">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>