<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - MediConnect</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body class="auth-page signup-page">
  <a href="{{ route('home') }}">
    <img src="./images/home.png" width="50px" alt="MediConnect" class="auth-bg-home">
  </a>
  <div class="auth-container">
    <div class="auth-box">
      <div class="logo">
        <i class="fas fa-heartbeat"></i>
        <h1>MediConnect</h1>
      </div>
      <h2>Créer un compte</h2>
      <p class="auth-subtitle">Rejoignez notre communauté de soins de santé</p>
      <form class="auth-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
          <div class="input-group glass-effect">
            <i class="fas fa-user"></i>
            <input type="text" id="fullname" name="fullname" placeholder="Nom complet" required>
          </div>
        </div>
        @error('fullname') <div style="color: red; font-size: 12px; margin-bottom: 10px;">{{ $message }}</div> @enderror
        <div class="form-group">
          <div class="input-group glass-effect">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Adresse e-mail" required>
          </div>
        </div>
        @error('email') <div style="color: red; font-size: 12px; margin-bottom: 10px;">{{ $message }}</div> @enderror
        <div class="form-group">
          <div class="input-group glass-effect">
            <i class="fas fa-user-md"></i>
            <select name="role" id="role" required>
              <option selected disabled>Sélectionner la permission</option>
              <option value="doctor">Médecin</option>
              <option value="user">Utilisateur</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group glass-effect">
            <i class="fas fa-venus-mars"></i>
            <select name="sex" id="role" required>
              <option selected disabled value="">Sélectionner le sexe</option>
              <option value="male">Homme</option>
              <option value="female">Femme</option>
            </select>
          </div>
        </div>
        @error('role') <div style="color: red; font-size: 12px; margin-bottom: 10px;">{{ $message }}</div> @enderror
        <div class="form-group">
          <div class="input-group glass-effect">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Créer un mot de passe" required>
          </div>
        </div>
        @error('password') <div style="color: red; font-size: 12px; margin-bottom: 10px;">{{ $message }}</div> @enderror
        <div class="form-group">
          <div class="input-group glass-effect">
            <i class="fas fa-shield-alt"></i>
            <input type="password" id="confirm-password" placeholder="Confirmer le mot de passe" name="cpassword" required>
          </div>
        </div>
        @error('confirm-password') <div style="color: red; font-size: 12px; margin-bottom: 10px;">{{ $message }}</div> @enderror
        <div class="form-options">
          <label class="terms-check">
            <input type="checkbox" required>
            <span>J'accepte les <a href="#">Conditions</a> et la <a href="#">Politique de confidentialité</a></span>
          </label>
        </div>
        <button type="submit" class="auth-button">
          <span>Créer un compte</span>
          <i class="fas fa-arrow-right"></i>
        </button>
      </form>
      <div class="auth-links">
        <p>Vous avez déjà un compte? <a href="{{ route('login') }}" class="login-link">Se connecter</a></p>
      </div>
    </div>
  </div>
</body>

</html>
