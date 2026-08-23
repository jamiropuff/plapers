<?php echo "<pre>", var_dump($Galeria), "</pre>"; ?>
<main>

    <!-- Product area start here -->
    <section class="product-area pt-30 pb-130">
        <div class="container">
            <div class="pb-20 bor-bottom shop-page-wrp d-flex justify-content-between align-items-center mb-65">
                <h2 class="title-placas"><?= $Titulo; ?></h2>
                <p class="fw-600"><?= $Descripcion; ?></p>
            </div>
            <div class="row g-4">
                <div class="col-xl-12 col-lg-8">
                    <div class="row g-4">

                        <?php foreach ($Galeria['Galeria'] as $gallery) { ?>

                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="product__item_gallery">
                                    <a href="<?= base_url('/placas/detalle/' . $gallery['id_galeria']); ?>" class="wishlist"></a>
                                    <a href="<?= base_url('/placas/detalle/' . $gallery['id_galeria']); ?>" class="product__image pt-20 d-block">
                                        <img class="font-image" src="<?= base_url() ?>/galeria/<?= $gallery['id_subcategoria']; ?>/<?= $gallery['foto']; ?>" alt="image">
                                        <img class="back-image" src="<?= base_url() ?>/galeria/<?= $gallery['id_subcategoria']; ?>/<?= $gallery['foto']; ?>" alt="image">
                                    </a>
                                    <div class="product__content">
                                        <h4 class="product-title"><span class="secondary-hover"><?= $gallery['nom_producto']; ?></span></h4>
                                        <!-- <h6 class="mb-15"><a class="primary-hover" href="#"><?php //$gallery['clave']; ?></a></h6> -->
                                        <p class="fs-10"><?= $gallery['nom_subcategoria']; ?></p>

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