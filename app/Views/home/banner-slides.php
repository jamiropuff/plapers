<section class="custom-hero-slide" style="position: relative; margin: 0 auto; background-color: #050a1f; height: 100vh;">
    <picture style="height: 100vh;">
        <source media="(max-width: 991px)" srcset="<?= base_url('img/main-phones.jpg') ?>">
        <img src="<?= base_url('img/main.jpg') ?>" class="hero-bg-img" alt="Banner" style="max-height: 100%; width: 100%; object-fit: cover; height: 100%;">
    </picture>

    <!-- Price badge - visible on all screen sizes, positioned over the image -->
    <div class="hero-price-badge">
        <span class="price-from">DESDE</span>
        <span class="price-val">$126</span>
        <span class="price-cur">MXN</span>
    </div>
    
    <div class="hero-content-wrapper">
        <div class="container-fluid h-100" style="padding-left: 8%; padding-right: 5%;">
            <div class="row align-items-center h-100">
                <div class="col-lg-5 hero-text-col">
                    <h4 class="hero-subtitle d-none d-lg-block">LLEGASTE AL LUGAR INDICADO</h4>
                    <h1 class="hero-title mobile-resize">
                        Placas decorativas <br>
                        <span class="text-pink">personalizadas</span> <br>
                        a tu estilo
                    </h1>
                    <div class="btn-wrp mt-4 mt-lg-5">
                        <a href="shop.html" class="btn-hero-pink"><span>Personaliza tu placa</span></a>
                    </div>
                </div>
                <div class="col-lg-7 hero-image-col d-none d-lg-block" style="position: relative;">
                    <div class="hero-plates-wrapper">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner area end here -->