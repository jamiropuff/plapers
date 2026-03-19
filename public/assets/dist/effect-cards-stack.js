/**
 * UI Initiative Cards Stack Slider
 *
 * Cards Stack slider made with Swiper
 *
 * https://uiinitiative.com
 *
 * Copyright 2025 UI Initiative
 *
 * Released under the UI Initiative Regular License
 *
 * February 07, 2025
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = typeof globalThis !== 'undefined' ? globalThis : global || self, global.EffectCardsStack = factory());
})(this, (function () { 'use strict';

  function classesToTokens(classes) {
    if (classes === void 0) {
      classes = '';
    }
    return classes.trim().split(' ').filter(c => !!c.trim());
  }
  function getSlideTransformEl(slideEl) {
    return slideEl.querySelector('.swiper-slide-transform') || slideEl.shadowRoot && slideEl.shadowRoot.querySelector('.swiper-slide-transform') || slideEl;
  }
  function createElement(tag, classes) {
    if (classes === void 0) {
      classes = [];
    }
    const el = document.createElement(tag);
    el.classList.add(...(Array.isArray(classes) ? classes : classesToTokens(classes)));
    return el;
  }
  function elementTransitionEnd(el, callback) {
    function fireCallBack(e) {
      if (e.target !== el) return;
      callback.call(el, e);
      el.removeEventListener('transitionend', fireCallBack);
    }
    if (callback) {
      el.addEventListener('transitionend', fireCallBack);
    }
  }

  function createShadow(suffix, slideEl, side) {
    const shadowClass = `swiper-slide-shadow${side ? `-${side}` : ''}${suffix ? ` swiper-slide-shadow-${suffix}` : ''}`;
    const shadowContainer = getSlideTransformEl(slideEl);
    let shadowEl = shadowContainer.querySelector(`.${shadowClass.split(' ').join('.')}`);
    if (!shadowEl) {
      shadowEl = createElement('div', shadowClass.split(' '));
      shadowContainer.append(shadowEl);
    }
    return shadowEl;
  }

  function effectInit(params) {
    const {
      effect,
      swiper,
      on,
      setTranslate,
      setTransition,
      overwriteParams,
      perspective,
      recreateShadows,
      getEffectParams
    } = params;
    on('beforeInit', () => {
      if (swiper.params.effect !== effect) return;
      swiper.classNames.push(`${swiper.params.containerModifierClass}${effect}`);
      if (perspective && perspective()) {
        swiper.classNames.push(`${swiper.params.containerModifierClass}3d`);
      }
      const overwriteParamsResult = overwriteParams ? overwriteParams() : {};
      Object.assign(swiper.params, overwriteParamsResult);
      Object.assign(swiper.originalParams, overwriteParamsResult);
    });
    on('setTranslate', () => {
      if (swiper.params.effect !== effect) return;
      setTranslate();
    });
    on('setTransition', (_s, duration) => {
      if (swiper.params.effect !== effect) return;
      setTransition(duration);
    });
    on('transitionEnd', () => {
      if (swiper.params.effect !== effect) return;
      if (recreateShadows) {
        if (!getEffectParams || !getEffectParams().slideShadows) return;
        // remove shadows
        swiper.slides.forEach(slideEl => {
          slideEl.querySelectorAll('.swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left').forEach(shadowEl => shadowEl.remove());
        });
        // create new one
        recreateShadows();
      }
    });
    let requireUpdateOnVirtual;
    on('virtualUpdate', () => {
      if (swiper.params.effect !== effect) return;
      if (!swiper.slides.length) {
        requireUpdateOnVirtual = true;
      }
      requestAnimationFrame(() => {
        if (requireUpdateOnVirtual && swiper.slides && swiper.slides.length) {
          setTranslate();
          requireUpdateOnVirtual = false;
        }
      });
    });
  }

  function effectTarget(effectParams, slideEl) {
    const transformEl = getSlideTransformEl(slideEl);
    if (transformEl !== slideEl) {
      transformEl.style.backfaceVisibility = 'hidden';
      transformEl.style['-webkit-backface-visibility'] = 'hidden';
    }
    return transformEl;
  }

  function effectVirtualTransitionEnd(_ref) {
    let {
      swiper,
      duration,
      transformElements,
      allSlides
    } = _ref;
    const {
      activeIndex
    } = swiper;
    const getSlide = el => {
      if (!el.parentElement) {
        // assume shadow root
        const slide = swiper.slides.filter(slideEl => slideEl.shadowRoot && slideEl.shadowRoot === el.parentNode)[0];
        return slide;
      }
      return el.parentElement;
    };
    if (swiper.params.virtualTranslate && duration !== 0) {
      let eventTriggered = false;
      let transitionEndTarget;
      if (allSlides) {
        transitionEndTarget = transformElements;
      } else {
        transitionEndTarget = transformElements.filter(transformEl => {
          const el = transformEl.classList.contains('swiper-slide-transform') ? getSlide(transformEl) : transformEl;
          return swiper.getSlideIndex(el) === activeIndex;
        });
      }
      transitionEndTarget.forEach(el => {
        elementTransitionEnd(el, () => {
          if (eventTriggered) return;
          if (!swiper || swiper.destroyed) return;
          eventTriggered = true;
          swiper.animating = false;
          const evt = new window.CustomEvent('transitionend', {
            bubbles: true,
            cancelable: true
          });
          swiper.wrapperEl.dispatchEvent(evt);
        });
      });
    }
  }

  if (typeof window !== 'undefined' && window.SwiperElementRegisterParams) {
    window.SwiperElementRegisterParams(['cardsStackEffect']);
  }

  function EffectCardsStack({ swiper, on, extendParams }) {
    extendParams({
      cardsStackEffect: {
        slideShadows: true,
      },
    });

    const setTranslate = () => {
      const { slides, rtlTranslate: rtl } = swiper;
      const params = swiper.params.cardsStackEffect;
      const R = swiper.size / 2;
      const rtlMultiplier = rtl ? -1 : 1;

      for (let i = 0; i < slides.length; i += 1) {
        const slideEl = slides[i];
        const slideProgress = slideEl.progress;
        const progress = Math.min(Math.max(slideProgress, -4), 4);
        let offset = slideEl.swiperSlideOffset;

        if (swiper.params.centeredSlides && swiper.params.cssMode) {
          offset -= slides[0].swiperSlideOffset;
        }
        let tX = swiper.params.cssMode ? -offset - swiper.translate : -offset;
        let tY = 0;
        let tZ = 0;

        let rotateX = 0;
        let rotateY = 0;
        if (progress < 0) {
          const absProgress = Math.abs(progress);
          const pathProgress = Math.min(2, absProgress);
          const pathRotate = (-pathProgress * Math.PI) / 2;
          tZ = `${R * Math.cos(pathRotate) - R}px`;
          tX = `${tX - rtlMultiplier * R * Math.sin(pathRotate)}px`;
          const rotateProgress = Math.min(4, absProgress * 2);
          rotateY = -Math.max(-180, -rotateProgress * 80);
        } else if (progress > 0) {
          const absProgress = Math.abs(progress);
          const pathProgress = Math.min(4, absProgress);
          const pathRotate = (pathProgress * Math.PI) / 4;
          tZ = `${R * Math.cos(pathRotate) - R}px`;
          tX = `${tX - rtlMultiplier * R * Math.sin(pathRotate)}px`;
          rotateY = absProgress * 20;
        } else {
          tX = `${tX}px`;
        }
        if (!swiper.isHorizontal()) {
          tY = tX;
          tX = 0;
          rotateX = -rotateY;
          rotateY = 0;
        } else if (rtl) {
          rotateY = -rotateY;
        }

        /* eslint-disable */
        const transform = `
        translate3d(${tX}, ${tY}, ${tZ})
        scale(${1})
        rotateX(${rotateX}deg)
        rotateY(${rotateY}deg)
      `;
        /* eslint-enable */

        if (params.slideShadows) {
          // Set shadows
          let shadowEl = slideEl.querySelector('.swiper-slide-shadow');
          if (!shadowEl) {
            shadowEl = createShadow('cards', slideEl);
          }
          if (shadowEl)
            shadowEl.style.opacity = Math.min(
              Math.max((Math.abs(progress) - 0.5) / 0.5, 0),
              1,
            );
        }

        slideEl.style.zIndex =
          -Math.abs(Math.round(slideProgress)) + slides.length;
        const targetEl = effectTarget(params, slideEl);
        targetEl.style.transform = transform;
      }
    };

    const setTransition = (duration) => {
      const transformElements = swiper.slides.map((slideEl) =>
        getSlideTransformEl(slideEl),
      );
      transformElements.forEach((el) => {
        el.style.transitionDuration = `${duration}ms`;
        el.querySelectorAll('.swiper-slide-shadow').forEach((shadowEl) => {
          shadowEl.style.transitionDuration = `${duration}ms`;
        });
      });

      effectVirtualTransitionEnd({ swiper, duration, transformElements });
    };
    effectInit({
      effect: 'cards-stack',
      swiper,
      on,
      setTranslate,
      setTransition,
      perspective: () => true,
      overwriteParams: () => ({
        centeredSlides: true,
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 0,
        loopAdditionalSlides: 1,
        watchSlidesProgress: true,
        virtualTranslate: !swiper.params.cssMode,
      }),
    });
  }

  return EffectCardsStack;

}));
//# sourceMappingURL=effect-cards-stack.js.map
