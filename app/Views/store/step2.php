<?php
$nombreUsuario = trim(
  (string) session()->get('Nombres') . ' ' .
    (string) session()->get('Paterno') . ' ' .
    (string) session()->get('Materno')
);
$direcciones = $direcciones ?? [];
$facturaciones = $facturaciones ?? [];
$direccionSeleccionada = (int) ($direccionSeleccionada ?? 0);
$facturacionSeleccionada = (int) ($facturacionSeleccionada ?? 0);
$direccionActiva = null;
$facturacionActiva = null;
foreach ($direcciones as $d) if ((int)($d->id_direccion ?? 0) === $direccionSeleccionada) $direccionActiva = $d;
foreach ($facturaciones as $f) if ((int)($f->id_facturacion ?? 0) === $facturacionSeleccionada) $facturacionActiva = $f;
$valor = static fn($obj, $key) => (string)($obj->{$key} ?? '');
?>
<section class="cart-page pt-130 pb-130 checkout-direcciones">
  <div class="container">
    <h2 class="checkout-title text-white">Por favor llena los siguientes datos antes de continuar</h2>
    <?php if (session()->getFlashdata('checkout_address_error')): ?>
      <div class="alert alert-danger" role="alert"><?= esc(session()->getFlashdata('checkout_address_error')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('checkout_address_success')): ?>
      <div class="alert alert-success" role="status"><?= esc(session()->getFlashdata('checkout_address_success')) ?></div>
    <?php endif; ?>

    <form action="<?= base_url('carrito/paso2/domicilios') ?>" method="post" enctype="multipart/form-data" id="formCheckoutDirecciones">
      <?= csrf_field() ?>
      <input type="hidden" name="id_direccion" id="id_direccion" value="<?= $direccionSeleccionada ?>">
      <input type="hidden" name="id_facturacion" id="id_facturacion" value="<?= $facturacionSeleccionada ?>">
      <input type="hidden" name="nueva_direccion" id="nueva_direccion" value="0">
      <input type="hidden" name="nueva_facturacion" id="nueva_facturacion" value="0">
      <input type="hidden" name="requiere_envio" id="requiere_envio" value="0">

      <section class="checkout-section" id="seccionEntrega" style="display:none">
        <h4>Dirección de envío</h4>
        <div class="checkout-subtitle">Direcciones registradas:</div>
        <div class="address-cards" id="tarjetasEntrega">
          <button type="button" class="address-card address-new" data-new-address="entrega">Nueva dirección</button>
          <?php foreach ($direcciones as $d):
            $texto = trim($valor($d, 'calle') . ' ' . $valor($d, 'numero') . ($valor($d, 'interior') ? ' Int. ' . $valor($d, 'interior') : '') . ', ' . $valor($d, 'colonia') . ', ' . $valor($d, 'municipio') . ', ' . $valor($d, 'estado') . ', C.P. ' . $valor($d, 'codigo_postal'));
            $data = ['id_direccion' => $valor($d, 'id_direccion'), 'recibe' => $valor($d, 'recibe'), 'calle' => $valor($d, 'calle'), 'numero' => $valor($d, 'numero'), 'interior' => $valor($d, 'interior'), 'telefono' => $valor($d, 'telefono'), 'colonia' => $valor($d, 'colonia'), 'municipio' => $valor($d, 'municipio'), 'estado' => $valor($d, 'estado'), 'codigo_postal' => $valor($d, 'codigo_postal'), 'referencia' => $valor($d, 'referencia'), 'notas_adicionales' => $valor($d, 'notas_adicionales'), 'pais' => $valor($d, 'pais')];
          ?>
            <button type="button" class="address-card <?= $direccionSeleccionada === (int)$valor($d, 'id_direccion') ? 'selected' : '' ?>" data-address="<?= esc(json_encode($data, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP), 'attr') ?>">
              <strong><?= esc($valor($d, 'recibe')) ?></strong><span><?= esc($texto) ?></span>
            </button>
          <?php endforeach; ?>
        </div>
        <?php if (!$direcciones): ?><p class="checkout-note">Aún no tienes domicilios guardados. Completa el formulario para registrar uno.</p><?php endif; ?>

        <div class="checkout-form-grid" id="formEntrega">
          <?php
          $camposEntrega = [
            'recibe'            => 'Nombre completo para el envío',
            'calle'             => 'Calle',
            'numero'            => 'Número',
            'interior'          => 'Interior',
            'telefono'          => 'Teléfono',
            'colonia'           => 'Colonia',
            'municipio'         => 'Municipio',
            'estado'            => 'Estado',
            'codigo_postal'     => 'Código Postal',
            'referencia'        => 'Referencia',
            'notas_adicionales' => 'Notas adicionales',
            'pais'              => 'País'
          ];

          foreach ($camposEntrega as $campo => $label):
          ?>
            <div class="checkout-field <?= in_array($campo, ['numero', 'interior', 'telefono']) ? 'small-field' : '' ?>">
              <label for="entrega_<?= esc($campo) ?>" class="form-label">
                <?= esc($label) ?>
              </label>

              <?php if ($campo === 'recibe'): ?>

                <input
                  type="text"
                  id="nombre_completo"
                  value="<?= esc($nombreUsuario) ?>"
                  readonly>

                <input
                  type="hidden"
                  id="entrega_recibe"
                  name="entrega_recibe"
                  value="<?= esc($nombreUsuario) ?>">

              <?php endif; ?>


              <?php if ($campo === 'estado' || $campo === 'pais'): ?>

                <select
                  class="form-select no-nice-select" 
                  id="entrega_<?= esc($campo) ?>"
                  name="entrega_<?= esc($campo) ?>"
                  required
                  <?= $direccionActiva ? 'disabled' : '' ?>>
                  <option value="">
                    Selecciona una opción
                  </option>
                </select>




              <?php else: ?>

                <?php if ($campo !== 'recibe'): ?>
                  <input
                    class="form-control"
                    type="text"
                    id="entrega_<?= esc($campo) ?>"
                    name="entrega_<?= esc($campo) ?>"
                    placeholder="<?= esc($label) ?>"
                    value="<?= esc($valor($direccionActiva, $campo)) ?>"
                    <?= $campo === 'recibe' ? 'required' : '' ?>
                    <?= $direccionActiva ? 'disabled' : '' ?>>
                <?php endif; ?>

              <?php endif; ?>
            </div>
          <?php endforeach; ?>

        </div>
        <div class="checkout-actions"><a href="<?= base_url('mis-direcciones') ?>">Administrar domicilios de entrega</a></div>
      </section>

      <section class="checkout-section checkout-billing">
        <h4>Facturación</h4>
        <label class="invoice-toggle"><input type="checkbox" id="requiere_factura" name="requiere_factura" value="1" <?= $facturacionSeleccionada ? 'checked' : '' ?>> Requiero factura de mi compra</label>
        <div id="seccionFacturacion" class="<?= $facturacionSeleccionada ? '' : 'd-none' ?>">
          <div class="checkout-subtitle">Domicilios fiscales registrados:</div>
          <div class="address-cards" id="tarjetasFacturacion">
            <button type="button" class="address-card address-new" data-new-address="fiscal">Nueva dirección fiscal</button>
            <?php foreach ($facturaciones as $f):
              $titular = (int)($f->tipo_persona ?? 1) === 2 ? $valor($f, 'razon_social') : trim($valor($f, 'nombres') . ' ' . $valor($f, 'paterno') . ' ' . $valor($f, 'materno'));
              $texto = 'RFC ' . $valor($f, 'rfc') . ' · C.P. ' . $valor($f, 'codigo_postal');
              $data = ['id_facturacion' => $valor($f, 'id_facturacion'), 'tipo_persona' => $valor($f, 'tipo_persona'), 'nombres' => $valor($f, 'nombres'), 'paterno' => $valor($f, 'paterno'), 'materno' => $valor($f, 'materno'), 'razon_social' => $valor($f, 'razon_social'), 'rfc' => $valor($f, 'rfc'), 'curp' => $valor($f, 'curp'), 'calle' => $valor($f, 'calle'), 'numero' => $valor($f, 'numero'), 'interior' => $valor($f, 'interior'), 'colonia' => $valor($f, 'colonia'), 'municipio' => $valor($f, 'municipio'), 'estado' => $valor($f, 'estado'), 'codigo_postal' => $valor($f, 'codigo_postal'), 'pais' => $valor($f, 'pais'), 'uso_cfdi' => $valor($f, 'uso_cfdi')];
            ?>
              <button type="button" class="address-card <?= $facturacionSeleccionada === (int)$valor($f, 'id_facturacion') ? 'selected' : '' ?>" data-billing="<?= esc(json_encode($data, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP), 'attr') ?>">
                <strong><?= esc($titular) ?></strong><span><?= esc($texto) ?></span>
              </button>
            <?php endforeach; ?>
          </div>
          <div class="checkout-form-grid" id="formFacturacion">
            <div class="checkout-field"><label for="fiscal_tipo_persona">Tipo de persona</label><select id="fiscal_tipo_persona" name="fiscal_tipo_persona" <?= $facturacionActiva ? 'disabled' : '' ?>>
                <option value="1" <?= (int)$valor($facturacionActiva, 'tipo_persona') !== 2 ? 'selected' : '' ?>>Persona física</option>
                <option value="2" <?= (int)$valor($facturacionActiva, 'tipo_persona') === 2 ? 'selected' : '' ?>>Persona moral</option>
              </select></div>
            <?php $camposFiscal = ['nombres' => 'Nombre / nombres', 'paterno' => 'Apellido paterno', 'materno' => 'Apellido materno', 'razon_social' => 'Razón social', 'rfc' => 'RFC', 'curp' => 'CURP', 'calle' => 'Calle', 'numero' => 'Número', 'interior' => 'Interior', 'colonia' => 'Colonia', 'municipio' => 'Alcaldía / Municipio', 'estado' => 'Estado', 'codigo_postal' => 'Código Postal', 'pais' => 'País', 'uso_cfdi' => 'Uso de CFDI'];
            foreach ($camposFiscal as $campo => $label): ?>
              <div class="checkout-field" data-fiscal-field="<?= esc($campo) ?>"><label for="fiscal_<?= esc($campo) ?>"><?= esc($label) ?></label><input type="text" id="fiscal_<?= esc($campo) ?>" name="fiscal_<?= esc($campo) ?>" placeholder="<?= esc($label) ?>" value="<?= esc($valor($facturacionActiva, $campo)) ?>" <?= $facturacionActiva ? 'disabled' : '' ?>></div>
            <?php endforeach; ?>
            <div class="checkout-field"><label for="fiscal_constancia">Constancia de Situación Fiscal</label><input type="file" id="fiscal_constancia" name="fiscal_constancia" accept=".pdf,.jpg,.jpeg,.png" <?= $facturacionActiva ? 'disabled' : '' ?>></div>
          </div>
          <div class="checkout-actions"><a href="<?= base_url('domicilio-fiscal') ?>">Administrar domicilios fiscales</a></div>
        </div>
      </section>

      <div class="checkout-submit">
        <button type="submit" class="btn btn-primary">Siguiente paso</button>
        <a href="<?= base_url('carrito') ?>" class="btn btn-outline-secondary">Regresar al carrito</a>
      </div>
    </form>
  </div>
</section>

<style>
  .checkout-direcciones {
    color: inherit
  }

  .checkout-title {
    text-align: center;
    font-size: 1.35rem;
    font-weight: 400;
    margin: 0 auto 28px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e7e7e7;
    color: var(--bs-body-color, #27364b)
  }

  .checkout-section {
    padding: 12px 0 26px;
    border-bottom: 1px solid #e8e8e8;
    margin-bottom: 20px
  }

  .checkout-section h4 {
    font-size: 1.05rem;
    font-weight: 500;
    margin-bottom: 12px;
    color: inherit
  }

  .checkout-subtitle {
    font-size: .9rem;
    margin-bottom: 10px;
    text-decoration: underline
  }

  .address-cards {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 24px
  }

  .address-card {
    min-height: 68px;
    border: 1px solid transparent;
    border-radius: 4px;
    background: #383535;
    color: #ffffff;
    padding: 12px 14px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    cursor: pointer;
    font: inherit;
    font-size: .8rem
  }

  .address-card span {
    font-size: .68rem;
    line-height: 1.5;
    overflow-wrap: anywhere
  }

  .address-card strong {
    font-size: .8rem;
    font-weight: 500
  }

  .address-card.selected {
    border: 2px solid #ef393e;
    background: #fff7f7;
    color: #344054
  }

  .address-card.address-new {
    background: #ef393e;
    color: white;
    font-weight: 700
  }

  .checkout-form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px 20px
  }

  .checkout-field {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 5px
  }

  .checkout-field label {
    font-size: .75rem;
    color: #8b95a5
  }

  .checkout-field input,
  .checkout-field select {
    width: 100%;
    min-height: 36px;
    border: 1px solid #eee;
    border-radius: 4px;
    padding: 7px 12px;
    font-size: .8rem;
    background: #fff;
    color: #495467
  }

  .checkout-field input:disabled,
  .checkout-field select:disabled {
    background: #eee;
    color: #737b88;
    opacity: 1
  }

  .checkout-field input[type=file] {
    padding: 5px
  }

  .checkout-note {
    font-size: .8rem;
    color: #a66b00
  }

  .checkout-actions {
    margin-top: 12px;
    font-size: .8rem
  }

  .checkout-actions a {
    color: #ef393e;
    text-decoration: underline
  }

  .invoice-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .8rem;
    margin: 8px 0 18px
  }

  .invoice-toggle input {
    width: 16px;
    height: 16px;
    accent-color: #ef393e
  }

  .checkout-submit {
    display: flex;
    gap: 10px;
    flex-wrap: wrap
  }

  .checkout-submit .btn {
    border-radius: 2px;
    font-size: .8rem;
    padding: 10px 18px
  }

  .checkout-billing {
    border-bottom: 0
  }
  /* Evitar que el formulario recorte los elementos */
.checkout-direcciones,
.checkout-direcciones .container,
.checkout-direcciones .checkout-section,
.checkout-direcciones .checkout-form-grid,
.checkout-direcciones .checkout-field {
    overflow: visible !important;
}

/* Dar prioridad visual al campo seleccionado */
.checkout-field:focus-within {
    position: relative;
    z-index: 1000;
}

.checkout-field select:focus {
    position: relative;
    z-index: 1001;
}

  .d-none {
    display: none !important
  }

  @media(max-width:767px) {
    .address-cards {
      grid-template-columns: 1fr
    }

    .checkout-form-grid {
      grid-template-columns: 1fr;
      gap: 13px
    }

    .checkout-title {
      font-size: 1.1rem
    }

    .checkout-section {
      padding-bottom: 20px
    }
  }
</style>
<script>
  (() => {

    const NOMBRE_USUARIO = <?= json_encode($nombreUsuario ?? '') ?>;
    const selectEstado = document.getElementById('entrega_estado');
    const selectPais = document.getElementById('entrega_pais');

    let estadosCatalogo = [];
    let paisesCatalogo = [];

    async function cargarCatalogosEntrega() {
      try {
        const respuesta = await fetch('<?= base_url('catalogos') ?>');
        if (!respuesta.ok) {
          throw new Error('No fue posible consultar los catálogos.');
        }

        const catalogos = await respuesta.json();

        estadosCatalogo = catalogos.estados || [];
        paisesCatalogo = catalogos.paises || [];

        selectEstado.innerHTML =
          '<option value="">Selecciona una opción</option>';

        estadosCatalogo.forEach(estado => {
          const opcion = document.createElement('option');
          opcion.value = String(estado.id_estado);
          opcion.textContent = estado.nombre_estado;
          selectEstado.appendChild(opcion);
        });

        selectPais.innerHTML =
          '<option value="">Selecciona una opción</option>';

        paisesCatalogo.forEach(pais => {
          const opcion = document.createElement('option');
          opcion.value = String(pais.id_pais);
          opcion.textContent = pais.nombre_pais;
          selectPais.appendChild(opcion);
        });

        // Restaurar los valores de la dirección seleccionada.
        if (direccionInicial.estado) {
          selectEstado.value = String(direccionInicial.estado);
        }

        if (direccionInicial.pais) {
          selectPais.value = String(direccionInicial.pais);
        }

      } catch (error) {
        console.error('Error cargando catálogos:', error);
      }
    }

    const direccionInicial = {
      estado: <?= json_encode($valor($direccionActiva, 'estado')) ?>,
      pais: <?= json_encode($valor($direccionActiva, 'pais')) ?>
    };

    const catalogosListos = cargarCatalogosEntrega();





    const form = document.getElementById('formCheckoutDirecciones');
    if (!form) return;
    const idEntrega = document.getElementById('id_direccion');
    const idFiscal = document.getElementById('id_facturacion');
    const nuevaEntrega = document.getElementById('nueva_direccion');
    const nuevaFiscal = document.getElementById('nueva_facturacion');
    const seccionFiscal = document.getElementById('seccionFacturacion');
    const requiereFactura = document.getElementById('requiere_factura');
    const seccionEntrega = document.getElementById('seccionEntrega');
    const CHECKOUT_DRAFT_KEY = 'checkoutPaso2Draft';

    // Recuperar el tipo de envío guardado en el paso 1.
    function obtenerTipoEnvio() {
      try {
        const borrador = JSON.parse(localStorage.getItem(CHECKOUT_DRAFT_KEY) || '{}');
        if (borrador.tipo_envio !== undefined && borrador.tipo_envio !== null) {
          return String(borrador.tipo_envio).toLowerCase();
        }
      } catch (error) {
        console.warn('No se pudo leer checkoutPaso2Draft:', error);
      }
      return String(sessionStorage.getItem('tipo_envio') || '').toLowerCase();
    }

    function actualizarVisibilidadEntrega() {
      const tipoEnvio = obtenerTipoEnvio();
      const requiereEnvio = tipoEnvio === 'true' || tipoEnvio === '1';
      seccionEntrega.style.display = requiereEnvio ? '' : 'none';
    }

    actualizarVisibilidadEntrega();

    function llenar(prefix, data, campos, idKey) {
      console.log("data: ", data);
      campos.forEach(campo => {
        const input = document.getElementById(prefix + campo);
        if (!input) return;
        console.log("campo: ",campo);
        if (campo === 'estado' || campo === 'pais') {
          input.value = data?.[campo] != null ?
            String(data[campo]) :
            '';
        } else if (campo === 'recibe' && !data) {
          input.value = NOMBRE_USUARIO;
        } else {
          input.value = data?.[campo] ?? '';
        }

        input.disabled = !!data;

        if (campo === 'recibe') {
          input.disabled = false;
        }


        if (campo === 'tipo_persona') input.value = data?.[campo] || '1';
      });
      if (idKey === 'entrega') {
        idEntrega.value = data?.id_direccion || '0';
        nuevaEntrega.value = data ? '0' : '1';
        document.querySelectorAll('#tarjetasEntrega .address-card').forEach(b => b.classList.toggle('selected', !!data && b.dataset.address && JSON.parse(b.dataset.address).id_direccion == data.id_direccion));
      } else {
        idFiscal.value = data?.id_facturacion || '0';
        nuevaFiscal.value = data ? '0' : '1';
        document.querySelectorAll('#tarjetasFacturacion .address-card').forEach(b => b.classList.toggle('selected', !!data && b.dataset.billing && JSON.parse(b.dataset.billing).id_facturacion == data.id_facturacion));
      }
    }
    const camposEntrega = ['recibe', 'calle', 'numero', 'interior', 'telefono', 'colonia', 'municipio', 'estado', 'codigo_postal', 'referencia', 'notas_adicionales', 'pais'];
    const camposFiscal = ['nombres', 'paterno', 'materno', 'razon_social', 'rfc', 'curp', 'calle', 'numero', 'interior', 'colonia', 'municipio', 'estado', 'codigo_postal', 'pais', 'uso_cfdi'];
    document.querySelectorAll('[data-address]').forEach(btn => {
      btn.addEventListener('click', async () => {
        await catalogosListos;

        const data = JSON.parse(btn.dataset.address);

        llenar(
          'entrega_',
          data,
          camposEntrega,
          'entrega'
        );
      });
    });
    document.querySelectorAll('[data-billing]').forEach(btn => btn.addEventListener('click', () => {
      const data = JSON.parse(btn.dataset.billing);
      llenar('fiscal_', data, ['tipo_persona', ...camposFiscal], 'fiscal');
      document.getElementById('fiscal_tipo_persona').value = data.tipo_persona || '1';
      actualizarTipoPersona();
    }));
    document.querySelectorAll('[data-new-address]').forEach(btn => {
      btn.addEventListener('click', async () => {
        await catalogosListos;

        const tipo = btn.dataset.newAddress;

        if (tipo === 'entrega') {
          llenar(
            'entrega_',
            null,
            camposEntrega,
            'entrega'
          );
        } else {
          llenar(
            'fiscal_',
            null,
            ['tipo_persona', ...camposFiscal],
            'fiscal'
          );

          document.getElementById('fiscal_constancia').disabled = false;
          actualizarTipoPersona();
        }
      });
    });
    requiereFactura.addEventListener('change', () => {
      seccionFiscal.classList.toggle('d-none', !requiereFactura.checked);
      if (!requiereFactura.checked) {
        idFiscal.value = '0';
        nuevaFiscal.value = '0';
      }
    });

    function actualizarTipoPersona() {
      const moral = document.getElementById('fiscal_tipo_persona').value === '2';
      document.querySelector('[data-fiscal-field="razon_social"]').classList.toggle('d-none', !moral);
      ['nombres', 'paterno', 'materno', 'curp'].forEach(c => document.querySelector(`[data-fiscal-field="${c}"]`)?.classList.toggle('d-none', moral));
    }
    document.getElementById('fiscal_tipo_persona').addEventListener('change', actualizarTipoPersona);
    actualizarTipoPersona();

    form.addEventListener('submit', event => {
      const tipoEnvio = obtenerTipoEnvio();
      const envio = document.querySelector('input[name="tipo_envio"]:checked');
      const requiereEnvio = tipoEnvio === 'true' || tipoEnvio === '1' || envio?.value === 'true';

      document.getElementById('requiere_envio').value = requiereEnvio ? '1' : '0';


      if (requiereEnvio && idEntrega.value === '0' && nuevaEntrega.value !== '1') {
        event.preventDefault();
        alert('Selecciona un domicilio de entrega o captura uno nuevo.');
        return;
      }
      if (requiereFactura.checked && idFiscal.value === '0' && nuevaFiscal.value !== '1') {
        event.preventDefault();
        alert('Selecciona un domicilio fiscal o captura uno nuevo.');
      }
    });
  })();
</script>