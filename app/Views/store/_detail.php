<?php

/**
 * detalle.php
 *
 * Plantilla base convertida para CodeIgniter 4.
 * Esta es la estructura inicial SIN Vue.js.
 * En las siguientes partes se agregará la lógica JavaScript.
 */
?>
<main>

    <section class="shop-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-product-area mb-80">
                        <div class="row">

                            <!-- ====== PREVIEW PLACA ====== -->
                            <div class="col-md-5" id="placa">

                                <div id="textoL1" class="linea-1"></div>
                                <div id="textoL2" class="linea-2"></div>
                                <div id="textoL3" class="linea-3"></div>

                                <div class="imgs-zoom-area" style="position:relative">

                                    <img
                                        id="zoom_03"
                                        class="placa--img img-responsive"
                                        src=""
                                        alt="">

                                    <img
                                        id="imgAcabado"
                                        src=""
                                        style="position:absolute;top:0;left:0;">

                                </div>

                            </div>

                            <!-- ====== INFORMACIÓN ====== -->
                            <div class="col-md-7">

                                <div class="single-product-info">

                                    <h2 id="nombreProducto"></h2>

                                    <h6 id="claveProducto"></h6>

                                    <img
                                        id="imgPromo"
                                        class="new-detail"
                                        style="display:none"
                                        src=""
                                        alt="">

                                </div>

                                <hr>

                                <div class="single-product-tab">

                                    <ul class="reviews-tab mb-40">
                                        <li class="active"><a href="#disena" data-toggle="tab">Diseña tu placa</a></li>
                                        <li>|</li>
                                        <li><a href="#descrip" data-toggle="tab">Descripción</a></li>
                                        <li>|</li>
                                        <li><a href="#ejemplo" data-toggle="tab">Ejemplo</a></li>
                                        <li>|</li>
                                        <li><a href="#coments" data-toggle="tab">Reseñas</a></li>
                                    </ul>

                                    <div class="tab-content">

                                        <div class="tab-pane active" id="disena">

                                            <div id="listaLayouts" class="row mb-30"></div>

                                            <hr>

                                            <div id="opcionesL1"></div>

                                            <input
                                                id="inputL1"
                                                class="form-control"
                                                type="text"
                                                placeholder="Línea 1">

                                            <div id="contenedorL2">
                                                <div id="opcionesL2"></div>

                                                <input
                                                    id="inputL2"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Línea 2">
                                            </div>

                                            <div id="contenedorL3">

                                                <div id="opcionesL3"></div>

                                                <input
                                                    id="inputL3"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Línea 3">

                                            </div>

                                            <hr>

                                            <div id="listaAcabados"></div>

                                            <hr>

                                            <div id="listaColores"></div>

                                            <hr>

                                            <label>Cantidad</label>

                                            <input
                                                id="cantidad"
                                                type="number"
                                                min="1"
                                                value="1"
                                                class="form-control">

                                            <br>

                                            <button
                                                id="btnAgregar"
                                                class="btn btn-primary">

                                                Agregar al carrito

                                            </button>

                                        </div>

                                        <div class="tab-pane" id="descrip">

                                            <h4 id="medidasProducto"></h4>

                                            <img
                                                id="imgMedidas"
                                                class="img-responsive"
                                                src="">

                                            <br><br>

                                            <p id="descripcionProducto"></p>

                                        </div>

                                        <div class="tab-pane" id="ejemplo">

                                            <img
                                                id="imgEjemplo"
                                                class="img-responsive"
                                                src="">

                                        </div>

                                        <div class="tab-pane" id="coments">

                                            <div id="listaResenas"></div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('js/detalle.js') ?>"></script>

</main>