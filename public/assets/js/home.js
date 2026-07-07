const opciones = {
    modules: [EffectCardsStack],
    effect: "cards-stack",
    direction: "vertical",
    centeredSlides: true,
    loop: true,
    loopAdditionalSlides: 3,
    grabCursor: true,
    initialSlide: 1,
    touchRatio: 1.5,

    speed: 1200,

    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
    },

    mousewheel: {
        invert: false
    }
};

new Swiper(".swipercardsamericana", opciones);
new Swiper(".swipercardseuropea", opciones);
new Swiper(".swipercardseuromini", opciones);
new Swiper(".swipercardsbicicleta", opciones);