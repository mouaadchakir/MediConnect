<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MediConnect - Connexion entre Patients et Médecins</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('src/1.css') }}">
  <link rel="stylesheet" href="{{ asset('src/2.css') }}">
  <link rel="stylesheet" href="{{ asset('src/3.css') }}">
</head>

<body>
  <header>
    <nav>
      <div class="logo">
        <h1>MediConnect</h1>
      </div>
      <ul class="nav-links">
        <li><a href="#home" class="active">Accueil</a></li>
        <li><a href="#about">À Propos</a></li>
        <li><a href="#features">Fonctionnalités</a></li>
        <li><a href="#contact">Contact</a></li>
        @guest
          <li><a href="{{ route('login') }}">Connexion</a></li>
          <li><a href="{{ route('register') }}" class="login-btn"><i class="fas fa-user"></i> S'inscrire</a></li>
        @endguest
        @auth
          <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
          <li><a href="{{ route('logout') }}" class="login-btn"><i class="fas fa-user"></i> Déconnexion</a></li>
        @endauth
      </ul>
      <button class="mobile-menu-btn">
        <i class="fas fa-bars"></i>
      </button>
    </nav>
  </header>
  <section id="home" class="hero-slider">
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="slide-image"
            style="background-image: url('./images/1.webp')">
          </div>
          <div class="slide-content">
            <h2 data-aos="fade-up" data-aos-delay="200">Bienvenue sur MediConnect</h2>
            <p data-aos="fade-up" data-aos-delay="400">Votre plateforme de confiance pour des connexions de santé
              transparentes</p>
            <button class="cta-button" data-aos="fade-up" data-aos-delay="600">Commencer Maintenant</button>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="slide-image"
            style="background-image: url('./images/3.webp')">
          </div>
          <div class="slide-content">
            <h2>Soins Experts à Portée de Main</h2>
            <p>Connectez-vous avec des professionnels de santé à tout moment</p>
            <button class="cta-button" data-aos="fade-up" data-aos-delay="600">Commencer Maintenant</button>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="slide-image"
            style="background-image: url('./images/2.webp')">
          </div>
          <div class="slide-content">
            <h2>Solutions de Santé Modernes</h2>
            <p>Découvrez l'avenir des consultations médicales</p>
            <button class="cta-button" data-aos="fade-up" data-aos-delay="600">Commencer Maintenant</button>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
    <div class="hero-wave">
      <img
        src="./images/4.svg"
        alt="wave">
    </div>
  </section>
  <main>
    <section id="about" class="about">
      <div class="container">
        <h2 class="section-title" data-aos="fade-up">À Propos de MediConnect</h2>
        <div class="about-content">
          <div class="about-text" data-aos="fade-right">
            <p>MediConnect révolutionne les soins de santé en comblant le fossé entre les patients et les prestataires
              de soins. Notre plateforme offre un moyen simple, sécurisé et efficace de se connecter avec des
              professionnels de santé depuis chez vous.</p>
            <p>Nous comprenons que votre temps et votre santé sont précieux. C'est pourquoi nous avons créé une
              plateforme qui élimine les temps d'attente inutiles et rend les soins de santé accessibles à tous,
              partout, à tout moment.</p>
          </div>
          <div class="about-stats" data-aos="fade-left">
            <div class="stat-item">
              <span class="stat-number" data-count="1000">0</span>
              <span class="stat-label">Médecins</span>
            </div>
            <div class="stat-item">
              <span class="stat-number" data-count="5000">0</span>
              <span class="stat-label">Patients</span>
            </div>
            <div class="stat-item">
              <span class="stat-number" data-count="24">0</span>
              <span class="stat-label">Support 24h/24</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="features" class="features">
      <div class="container">
        <h2 class="section-title" data-aos="fade-up">Pourquoi Choisir MediConnect ?</h2>
        <div class="features-grid">
          <div class="feature-card" data-aos="zoom-in" data-aos-delay="100">
            <div class="feature-icon">
              <i class="fas fa-laptop-medical"></i>
            </div>
            <h3>Accès Facile</h3>
            <p>Connectez-vous instantanément avec des professionnels de santé via notre plateforme sécurisée. Plus
              d'attente dans les files d'attente ou de conflits d'horaires.</p>
          </div>
          <div class="feature-card" data-aos="zoom-in" data-aos-delay="200">
            <div class="feature-icon">
              <i class="fas fa-user-shield"></i>
            </div>
            <h3>Communication Confidentielle</h3>
            <p>Votre confidentialité et la sécurité de vos données sont nos priorités. Toutes les communications sont
              cryptées et protégées.</p>
          </div>
          <div class="feature-card" data-aos="zoom-in" data-aos-delay="300">
            <div class="feature-icon">
              <i class="fas fa-clock"></i>
            </div>
            <h3>Réponses Rapides</h3>
            <p>Obtenez rapidement des conseils médicaux quand vous en avez le plus besoin. Nos médecins répondent
              généralement en quelques heures.</p>
          </div>
          <div class="feature-card" data-aos="zoom-in" data-aos-delay="400">
            <div class="feature-icon">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <h3>Interface Conviviale</h3>
            <p>Notre plateforme intuitive facilite la gestion des rendez-vous et des communications pour les patients
              comme pour les médecins.</p>
          </div>
        </div>
      </div>
    </section>
    <section id="testimonials" class="testimonials">
      <div class="container">
        <h2 class="section-title" data-aos="fade-up">Ce Que Disent Nos Utilisateurs</h2>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="testimonial-card">
                <div class="testimonial-content">
                  <i class="fas fa-quote-left"></i>
                  <p>"MediConnect a transformé ma façon de gérer ma santé. La plateforme est intuitive et je peux
                    facilement contacter mon médecin quand j'en ai besoin."</p>
                </div>
                <div class="testimonial-author">
                  <img src="./images/5.jpg" alt="Karima Safi">
                  <div class="author-info">
                    <span class="name">Karima Safi</span>
                    <span class="role">Patiente</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-card">
                <div class="testimonial-content">
                  <i class="fas fa-quote-left"></i>
                  <p>"En tant que médecin, cette plateforme m'a aidé à fournir de meilleurs soins à mes patients. Les
                    outils de communication sont excellents."</p>
                </div>
                <div class="testimonial-author">
                  <img src="./images/6.jpg" alt="Dr. Mohammad Ali">
                  <div class="author-info">
                    <span class="name">Dr. Mohammad Ali</span>
                    <span class="role">Cardiologue</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>
    <section id="contact" class="contact">
      <div class="container">
        <h2 class="section-title" data-aos="fade-up">Contactez-nous</h2>
        <div class="contact-content">
          <div class="contact-info" data-aos="fade-right">
            <div class="contact-item">
              <i class="fas fa-phone"></i>
              <p>+1 (555) 123-4567</p>
            </div>
            <div class="contact-item">
              <i class="fas fa-envelope"></i>
              <p>support@mediconnect.com</p>
            </div>
            <div class="contact-item">
              <i class="fas fa-map-marker-alt"></i>
              <p>123 Rue de la Santé, Quartier Médical, Paris 75001</p>
            </div>
          </div>
          <form class="contact-form" data-aos="fade-left">
            <input type="text" placeholder="Votre Nom" required>
            <input type="email" placeholder="Votre Email" required>
            <textarea placeholder="Votre Message" required></textarea>
            <button type="submit" class="submit-btn">Envoyer le Message</button>
          </form>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h5>Liens Rapides</h5>
        <ul>
          <li><a href="#home">Accueil</a></li>
          <li><a href="#about">À Propos</a></li>
          <li><a href="#features">Fonctionnalités</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h5>Connect With Us</h5>
        <div class="social-links">
          <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="footer-section">
        <h5>Legal</h5>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Cookie Policy</a></li>
          <li><a href="#">HIPAA Compliance</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h5>Newsletter</h5>
        <p>Stay updated with our latest news and updates</p>
        <form class="newsletter-form">
          <input type="email" placeholder="Enter your email" required>
          <button type="submit">Subscribe</button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 MediConnect. Tous droits réservés.</p>
    </div>
  </footer>
  <script src="{{ asset('src/4.js') }}"></script>
  <script src="{{ asset('src/5.js') }}"></script>
  <script src="{{ asset('src/6.js') }}"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
  @if (session('message'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "You are now logged in",
        showConfirmButton: false,
        timer: 5000
      });
    </script>
  @endif
</body>

</html>
