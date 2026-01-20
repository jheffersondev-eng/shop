/**
 * About Page - Portfolio Developer
 * Interatividade e Efeitos Dinâmicos
 */

document.addEventListener('DOMContentLoaded', function () {
    initAOS();
    initNavbar();
    initScrollAnimations();
    initFormHandling();
    initSmoothScroll();
    initInteractiveElements();
});

/**
 * Initialize AOS (Animate On Scroll)
 */
function initAOS() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    }
}

/**
 * Navbar scroll effect
 */
function initNavbar() {
    const navbar = document.querySelector('.navbar-about');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

/**
 * Scroll animations
 */
function initScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, {
        threshold: 0.1
    });

    // Observar elementos com animação
    document.querySelectorAll('[data-aos]').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Form handling
 */
function initFormHandling() {
    const form = document.getElementById('contactForm');

    if (form) {
        form.addEventListener('submit', function (e) {
            // Deixar o formulário fazer o submit normalmente
            const submitBtn = form.querySelector('.btn-submit');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Enviando...';
        });
    }
}

/**
 * Show success message
 */
function showSuccessMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x';
    alertDiv.style.zIndex = '9999';
    alertDiv.style.marginTop = '80px';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();

                const target = document.querySelector(href);
                const offsetTop = target.offsetTop - 80; // Considerar altura da navbar

                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Interactive elements
 */
function initInteractiveElements() {
    // Animar barras de progresso ao chegar na seção
    const skillSection = document.querySelector('.skills-section');

    if (skillSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !skillSection.classList.add('animated')) {
                    animateProgressBars();
                    skillSection.classList.add('animated');
                }
            });
        });

        observer.observe(skillSection);
    }

    // Interatividade das skill categories
    document.querySelectorAll('.skill-category').forEach((category, index) => {
        category.style.setProperty('--index', index);

        category.addEventListener('mouseenter', function () {
            document.querySelectorAll('.skill-category').forEach((cat, idx) => {
                if (idx !== index) {
                    cat.style.opacity = '0.7';
                }
            });
        });

        category.addEventListener('mouseleave', function () {
            document.querySelectorAll('.skill-category').forEach(cat => {
                cat.style.opacity = '1';
            });
        });
    });

    // Animar skill progress
    function animateProgressBars() {
        document.querySelectorAll('.skill-progress').forEach((bar, index) => {
            const width = bar.style.width;
            bar.style.width = '0';

            setTimeout(() => {
                bar.style.transition = `width 1.2s ease-out ${index * 0.1}s`;
                bar.style.width = width;
            }, 100);
        });
    }
}

/**
 * Parallax effect para hero section
 */
function initParallax() {
    const heroImage = document.querySelector('.profile-image');

    if (heroImage) {
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY;
            heroImage.style.transform = `translateY(${scrolled * 0.3}px)`;
        });
    }
}

/**
 * Contador animado para estatísticas
 */
function animateCounters() {
    const counters = document.querySelectorAll('.stat-number');

    const options = {
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                const target = entry.target;
                const finalValue = parseInt(target.textContent);
                const duration = 2000;
                const increment = finalValue / (duration / 50);
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= finalValue) {
                        target.textContent = finalValue + '+';
                        clearInterval(timer);
                        target.classList.add('counted');
                    } else {
                        target.textContent = Math.floor(current) + '+';
                    }
                }, 50);
            }
        });
    }, options);

    counters.forEach(counter => observer.observe(counter));
}

// Iniciar contadores quando a página carrega
window.addEventListener('load', animateCounters);

/**
 * Hover effect para job cards
 */
function initJobCardEffects() {
    const jobCards = document.querySelectorAll('.job-card');

    jobCards.forEach(card => {
        const image = card.querySelector('.job-image');

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            // Subtle background effect
            card.style.setProperty('--mouse-x', x + 'px');
            card.style.setProperty('--mouse-y', y + 'px');
        });
    });
}

window.addEventListener('load', initJobCardEffects);

/**
 * Efeito de scroll indicator
 */
function initScrollIndicator() {
    const indicator = document.querySelector('.scroll-indicator');

    if (indicator) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                indicator.style.opacity = '0';
                indicator.style.pointerEvents = 'none';
            } else {
                indicator.style.opacity = '1';
                indicator.style.pointerEvents = 'auto';
            }
        });
    }
}

initScrollIndicator();

/**
 * Adicionar classe de hover para links sociais
 */
function initSocialLinks() {
    const socialBtns = document.querySelectorAll('.social-btn');

    socialBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function () {
            this.style.animation = '';
        });
    });
}

initSocialLinks();

/**
 * Lazy load images
 */
function initLazyLoad() {
    if ('IntersectionObserver' in window) {
        const images = document.querySelectorAll('img[loading="lazy"]');

        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.src; // Forçar carregamento
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }
}

initLazyLoad();

/**
 * Smooth fade in on page load
 */
window.addEventListener('load', () => {
    document.body.style.opacity = '1';
});


// Back to Top Button Logic
const backToTopBtn = document.getElementById('backToTop');
const aboutSection = document.getElementById('about');

// Intersection Observer para mostrar botão quando chegar na seção "Minha História"
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            backToTopBtn.classList.add('show');
        } else if (entry.boundingClientRect.top > 0) {
            backToTopBtn.classList.remove('show');
        }
    });
}, {
    threshold: 0.1
});

if (aboutSection) {
    observer.observe(aboutSection);
}

// Scroll suave para o topo
backToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var contactSection = document.getElementById('contact');
    if (contactSection) {
        contactSection.scrollIntoView({ behavior: 'smooth' });
    }
});