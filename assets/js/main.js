// assets/js/main.js
document.addEventListener('DOMContentLoaded', function() {
    // Animation douce pour les apparitions (Scroll Reveal)
    const reveals = document.querySelectorAll('.reveal, .fade-in');
    
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                if(entry.target.classList.contains('fade-in')) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
                observer.unobserve(entry.target); // Animate once
            }
        });
    }, { threshold: 0.15, rootMargin: "0px 0px -50px 0px" });

    reveals.forEach(el => {
        if(el.classList.contains('fade-in')) {
            el.style.opacity = 0;
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        }
        observer.observe(el);
    });
});

// Imprimer la facture
function printInvoice() {
    window.print();
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(amount);
}
