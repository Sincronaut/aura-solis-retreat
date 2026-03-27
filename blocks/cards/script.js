document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('cards-track');
    const prevBtn = document.getElementById('carousel-prev');
    const nextBtn = document.getElementById('carousel-next');
    const dots    = document.querySelectorAll('.carousel-dots .dot');

    if (!track) return;

    // Helper to calculate widths
    const getItemWidth = () => {
        const item = track.querySelector('.card-item');
        if (!item) return 0;
        const style = window.getComputedStyle(track);
        const gap = parseInt(style.getPropertyValue('gap')) || 0;
        return item.offsetWidth + gap;
    };

    const getJumpWidth = () => {
        const itemWidth = getItemWidth();
        // Desktop: slide 3 cards if possible, otherwise slide 1
        const itemsPerView = window.innerWidth >= 992 ? 3 : 1;
        return itemWidth * itemsPerView;
    };

    // Update Visibility of Arrows
    const updateArrows = () => {
        if (!prevBtn || !nextBtn) return;
        const scrollLeft = track.scrollLeft;
        const maxScroll  = track.scrollWidth - track.clientWidth;

        prevBtn.style.visibility = (scrollLeft <= 10) ? 'hidden' : 'visible';
        prevBtn.style.opacity    = (scrollLeft <= 10) ? '0' : '1';

        nextBtn.style.visibility = (scrollLeft >= maxScroll - 10) ? 'hidden' : 'visible';
        nextBtn.style.opacity    = (scrollLeft >= maxScroll - 10) ? '0' : '1';
    };

    // SCROLLING LOGIC
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            track.scrollBy({ left: getJumpWidth(), behavior: 'smooth' });
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            track.scrollBy({ left: -getJumpWidth(), behavior: 'smooth' });
        });
    }

    // SCROLL LISTENER (Dots + Arrows)
    track.addEventListener('scroll', () => {
        const scrollPosition = track.scrollLeft;
        const itemWidth = getItemWidth();
        let index = Math.round(scrollPosition / itemWidth);

        // Normalize index for desktop to highlight grouped dots correctly
        if (window.innerWidth >= 992) {
            index = Math.floor(index / 3) * 3;
        }

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
            const itemWidth = getItemWidth();
            const scrollAmount = index * itemWidth;
            track.scrollTo({ left: scrollAmount, behavior: 'smooth' });
        });
    });

    // Initial state check
    updateArrows();
});
