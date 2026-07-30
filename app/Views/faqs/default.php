<!-- FAQS AREA START -->
<section class="faqs-section" style="background-color: #050b14; padding: 100px 0; min-height: 100vh;">
    <div class="container">
        
        <!-- Top Section: Image and Text -->
        <div class="row align-items-center mb-5">
            <!-- Mobile: Image goes first via order classes -->
            <div class="col-lg-6 order-1 text-center mb-4 mb-lg-0">
                <img src="<?= base_url('img/otros/faqs.png') ?>" alt="FAQs Plapers" class="img-fluid" style="filter: drop-shadow(0 25px 25px rgba(0,0,0,0.6)); max-width: 100%; max-height: 350px; object-fit: contain;">
            </div>
            <div class="col-lg-6 order-2 text-start px-4 px-lg-3">
                <span style="color: #E91E63; font-weight: 700; font-size: 14px; letter-spacing: 1px;" class="text-uppercase d-block mb-3 mt-4 mt-lg-0">FAQS</span>
                <h2 class="text-white fw-bold mb-4" style="font-size: 2.2rem; line-height: 1.2;">Preguntas frecuentes</h2>
                <p style="color: #d1d5db; line-height: 1.8; font-size: 15px; text-align: justify;" class="mb-4">
                    Consulta la información más importante antes de realizar tu pedido: cómo personalizar tu placa, qué textos puedes usar, tiempos estimados de producción, condiciones de envío, cambios, cancelaciones y recomendaciones de cuidado.
                </p>
            </div>
        </div>

        <!-- Accordion Section -->
        <div class="row justify-content-center mt-5 px-3 px-lg-0">
            <div class="col-lg-12">
                <div class="custom-accordion">
                    <!-- Item 1 -->
                    <div class="faq-item">
                        <button class="faq-btn">
                            ¿Las placas son oficiales?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-content">
                            <p>No, nuestras placas son de carácter 100% decorativo y novedoso. No sustituyen a una placa oficial emitida por el gobierno y no deben usarse con ese fin en vehículos que circulen por vías públicas.</p>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="faq-item">
                        <button class="faq-btn">
                            ¿Puedo personalizar cualquier texto?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-content">
                            <p>Sí, puedes personalizar tus placas con el texto, números o combinaciones que prefieras, siempre y cuando se ajuste al límite de caracteres permitido para el tipo de placa seleccionada.</p>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="faq-item">
                        <button class="faq-btn">
                            ¿Puedo revisar mi diseño antes de comprar?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-content">
                            <p>¡Claro que sí! Contamos con un pre-visualizador en nuestra tienda que te permite ver cómo quedará tu placa personalizada antes de agregarla al carrito y realizar tu compra.</p>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="faq-item">
                        <button class="faq-btn">
                            ¿Cuánto tarda la producción?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-content">
                            <p>El tiempo estimado de producción es de 2 a 5 días hábiles, dependiendo del volumen de pedidos y el tipo de placa. Una vez terminada, procedemos inmediatamente con el envío.</p>
                        </div>
                    </div>
                    <!-- Item 5 -->
                    <div class="faq-item">
                        <button class="faq-btn">
                            ¿Hacen envíos a todo México?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-content">
                            <p>Sí, realizamos envíos a toda la República Mexicana. Trabajamos con las mejores paqueterías para asegurar que tu placa llegue en perfectas condiciones hasta la puerta de tu casa.</p>
                        </div>
                    </div>
                    <!-- Item 6 -->
                    <div class="faq-item">
                        <button class="faq-btn">
                            ¿Puedo cancelar o cambiar mi pedido?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-content">
                            <p>Debido a que nuestros productos son personalizados y fabricados sobre pedido, las cancelaciones o cambios solo pueden realizarse dentro de las primeras 2 horas posteriores a la confirmación de compra.</p>
                        </div>
                    </div>
                    <!-- Item 7 -->
                    <div class="faq-item">
                        <button class="faq-btn">
                            ¿Qué cuidados necesita mi placa?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-content">
                            <p>Nuestras placas están hechas con materiales de alta calidad, pero te recomendamos limpiarlas solo con agua y jabón suave. Evita el uso de solventes o productos químicos abrasivos para no dañar los acabados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="row mt-5 pt-4">
            <div class="col-lg-12">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between p-4" style="background: transparent;">
                    <div class="text-center text-md-start mb-4 mb-md-0 d-flex flex-column align-items-center align-items-md-start mx-auto mx-md-0">
                        <h3 class="text-white fw-bold mb-2" style="font-size: 1.25rem;">¿No encontraste tu respuesta?</h3>
                        <p style="color: #d1d5db; margin: 0; font-size: 14px; max-width: 450px;">Escríbenos y te ayudamos a resolver cualquier duda sobre tu placa personalizada.</p>
                    </div>
                    <a href="<?= base_url('web/contacto') ?>" class="btn text-white text-center mt-3 mt-md-0 mx-auto mx-md-0" style="background-color: #E91E63; padding: 12px 35px; border: none; font-weight: 500; border-radius: 4px; transition: all 0.3s;">Contacto</a>
                </div>
            </div>
        </div>
        
    </div>
</section>

<style>
    .faq-item {
        background-color: transparent;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 4px;
        margin-bottom: 8px;
        overflow: hidden;
    }
    .faq-btn {
        background: #080f1c; /* Slightly lighter than background */
        color: #e5e7eb;
        width: 100%;
        text-align: left;
        padding: 16px 24px;
        border: none;
        outline: none;
        font-size: 15px;
        font-weight: 400;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .faq-btn:hover {
        background: #0b1426;
    }
    .faq-icon {
        color: #E91E63;
        font-size: 20px;
        font-weight: 400;
        line-height: 1;
        transition: transform 0.3s ease;
    }
    .faq-btn.active .faq-icon {
        transform: rotate(45deg); /* Turns + into x */
    }
    .faq-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        background: #080f1c;
    }
    .faq-content p {
        padding: 0 24px 20px;
        margin: 0;
        color: #9ca3af;
        font-size: 14px;
        line-height: 1.6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqBtns = document.querySelectorAll('.faq-btn');
        
        faqBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Check if this is already active
                const isActive = this.classList.contains('active');
                
                // Close all
                faqBtns.forEach(b => {
                    b.classList.remove('active');
                    b.nextElementSibling.style.maxHeight = null;
                });
                
                // If it wasn't active, open it
                if (!isActive) {
                    this.classList.add('active');
                    const content = this.nextElementSibling;
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });
    });
</script>
<!-- FAQS AREA END -->