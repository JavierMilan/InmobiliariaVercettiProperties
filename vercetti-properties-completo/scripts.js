const cabecera = document.querySelector('.cabecera');
const logo = document.querySelector('.cabecera .logo img');

window.addEventListener('scroll', () => {
    if (window.scrollY > 80) {
        cabecera.classList.add('cabecera--scrolled');
    } else {
        cabecera.classList.remove('cabecera--scrolled');
    }
});

logo.addEventListener('click', () => {
    if (cabecera.classList.contains('cabecera--scrolled')) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});

/* cambio imagen formulario */
const bgImages = [
    'imagenes/habitacionInterior.png',
    'imagenes/fondoResultado.png',
    'imagenes/piscina.png',
    'imagenes/balcon.png'
];

const sliderA = document.getElementById('slider-a');
const sliderB = document.getElementById('slider-b');

if (sliderA && sliderB) {
    let bgIndex = 0;
    let activeSlider = sliderA;
    let inactiveSlider = sliderB;

    sliderA.style.backgroundImage = `url('${bgImages[0]}')`;

    setInterval(() => {
        bgIndex = (bgIndex + 1) % bgImages.length;
        inactiveSlider.style.backgroundImage = `url('${bgImages[bgIndex]}')`;
        inactiveSlider.style.opacity = '1';
        activeSlider.style.opacity = '0';
        [activeSlider, inactiveSlider] = [inactiveSlider, activeSlider];
    }, 10000);
}

// Menú hamburguesa
const hamburger = document.querySelector('.hamburger');
const menu = document.querySelector('.cabeceraBotones');

if (hamburger && menu) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        menu.classList.toggle('menu-open');
    });

    // Cerrar al pulsar un enlace
    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('active');
            menu.classList.remove('menu-open');
        });
    });
}