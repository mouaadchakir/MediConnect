AOS.init({
  duration: 800,
  easing: 'ease-in-out',
  once: true,
  mirror: false
});
const heroSwiper = new Swiper('.hero-slider .swiper', {
  effect: 'fade',
  loop: true,
  speed: 1000,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
const testimonialSwiper = new Swiper('.testimonials-slider', {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
    },
  },
});
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');
mobileMenuBtn.addEventListener('click', () => {
  navLinks.classList.toggle('active');
  mobileMenuBtn.querySelector('i').classList.toggle('fa-bars');
  mobileMenuBtn.querySelector('i').classList.toggle('fa-times');
});
const header = document.querySelector('header');
const scrollThreshold = 100;
window.addEventListener('scroll', () => {
  if (window.scrollY > scrollThreshold) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
      navLinks.classList.remove('active');
      mobileMenuBtn.querySelector('i').classList.remove('fa-times');
      mobileMenuBtn.querySelector('i').classList.add('fa-bars');
    }
  });
});
const sections = document.querySelectorAll('section[id]');
function highlightNavLink() {
  const scrollY = window.scrollY;
  sections.forEach(section => {
    const sectionHeight = section.offsetHeight;
    const sectionTop = section.offsetTop - 100;
    const sectionId = section.getAttribute('id');
    const navLink = document.querySelector(`.nav-links a[href="#${sectionId}"]`);
    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
      navLink?.classList.add('active');
    } else {
      navLink?.classList.remove('active');
    }
  });
}
window.addEventListener('scroll', highlightNavLink);
function animateCounter(element) {
  const target = parseInt(element.getAttribute('data-count'));
  const duration = 2000;
  const step = target / (duration / 16);
  let current = 0;
  const timer = setInterval(() => {
    current += step;
    if (current >= target) {
      element.textContent = target;
      clearInterval(timer);
    } else {
      element.textContent = Math.floor(current);
    }
  }, 16);
}
const statsSection = document.querySelector('.about-stats');
let animated = false;
const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting && !animated) {
      document.querySelectorAll('.stat-number').forEach(counter => {
        animateCounter(counter);
      });
      animated = true;
    }
  });
}, { threshold: 0.5 });
statsObserver.observe(statsSection);
const contactForm = document.querySelector('.contact-form');
const newsletterForm = document.querySelector('.newsletter-form');
function handleFormSubmit(e, formType) {
  e.preventDefault();
  const formData = new FormData(e.target);
  const data = Object.fromEntries(formData.entries());
  console.log(`${formType} form submitted:`, data);
  const button = e.target.querySelector('button');
  const originalText = button.textContent;
  button.textContent = 'Success!';
  button.style.backgroundColor = '#48bb78';
  setTimeout(() => {
    button.textContent = originalText;
    button.style.backgroundColor = '';
    e.target.reset();
  }, 2000);
}
contactForm?.addEventListener('submit', (e) => handleFormSubmit(e, 'Contact'));
newsletterForm?.addEventListener('submit', (e) => handleFormSubmit(e, 'Newsletter'));