<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord</title>
  <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/table.css') }}">
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
        <span class="username">{{ ucwords(strtolower($datauser['name'])) }}</span>
        <img alt="Profil" class="user-avatar" src="{{ $datauser['image'] }}">
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
        <li><a href="{{ route('user.meassagelist') }}" ><i class="fas fa-envelope"></i><span>Messages</span><span class="active-indicator"></span></a></li>
        <li><a class="active" href="{{ route('user.alldoctors') }}"><i class="fas fa-user-md"></i><span>Tous les médecins</span><span class="active-indicator"></span></a></li>
        <li><a href="{{ route('user.profile') }}"><i class="fas fa-user"></i><span>Paramètres du profil</span><span class="active-indicator"></span></a></li>
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
      <div class="dashboard-container">
        <div class="table-header">
          <h1>Contactez un docteur ( {{ count($allDoctors) }} )</h1>
          <form action="{{ route('user.alldoctors.search') }}" method="POST">
            @csrf
            <div class="table-actions">
              <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher des médecins..." id="search-doctor-input" name="searchvalue">
              </div>
              <button class="add-doctor-btn" id="search-doctor-btn">
                Rechercher
              </button>
            </div>
          </form>
        </div>

        <div class="table-container">
          <table class="doctors-table">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Image</th>
                <th>Spécialisation</th>
                <th>Statut</th>
                <th>Contact</th>
                <th>Heures de travail</th>
                <th>Patients</th>
                <th>Évaluation</th>
                <th>Expérience</th>
                <th>Certifications</th>
                <th>Numéro de téléphone</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allDoctors as $doctor)
              <tr>
                <td>
                  <div class="doctor-info">
                    <span>Dr. {{ $doctor->name }}</span>
                  </div>
                </td>
                <td><img alt="Profil" class="doctor-image" src="{{ $doctor->image }}"></td>
                <td>
                  <span class="specialization">
                    @if (strlen($doctor->specialization) > 15)
                    {{ substr($doctor->specialization, 0, 15) }}...
                    @else
                    {{ $doctor->specialization }}
                    @endif
                  </span>
                <td><span class="status active">Actif</span></td>
                <td>
                  <div class="action-buttons">
                    <a 
                      href="{{ route('user.meassangeroom', ['id' => $doctor->user_id]) }}"
                      style="text-decoration: none;"
                    class="action-btn edit">Envoyer un message</a>
                  </div>
                </td>
                <td>{{ rand(1, 12) }}:00 AM - {{ rand(1, 12) }}:00 PM</td>
                <td><span class="patient-count">{{ $doctor->number_of_patients }}</span></td>
                <td>
                  <div class="rating">
                    <span>{{ $doctor->rating }}</span>
                    <div class="stars">
                      @if ($doctor->rating - (int) $doctor->rating > 0)
                      @for ($i = 0; $i < (int) $doctor->rating; $i++)
                        <i class="fas fa-star"></i>
                        @endfor
                        <i class="fas fa-star-half-alt"></i>
                        @else
                        @for ($i = 0; $i < (int) $doctor->rating - 1; $i++)
                          <i class="fas fa-star"></i>
                          @endfor
                          <i class="fas fa-star-half-alt"></i>
                          @endif
                    </div>
                  </div>
                </td>
                <td>{{ $doctor->experience }} ans</td>
                <td>
                  <div class="certifications">
                    @foreach (explode('|', $doctor->certifications) as $cert)
                    <span class="cert-badge">{{ $cert }}</span>
                    @endforeach
                  </div>
                </td>
                <td>{{ $doctor->phone_number }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
  <script src="{{ asset('js/user/alldoctors.js') }}"></script>
</body>
</html>
