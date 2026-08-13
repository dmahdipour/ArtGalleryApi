import './bootstrap';
import '../css/app.css';
import 'flowbite';

import Swiper from 'swiper';
import {
    Autoplay,
    EffectFade,
    Navigation,
    Pagination,
} from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const heroSwiper = new Swiper('.heroSwiper', {
    modules: [
        Autoplay,
        EffectFade,
        Navigation,
        Pagination,
    ],

    effect: 'fade',

    fadeEffect: {
        crossFade: true,
    },

    loop: true,

    speed: 1000,

    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },

    navigation: {
        nextEl: '.hero-next',
        prevEl: '.hero-prev',
    },

    pagination: {
        el: '.hero-pagination',
        clickable: true,
    },
});