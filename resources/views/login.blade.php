<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - MediConnect</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body class="auth-page">
  <a href="{{ route('home') }}">
    <img
      src="./images/home.png"
      width="50px" alt="MediConnect" class="auth-bg-home">
  </a>
  <div class="auth-container">
    <div class="auth-box">
      <div class="logo">
        <i class="fas fa-heartbeat"></i>
        <h1>MediConnect</h1>
      </div>
      @if ($errors->any())
          <h3 style="color: red;">Email ou Password incorrect<br><br></h3>
      @else
          <h2>Bon Retour</h2>
          <p class="auth-subtitle">Veuillez vous connecter à votre compte</p>
      @endif
      <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <div class="form-group">
          <div class="input-group glass-effect">
            <i class="fas fa-user"></i>
            <input type="text" id="email" name="email" value="{{ old('email') }}"
              placeholder="Email ou Nom d'utilisateur" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group glass-effect">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
          </div>
        </div>
        <div class="form-options">
          <label class="remember-me">
            <input type="checkbox">
            <span>Se souvenir de moi</span>
          </label>
          <a href="#" class="forgot-password">Mot de passe oublié ?</a>
        </div>
        <button type="submit" class="auth-button">
          <span>Se Connecter</span>
          <i class="fas fa-arrow-right"></i>
        </button>
      </form>
      <div class="auth-links">
        <p>Nouveau sur MediConnect ? <a href="{{ route('register') }}" class="signup-link">Créer un compte</a></p>
      </div>
    </div>
  </div>
</body>

</html>
