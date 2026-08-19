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

// Slider
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

// Mobile Menu
const mobileMenuButton = document.getElementById('mobileMenuButton');
const mobileMenu = document.getElementById('mobileMenu');
const mobileMenuIcon = document.getElementById('mobileMenuIcon');

mobileMenuButton?.addEventListener('click', () => {
    const isOpen = mobileMenuButton.getAttribute('aria-expanded') === 'true';
    if (isOpen) {
        // Close
        mobileMenu.classList.add('hidden');
        mobileMenuButton.setAttribute('aria-expanded', 'false');
        mobileMenuIcon.innerHTML = `
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M4 7h16M4 12h16M4 17h16"
            />
        `;
    } else {
        // Open
        mobileMenu.classList.remove('hidden');
        mobileMenuButton.setAttribute('aria-expanded', 'true');
        mobileMenuIcon.innerHTML = `
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M6 6l12 12M18 6L6 18"
            />
        `;
    }
});