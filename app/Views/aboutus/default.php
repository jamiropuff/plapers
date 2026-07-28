<!-- ABOUT US AREA START -->
<section class="about-us-section" style="background-color: #050b14; padding: 100px 0; min-height: 100vh;">
    <div class="container">
        
        <!-- Sección 1: Nosotros -->
        <div class="row align-items-center mb-5">
            <!-- Mobile: Image goes first via order classes -->
            <div class="col-lg-6 order-2 order-lg-1 text-center text-lg-start mt-4 mt-lg-0">
                <span style="color: #E91E63; font-weight: 700; font-size: 14px; letter-spacing: 1px;" class="text-uppercase d-block mb-3">NOSOTROS</span>
                <h2 class="text-white fw-bold mb-4" style="font-size: 2.2rem; line-height: 1.2;">Placas decorativas personalizadas desde los noventa.</h2>
                <p style="color: #d1d5db; line-height: 1.8; font-size: 16px;" class="mb-4 text-start">
                    PLAPERS® empresa orgullosamente MEXICANA, con amplia experiencia en la fabricación y distribución de placas personalizadas de tipo "DECORATIVO", ha contribuido desde la década de los noventas a impulsar la creatividad de nuestros clientes al ofrecer la oportunidad de personalizar nuestros productos a su gusto con materiales de alta calidad, dando como consecuencia que día con día se vaya logrando la aceptación de un mayor número de consumidores a nivel nacional.
                </p>
                <div class="d-flex flex-column flex-lg-row gap-3 mt-4">
                    <a href="#" class="btn text-white text-center d-flex align-items-center justify-content-center" style="background-color: #E91E63; padding: 14px 32px; border: none; font-weight: 500; border-radius: 6px; transition: all 0.3s;">Ver diseños</a>
                    <a href="#" class="btn text-white text-center d-flex align-items-center justify-content-center" style="background-color: transparent; border: 2px solid #E91E63; padding: 14px 32px; font-weight: 500; border-radius: 6px; transition: all 0.3s;">Personalizar placa</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="<?= base_url('img/acerca_de/plaplers.png') ?>" alt="Plapers Nosotros" class="img-fluid" style="filter: drop-shadow(0 25px 25px rgba(0,0,0,0.6)); max-width: 100%;">
            </div>
        </div>

        <!-- Sección 2: Filosofía / Misión -->
        <div class="row align-items-center" style="margin-top: 8rem;">
            <!-- Mobile: Image goes first via order classes -->
            <div class="col-lg-6 order-1 text-center mb-4 mb-lg-0">
                <img id="tab-image" src="<?= base_url('img/acerca_de/mision.png') ?>" alt="MISIÓN Plapers" class="img-fluid" style="filter: drop-shadow(0 25px 25px rgba(0,0,0,0.6)); max-width: 100%; transition: opacity 0.2s ease-in-out;">
            </div>
            <div class="col-lg-6 order-2">
                <!-- Tabs -->
                <div class="d-flex flex-row mb-4" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <button class="custom-tab-btn active" data-target="tab-mision" data-img="<?= base_url('img/acerca_de/mision.png') ?>">MISIÓN</button>
                    <button class="custom-tab-btn" data-target="tab-vision" data-img="<?= base_url('img/acerca_de/vision.png') ?>">VISIÓN</button>
                    <button class="custom-tab-btn" data-target="tab-valores" data-img="<?= base_url('img/acerca_de/valores.png') ?>">VALORES</button>
                </div>
                
                <!-- Tabs Content -->
                <div id="tab-mision" class="custom-tab-content active" style="display: block;">
                    <p style="color: #d1d5db; line-height: 1.8; font-size: 16px;" class="text-start m-0">
                        Personalizar y desarrollar productos al consumidor que quiera un producto original y novedoso, con materiales y procesos de la más alta calidad, así como seguir mejorando procesos para tener una mejora continua en todos los productos que como resultado da el poder expandir nuestro mercado.
                    </p>
                </div>
                <div id="tab-vision" class="custom-tab-content" style="display: none;">
                    <p style="color: #d1d5db; line-height: 1.8; font-size: 16px;" class="text-start m-0">
                        Mantener la calidad e innovación en nuestros productos sin perder de vista la calidad y durabilidad para llegar a ser una empresa competitiva en el mercado nacional.
                    </p>
                </div>
                <div id="tab-valores" class="custom-tab-content" style="display: none;">
                    <p style="color: #d1d5db; line-height: 1.8; font-size: 16px;" class="text-start m-0">
                        Honestidad que busca ganar la confianza de nuestros clientes; atención y esmero al momento de hacer su compra; trato amable, cordialidad y eficaz, que genere confianza para que su compra sea satisfactoria.
                    </p>
                </div>
            </div>
        </div>
        
    </div>
</section>

<style>
    .custom-tab-btn {
        background: transparent;
        border: none;
        color: #6b7280;
        font-weight: 700;
        font-size: 16px;
        padding: 10px 20px 15px;
        margin-right: 15px;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        text-transform: uppercase;
        cursor: pointer;
    }
    .custom-tab-btn.active {
        color: #ffffff;
        border-bottom: 3px solid #E91E63;
    }
    .custom-tab-btn:hover:not(.active) {
        color: #9ca3af;
    }
    .custom-tab-btn:focus {
        outline: none;
    }
    .custom-tab-content {
        animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 991px) {
        .about-us-section .btn {
            width: 100%;
        }
        .custom-tab-btn {
            padding: 10px 10px 15px;
            margin-right: 5px;
            font-size: 14px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll('.custom-tab-btn');
        const tabContents = document.querySelectorAll('.custom-tab-content');
        const tabImage = document.getElementById('tab-image');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // If it's already active, do nothing
                if (this.classList.contains('active')) return;

                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.style.display = 'none');

                this.classList.add('active');
                
                // Show matching text
                const targetId = this.getAttribute('data-target');
                document.getElementById(targetId).style.display = 'block';

                // Change image with fade effect
                const targetImg = this.getAttribute('data-img');
                const tabText = this.textContent;
                
                tabImage.style.opacity = '0';
                setTimeout(() => {
                    tabImage.src = targetImg;
                    tabImage.alt = tabText + ' Plapers';
                    tabImage.style.opacity = '1';
                }, 200); // Wait for the opacity transition to complete before changing the source
            });
        });
    });
</script>
<!-- ABOUT US AREA END -->