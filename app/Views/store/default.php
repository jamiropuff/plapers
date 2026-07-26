<?php //echo "<pre>", var_dump($Placas), "</pre>"; ?>
<main>

    <!-- Product area start here -->
    <section class="product-area pt-130 pb-130">
        <div class="container">
            <div class="pb-20 bor-bottom shop-page-wrp d-flex justify-content-between align-items-center mb-65">
                <p class="fw-600"><?= $Descripcion; ?></p>
                <div class="short">
                    <select name="shortList" id="shortList">
                        <option value="0">Todo</option>
                        <option value="1">Fondos alternativos</option>
                        <option value="2">Fondos colores</option>
                        <option value="3">Fondos patrios</option>
                        <option value="4">Fondos de Estados Unidos</option>
                    </select>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-xl-12 col-lg-8">
                    <div class="row g-4">

                        <?php foreach ($Placas as $placa) { ?>

                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="product__item">
                                    <a href="#0" class="wishlist">
                                        <a href="detalle-producto.php" class="product__image pt-20 d-block">
                                            <img class="font-image" src="<?= base_url() ?>/fotos/<?= $placa['id_subcategoria']; ?>/<?= $placa['foto']; ?>" alt="image">
                                            <img class="back-image" src="<?= base_url() ?>/fotos/<?= $placa['id_subcategoria']; ?>/<?= $placa['foto']; ?>" alt="image">
                                        </a>
                                        <div class="product__content">
                                            <h4 class="product-title"><span class="secondary-hover"><?= $placa['nom_producto']; ?></span></h4>
                                            <!-- <h6 class="mb-15"><a class="primary-hover" href="#"><?php //$placa['clave']; ?></a></h6> -->
                                            <p class="fs-10"><?= $placa['nom_subcategoria']; ?></p>
                                            <span class="secondary-color"><?= $placa['precio_unitario']; ?></span>

                                        </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                  
                </div>
            </div>
        </div>
    </section>
    <!-- Product area end here -->
</main>