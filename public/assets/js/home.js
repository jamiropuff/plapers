const crearOpciones = () => {
    // 1. Velocidades de la animación (cuánto tarda en deslizarse la tarjeta)
    const velocidades = [1000, 1100, 1200];
    const velocidadAleatoria = velocidades[Math.floor(Math.random() * velocidades.length)];

    // 2. Delays del autoplay (cuánto tiempo se queda fija la tarjeta antes de cambiar)
    // Usamos valores desfasados (ej: 2.5s, 3s, 3.5s, 4s) para que nunca coincidan
    const delays = [2500, 3000, 3500] ;
    const delayAleatorio = delays[Math.floor(Math.random() * delays.length)];

    return {
        modules: [EffectCardsStack],
        effect: "cards-stack",
        direction: "vertical",
        centeredSlides: true,
        loop: true,
        loopAdditionalSlides: 3,
        grabCursor: true,
        initialSlide: 1,
        touchRatio: 1.5,
        
        speed: velocidadAleatoria,

        autoplay: {
            delay: delayAleatorio,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },

        mousewheel: {
            invert: false
        }
    };
};

new Swiper(".swipercardsamericana", crearOpciones());
new Swiper(".swipercardseuropea", crearOpciones());
new Swiper(".swipercardseuromini", crearOpciones());
new Swiper(".swipercardsbicicleta", crearOpciones());