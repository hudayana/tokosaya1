

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const syncProductCarouselControls = () => {
    document.querySelectorAll('.product-carousel').forEach((carousel) => {
        const controls = document.querySelector(
            `[data-carousel-controls="${carousel.id}"]`,
        );

        if (controls) {
            controls.classList.toggle(
                'is-overflowing',
                carousel.scrollWidth > carousel.clientWidth + 1,
            );
        }
    });
};

syncProductCarouselControls();
window.addEventListener('resize', syncProductCarouselControls);

document.addEventListener('click', (event) => {
    const control = event.target instanceof Element
        ? event.target.closest('[data-carousel-target]')
        : null;

    if (!control) {
        return;
    }

    const carousel = document.getElementById(control.dataset.carouselTarget);

    if (!carousel) {
        return;
    }

    const direction = control.dataset.carouselDirection === 'next' ? 1 : -1;

    carousel.scrollBy({
        left: direction * carousel.clientWidth * 0.85,
        behavior: 'auto',
    });
});
