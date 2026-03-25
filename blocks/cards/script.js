/**
 * Aura Solis Cards Carousel Logic
 * Sliding group manager with dynamic arrow visibility
 */
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('cards-track');
    const prevBtn = document.getElementById('carousel-prev');
    const nextBtn = document.getElementById('carousel-next');
    const dots    = document.querySelectorAll('.carousel-dots .dot');

    if (!track || !prevBtn || !nextBtn) return;

    // Helper to calculate widths
    const getSlideWidth = () => {
        const item = track.querySelector('.card-item');
        if (!item) return 0;
        const style = window.getComputedStyle(track);
        const gap = parseInt(style.getPropertyValue('gap')) || 0;
        // Desktop: slide 3 cards at once
        return (item.offsetWidth * 3) + (gap * 3);
    };

    // Update Visibility of Arrows
    const updateArrows = () => {
        const scrollLeft = track.scrollLeft;
        const maxScroll  = track.scrollWidth - track.clientWidth;

        // Hide prev if we are at the start
        prevBtn.style.visibility = (scrollLeft <= 10) ? 'hidden' : 'visible';
        prevBtn.style.opacity    = (scrollLeft <= 10) ? '0' : '1';

        // Hide next if we are at the end
        nextBtn.style.visibility = (scrollLeft >= maxScroll - 10) ? 'hidden' : 'visible';
        nextBtn.style.opacity    = (scrollLeft >= maxScroll - 10) ? '0' : '1';
    };

    // SCROLLING LOGIC
    nextBtn.addEventListener('click', () => {
        track.scrollBy({ left: getSlideWidth(), behavior: 'smooth' });
    });

    prevBtn.addEventListener('click', () => {
        track.scrollBy({ left: -getSlideWidth(), behavior: 'smooth' });
    });

    // SCROLL LISTENER (Dots + Arrows)
    track.addEventListener('scroll', () => {
        const scrollPosition = track.scrollLeft;
        const width = track.offsetWidth;
        const index = Math.round(scrollPosition / width);

        // Update Dots
        dots.forEach((dot, idx) => {
            if (idx === index) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });

        updateArrows();
    });

    // DOTS INTERACTION
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            const scrollAmount = index * track.offsetWidth;
            track.scrollTo({ left: scrollAmount, behavior: 'smooth' });
        });
    });

    // Initial state check
    updateArrows();
});
