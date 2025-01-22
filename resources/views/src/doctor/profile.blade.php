<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord</title>
  <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/user_profil.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <header class="header">
    <div class="header-content">
      <a class="home-link" href="{{ route('home') }}">
        <i class="fas fa-chevron-left"></i>
        <span>Retour à la page d'accueil</span>
      </a>
      <div class="user-info">
        <span class="username">{{ ucwords(strtolower($datadoctor['name'])) }}</span>
        <img alt="Profil" class="user-avatar" src="{{ $datadoctor['image'] }}">
        <a class="logout-btn" href="{{ route('logout') }}" style="text-decoration: none;">
          <span class="logout-icon">
            <i class="fas fa-sign-out-alt"></i>
          </span>
          <span class="logout-text">Déconnexion</span>
        </a>
      </div>
    </div>
  </header>

  <div class="container">
    <nav class="nav">
      <ul class="nav-menu">

        <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i><span>Page d'accueil</span><span class="active-indicator"></span></a></li>
        <li><a href="{{ route('doctor.meassagelist') }}"><i class="fas fa-envelope"></i><span>Messages</span><span class="active-indicator"></span></a></li>
        <li><a class="active" href="{{ route('doctor.profile') }}"><i class="fas fa-user"></i><span>Paramètres du profil</span><span class="active-indicator"></span></a></li>

      </ul>
      <div class="nav-footer">
        <span class="current-time" id="currentTime">(
          @if (Auth::user()->role == 'doctor') 
            Médecin 
          @elseif (Auth::user()->role == 'user') 
            Utilisateur
          @elseif (Auth::user()->role == 'admin')
            Administrateur
          @elseif (Auth::user()->role == 'supervisor')
            Superviseur
          @endif
        )</span>
      </div>
    </nav>
    <main class="main-content">
      <div class="profile-container">
        @if (isset($success))
        <div class="alert success-alert" role="alert">
          {{ $success }}
        </div>
        @endif

        @if (isset($error))
        <div class="alert danger-alert" role="alert">
          {{ $error }}
        </div>
        @endif

        <div class="profile-card">
          <div class="profile-header">
            <h1>Mon Profil</h1>
            <p>Gérez vos informations personnelles</p>
          </div>

          <form id="profileForm" action="{{ route('doctor.profile.update') }}" method="POST">
            @csrf
            <div class="profile-avatar">
              <div class="avatar-wrapper">
                <img id="userAvatar" src="{{ $datadoctor['image'] }}" alt="Profil">
              </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert" style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: 15px;">
                    <strong>Erreurs:</strong>
                    <ul style="padding-left: 20px;">
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-section">
              <div class="input-group">
                <label for="fullName">
                  <i class="fas fa-user"></i>
                  Nom Complet
                </label>
                <input type="text" id="name" name="name" placeholder="Entrez votre nom complet" value="{{ ucwords(strtolower($datadoctor['name'])) }}">
              </div>
              <div class="input-group">
                <label for="email">
                  <i class="fas fa-envelope"></i>
                  Adresse Email
                </label>
                <input type="email" id="email" placeholder="Entrez votre email" value="{{ $datadoctor['email'] }}" readonly style="background-color: #f5f5f5;">
              </div>
              <div class="input-group">
                <label for="specialization">
                  <i class="fas fa-user-md"></i>
                  Spécialisation
                </label>
                <input type="text" id="specialization" name="specialization" placeholder="Entrez votre spécialisation" value="{{ $datadoctor['specialization'] }}">
              </div>
              <div class="input-group">
                <label for="license_number">
                  <i class="fas fa-id-card"></i>
                  Numéro de Licence
                </label>
                <input type="text" id="license_number" name="license_number" placeholder="Entrez votre numéro de licence" value="{{ $datadoctor['license_number'] }}">
              </div>
              <div class="input-group">
                <label for="working_hours">
                  <i class="fas fa-clock"></i>
                  Heures de travail
                </label>
                <input type="text" id="working_hours" name="working_hours" placeholder="Entrez vos heures de travail" value="{{ $datadoctor['working_hours'] }}">
              </div>
              <div class="input-group">
                <label for="experience">
                  <i class="fas fa-user-md"></i>
                  Expérience
                </label>
                <input type="text" id="experience" name="experience" placeholder="Entrez votre expérience" value="{{ $datadoctor['experience'] }}">
              </div>
              <div class="input-group">
                <label for="certifications">
                  <i class="fas fa-user-md"></i>
                  Certifications
                </label>
                <input type="text" id="certifications" name="certifications" placeholder="Entrez vos certifications" value="{{ $datadoctor['certifications'] }}">
              </div>
              <div class="input-group">
                <label for="phone">
                  <i class="fas fa-phone"></i>
                  Numéro de Téléphone
                </label>
                <input type="tel" id="phone" name="phone_number" placeholder="Entrez votre numéro de téléphone" value="{{ $datadoctor['phone_number'] }}">
              </div>

              <div class="input-group">
                <label for="address">
                  <i class="fas fa-location-dot"></i>
                  Adresse
                </label>
                <textarea id="address" name="address" placeholder="Entrez votre adresse" rows="3">{{ $datadoctor['address'] }} </textarea>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="save-button">
                <i class="fas fa-save"></i>
                Enregistrer les modifications
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</body>

</html>
