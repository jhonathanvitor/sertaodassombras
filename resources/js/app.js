// Initialize scroll reveal animations & Lucide icons
function initSertaoAnimations() {
    if (window.lucide) {
        window.lucide.createIcons();
    }

    const io = new IntersectionObserver(
        (entries) =>
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    e.target.classList.add('in');
                    io.unobserve(e.target);
                }
            }),
        { threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
    );

    document.querySelectorAll('.reveal:not(.in)').forEach((el) => io.observe(el));
}

document.addEventListener('DOMContentLoaded', initSertaoAnimations);
document.addEventListener('livewire:navigated', initSertaoAnimations);
document.addEventListener('livewire:init', () => {
    Livewire.hook('morph.updated', () => {
        initSertaoAnimations();
    });
});
