<form
  id="frmPaypal"
  action="https://www.paypal.com/cgi-bin/webscr"
  method="post"
  style="display:none">
  <input type="hidden" name="first_name" id="pp_first_name">
  <input type="hidden" name="last_name" id="pp_last_name">
  <input type="hidden" name="email" id="pp_email">

  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="upload" value="1">
  <input type="hidden" name="business" value="r.penuelas@plapers.com.mx">
  <input type="hidden" name="lc" value="MX">
  <input type="hidden" name="bn" value="Upper_BuyNow_WPS_MX">
  <input type="hidden" name="rm" value="2">
  <input type="hidden" name="button_subtype" value="products">
  <input type="hidden" name="no_note" value="1">
  <input type="hidden" name="currency_code" value="MXN">

  <input type="hidden" name="address_override" id="pp_address_override" value="0">
  <input type="hidden" name="address1" id="pp_address1">
  <input type="hidden" name="city" id="pp_city">
  <input type="hidden" name="state" id="pp_state">
  <input type="hidden" name="zip" id="pp_zip">
  <input type="hidden" name="country" value="MX">
  <input type="hidden" name="night_phone_a" value="52">
  <input type="hidden" name="night_phone_b" id="pp_phone">

  <div id="paypal-productos"></div>

  <input type="hidden" name="notify_url" id="url_verify">
  <input type="hidden" name="return" id="url_success">
  <input type="hidden" name="cancel_return" id="url_cancel">

  <img
    alt=""
    src="https://www.paypalobjects.com/en_US/i/src/pixel.gif"
    width="1"
    height="1">
</form>


<script>
  const URL_GUARDAR_ORDEN = <?= json_encode(base_url('usuarios/guarda_orden')) ?>;
  const URL_COMPRAS = <?= json_encode(base_url('compras')) ?>;

  function asignarCampo(id, valor) {
    const elemento = document.getElementById(id);

    if (elemento) {
      elemento.value = valor ?? '';
    }
  }

  function construirFormularioPaypal(productos, envio) {
    const config = window.checkoutPaso3;
    const usuario = config.usuario || {};
    const direccion = config.direccion || {};

    asignarCampo('pp_first_name', usuario.nombres);
    asignarCampo(
      'pp_last_name',
      [usuario.paterno, usuario.materno].filter(Boolean).join(' ')
    );
    asignarCampo('pp_email', usuario.email);

    asignarCampo('pp_address_override', envio ? '1' : '0');

    asignarCampo(
      'pp_address1',
      envio ?
      [direccion.calle, direccion.numero, direccion.interior]
      .filter(Boolean).join(' ') :
      ''
    );

    asignarCampo(
      'pp_city',
      envio ?
      [direccion.colonia, direccion.municipio]
      .filter(Boolean).join(' ') :
      ''
    );

    asignarCampo('pp_state', envio ? direccion.estado : '');
    asignarCampo('pp_zip', envio ? direccion.codigo_postal : '');
    asignarCampo('pp_phone', envio ? direccion.telefono : '');

    const contenedor = document.getElementById('paypal-productos');
    contenedor.replaceChildren();

    function agregarInput(nombre, valor) {
      const input = document.createElement('input');

      input.type = 'hidden';
      input.name = nombre;
      input.value = String(valor ?? '');

      contenedor.appendChild(input);
    }

    productos.forEach((producto, indice) => {
      const numero = indice + 1;

      agregarInput(
        `item_name_${numero}`,
        producto.nom_producto
      );

      agregarInput(
        `amount_${numero}`,
        Number(producto.precio_unitario).toFixed(2)
      );

      agregarInput(
        `quantity_${numero}`,
        Math.max(1, parseInt(producto.cantidad, 10) || 1)
      );
    });

    // Mantiene el concepto de envío como una partida independiente.
    const numeroEnvio = productos.length + 1;

    agregarInput(`item_name_${numeroEnvio}`, 'Envio');
    agregarInput(
      `amount_${numeroEnvio}`,
      Number(envio ? config.precioEnvio : 0).toFixed(2)
    );
    agregarInput(`quantity_${numeroEnvio}`, 1);
  }

  async function procesarCompra() {
    const config = window.checkoutPaso3;
    const productos = cargarCarrito();

    if (!productos.length) {
      Swal.fire('Carrito vacío', 'Agrega productos antes de continuar.', 'warning');
      return;
    }

    if (!document.getElementById('autorizacion_diseno')?.checked) {
      Swal.fire(
        'Falta tu autorización',
        'Debes aprobar la vista previa de tu diseño.',
        'warning'
      );
      return;
    }

    if (!config?.token) {
      Swal.fire('Sesión', 'Necesitas iniciar sesión para continuar.', 'warning');
      return;
    }

    const boton = document.getElementById('btnProcesarCompra');

    if (boton) {
      boton.disabled = true;
    }

    try {
      const formData = new FormData();

      formData.set('Token', config.token);
      formData.set('Id_Tipo_Pago', config.idTipoPago);
      formData.set('Id_Estatus_Pago', 1);
      formData.set('Id_Tipo_Envio', config.idTipoEnvio);
      formData.set('Id_Estatus_Pedido', 1);

      formData.set('Subtotal', config.subtotal);
      formData.set('Iva', config.iva);
      formData.set('Envio', config.precioEnvio);
      formData.set('Total', config.total);

      formData.set('Id_Direccion', config.idDireccion || 0);
      formData.set('Id_Facturacion', config.idFacturacion || 0);
      formData.set('Id_uso', config.idUso || 0);

      formData.set('Productos', JSON.stringify(productos));
      formData.set(
        'Notas_Adicionales',
        document.getElementById('observaciones_usuario')?.value || ''
      );

      const respuesta = await fetch(URL_GUARDAR_ORDEN, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const resultado = await respuesta.json();

      if (!respuesta.ok || resultado.Code !== config.codigoExito) {
        throw new Error(resultado.Msg || 'No se pudo guardar la orden.');
      }

      const idOrden = resultado.Id;

      if (!idOrden) {
        throw new Error('La respuesta no contiene el ID de la orden.');
      }

      if (Number(config.idTipoPago) === 1) {
        // Completar el formulario con las URLs de la orden recién creada.
        asignarCampo(
          'url_success',
          URL_COMPRAS + '/success/' + encodeURIComponent(idOrden)
        );

        asignarCampo(
          'url_cancel',
          URL_COMPRAS + '/cancel/' + encodeURIComponent(idOrden)
        );

        asignarCampo(
          'url_verify',
          URL_COMPRAS + '/verify/' + encodeURIComponent(idOrden)
        );

        construirFormularioPaypal(
          productos,
          Number(config.idTipoEnvio) === 1
        );

        localStorage.removeItem('cart');
        document.getElementById('frmPaypal').submit();

        return;
      }

      // Depósito bancario: la orden ya está guardada.
      localStorage.removeItem('cart');

      await Swal.fire(
        'Orden registrada',
        'Tu pedido se guardó correctamente. Consulta tu correo para ver las instrucciones de pago.',
        'success'
      );

      window.location.href = URL_COMPRAS;

    } catch (error) {
      Swal.fire('Error', error.message || 'Ocurrió un error al procesar tu compra.', 'error');

      if (boton) {
        boton.disabled = false;
      }
    }
  }
</script>
<script>
window.checkoutPaso3 = <?= json_encode([
    'token' => session()->get('Token') ?? '',

    // Estos datos debe proporcionarlos el controlador.
    'usuario' => $datosUsuario ?? [],
    'direccion' => $direccionEnvio ?? [],

    'idTipoPago' => (int) ($idTipoPago ?? 1),
    'idTipoEnvio' => (int) ($idTipoEnvio ?? 2),

    'idDireccion' => (int) ($idDireccion ?? 0),
    'idFacturacion' => (int) ($idFacturacion ?? 0),
    'idUso' => (int) ($idUso ?? 0),

    'subtotal' => $subtotal ?? 0,
    'iva' => $iva ?? 0,
    'precioEnvio' => $precioEnvio ?? 0,
    'total' => $total ?? 0,

    'codigoExito' => REQUEST_SUCCESS
], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
</script>