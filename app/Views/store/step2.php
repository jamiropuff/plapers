<section class="cart-page pt-130 pb-130">
    <div class="container">

        <h2 class="text-white mb-4">
            Datos Adicionales — Paso 2
        </h2>

        <p class="text-white">
            Bienvenido,
            <?= esc(session()->get('Nombres') ?? '') ?>
        </p>

        <p class="text-white">
            Aquí se capturarán los datos necesarios
            para completar tu compra.
        </p>

        <a href="<?= base_url('carrito') ?>"
           class="btn btn-secondary">
            Regresar al carrito
        </a>

    </div>
</section>
