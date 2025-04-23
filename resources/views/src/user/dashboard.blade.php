<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
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
        <img alt="Profile" class="user-avatar" src="{{ $datauser['image'] }}">
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
        <li><a class="active" href="{{ route('dashboard') }}"><i class="fas fa-home"></i><span>Page d'accueil</span><span class="active-indicator"></span></a></li>
        <li><a href="{{ route('user.meassagelist') }}" ><i class="fas fa-envelope"></i><span>Messages</span><span class="active-indicator"></span></a></li>
        <li><a href="{{ route('user.alldoctors') }}"><i class="fas fa-user-md"></i><span>Tous les médecins</span><span class="active-indicator"></span></a></li>
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
      <section class="stats-cards">
        <div class="card">
          <div class="card-icon">
            <i class="fas fa-user-md"></i>
          </div>
          <div class="card-content">
            <h3>Nombre de médecins</h3>
            <p class="stat-number">{{ $doctorsCount[0] }}</p>
            <span class="trend-up"><i class="fas fa-arrow-up"></i> +{{ $doctorsCount[2] }}%</span>
          </div>
        </div>
        <div class="card">
          <div class="card-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-content">
            <h3>Nombre d'utilisateurs</h3>
            <p class="stat-number">{{ $doctorsCount[1] }}</p>
            <span class="trend-up"><i class="fas fa-arrow-up"></i> +{{ $doctorsCount[3] }}%</span>
          </div>
        </div>
        <div class="card">
          <div class="card-icon">
            <i class="fas fa-calendar-check"></i>
          </div>
          <div class="card-content">
            <h3>Rendez-vous</h3>
            <p class="stat-number">0</p>
            <span class="trend-up"><i class="fas fa-arrow-up"></i> +0.0%</span>
          </div>
        </div>
      </section>
      <section class="charts-section">
        <div class="chart-container">
          <h3>Activité des utilisateurs</h3>
          <div style="height: 300px;">
            <canvas id="userActivityChart"></canvas>
          </div>
        </div>
        <div class="chart-container">
          <h3>Distribution</h3>
          <div style="height: 300px;">
            <canvas id="appointmentsChart"></canvas>
          </div>
        </div>
      </section>
      <section class="top-section">
        <div class="section-header">
          <h3>Top Médecins</h3>
          <a href="{{ route('user.alldoctors') }}">
            <button class="view-more">Voir plus</button>
          </a>
        </div>
        <div class="top-cards">
          <div class="top-card">
            <img alt="Doctor" class="doctor-avatar" src="{{ $topDoctors[0]['image'] }}">
            <div class="doctor-info">
              <h4>Dr. {{ ucwords(strtolower($topDoctors[0]['name'])) }}</h4>
              <p>{{ ucwords(strtolower($topDoctors[0]['specialization'])) }}</p>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>{{ $topDoctors[0]['rating'] }}</span>
              </div>
            </div>
          </div>
          <div class="top-card">
            <img alt="Doctor" class="doctor-avatar" src="{{ $topDoctors[1]['image'] }}">
            <div class="doctor-info">
              <h4>Dr. {{ ucwords(strtolower($topDoctors[1]['name'])) }}</h4>
              <p>{{ ucwords(strtolower($topDoctors[1]['specialization'])) }}</p>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>{{ $topDoctors[1]['rating'] }}</span>
              </div>
            </div>
          </div>
          <div class="top-card">
            <img alt="Doctor" class="doctor-avatar" src="{{ $topDoctors[2]['image'] }}">
            <div class="doctor-info">
              <h4>Dr. {{ ucwords(strtolower($topDoctors[2]['name'])) }}</h4>
              <p>{{ ucwords(strtolower($topDoctors[2]['specialization'])) }}</p>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>{{ $topDoctors[2]['rating'] }}</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="notifications-panel">
        <div class="section-header">
          <h3>Notifications</h3>
          <span class="badge">3 nouvelles</span>
        </div>
        <div class="notification-list">
          <div class="notification-item">
            <i class="fas fa-bell"></i>
            <div class="notification-content">
              <p>Nouveau message du système</p>
              <span class="notification-time">Il y a 5 minutes</span>
            </div>
          </div>
          <div class="notification-item">
            <i class="fas fa-user-plus"></i>
            <div class="notification-content">
              <p>Nouveau médecin inscrit</p>
              <span class="notification-time">Il y a 2 heures</span>
            </div>
          </div>
          <div class="notification-item">
            <i class="fas fa-calendar-alt"></i>
            <div class="notification-content">
              <p>10 nouveaux rendez-vous aujourd'hui</p>
              <span class="notification-time">Il y a 4 heures</span>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
  <script>
    let MIDSINE_COUNT = {{ $doctorsCount[2] }};
    let USER_COUNT = {{ $doctorsCount[3] }};
  </script>
  <script src="{{ asset('js/user/dashboard.js') }}"></script>
</body>
</html>
