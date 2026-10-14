<!-- cart page area start here -->
<section class="cart-page pt-130 pb-130">
    <div class="container">

        <!-- Carrito para escritorio -->
        <div class="shopping-cart radius-10 bor sub-bg d-none d-md-block">

            <div class="column-labels py-3 px-4 d-flex justify-content-between align-items-center fw-bold text-white text-uppercase">
                <label class="product-details" style="width:40%">Producto</label>
                <label class="product-price text-center" style="width:15%">Precio</label>
                <label class="product-quantity text-center" style="width:15%">Cantidad</label>
                <label class="product-line-price text-center" style="width:15%">Total</label>
                <label class="product-removal text-center" style="width:10%">Remover</label>
            </div>

            <div id="carrito-desktop">
                <!-- JavaScript inserta los productos aquí -->
            </div>
        </div>

        <!-- Carrito para móvil -->
        <div class="shopping-cart mobile-view bor sub-bg d-md-none">
            <div id="carrito-mobile">
                <!-- JavaScript inserta los productos aquí -->
            </div>
        </div>


        <div class="shopping-cart">
            <div class="row mt-5">

                <div class="col-sm-6 mb-3 mb-sm-0">

                    <div class="card sub-bg text-white">
                        <div class="card-body">

                            <h4 class="card-title fw-bold">Tipo de envío</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-check-input" type="radio" name="tipo_envio" value="true" id="defaultCheck1" />
                                    <label class="form-check-label fs-sm" for="defaultCheck1">Envio a domicilio</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-check-input" type="radio" name="tipo_envio" value="false" id="defaultCheck2" />
                                    <label class="form-check-label fs-sm" for="defaultCheck2">Recoger en oficina</label>
                                </div>
                            </div>

                            <h4 class="card-title fw-bold mt-4">Método de pago</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-check-input" type="radio" name="metodo_pago" value="PAYPAL" id="defaultCheck3" />
                                    <label class="form-check-label fs-sm" for="defaultCheck3">Paypal</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-check-input" type="radio" name="metodo_pago" value="DEPOSITO" id="defaultCheck4" />
                                    <label class="form-check-label fs-sm" for="defaultCheck4">Depósito bancario</label>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-sm-6 mb-3 mb-sm-0">

                    <div class="card sub-bg text-white">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Detalles de pago</h5>
                            <table style="width: 100%;">
                                <tr style="border-bottom: 1px solid #6e6e6e;">
                                    <td class="td-title-1">Cantidad de productos: </td>
                                    <td class="td-title-2" id="tcantidad">
                                        0
                                        <small id="texplicacion" class="d-none">( 0 envío(s) )</small>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #6e6e6e;">
                                    <td class="td-title-1">Subtotal</td>
                                    <td class="td-title-2" id="tsubtotal">$ 0.00</td>
                                </tr>
                                <tr id="trEnvio" class="d-none" style="border-bottom: 1px solid #6e6e6e;">
                                    <td class="td-title-1">Envío</td>
                                    <td class="td-title-2" id="tenvio">$ 0.00</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #6e6e6e;">
                                    <td class="td-title-1">IVA</td>
                                    <td class="td-title-2" id="tiva">$ 0.00</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #6e6e6e;">
                                    <td class="order-total">Total a pagar</td>
                                    <td class="order-total-price" id="ttotal">$ 0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

            </div>


        </div>

        <div id="placas">
            <!-- JavaScript inserta los productos aquí -->
        </div>

        <div class="row mt-4 mb-2">
            <div class="col-md-12">
                <input type="checkbox" id="disclamer" style="transform: scale(1.3);">
                <label class="font-leyenda" for="disclamer">Entiendo que esta placa es de uso decorativo y no de uso oficial.</label>
            </div>
        </div>

        <div>
            <button id="btn-siguiente-paso" class="btn btn-secondary" disabled type="button" onclick="verificaLogin()">Siguiente paso</button>
        </div>

    </div>
</section>
<!-- cart page area end here -->