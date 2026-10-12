<!-- ABOUT US AREA START -->
<section class="about-us-section">
    <div class="container">

        <!-- cart page area start here -->
        <section class="cart-page pt-130 pb-130">
            <div class="container">


                <!-- Carrito para escritorio -->
                <div class="shopping-cart radius-10 bor sub-bg d-none d-md-block">

                    <div class="column-labels py-3 px-4 d-flex justify-content-between align-items-center fw-bold text-white text-uppercase">
                        <label class="product-details">Producto</label>
                        <label class="product-price text-center">Precio</label>
                        <label class="product-quantity text-center">Cantidad</label>
                        <label class="product-line-price text-center">Total</label>
                        <label class="product-removal text-center">Remover</label>
                    </div>

                    <div id="carrito-desktop">
                        <!-- JavaScript inserta los productos aquí -->
                    </div>

                    <div class="totals">
                        <div class="totals-item theme-color float-end mt-20">
                            <span class="fw-bold text-uppercase py-2">Subtotal = </span>
                            <div class="totals-value d-inline py-2 pe-2"
                                id="cart-subtotal-desktop">$0.00</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <!-- Carrito para móvil -->
                <div class="shopping-cart mobile-view bor sub-bg d-md-none">

                    <div id="carrito-mobile">
                        <!-- JavaScript inserta los productos aquí -->
                    </div>

                    <div class="totals">
                        <div class="totals-item theme-color float-end">
                            <span class="fw-bold text-uppercase py-2">Subtotal = </span>
                            <div class="totals-value d-inline py-2 pe-2"
                                id="cart-subtotal-mobile">$0.00</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>


            </div>
        </section>
        <!-- cart page area end here -->

    </div>
</section>