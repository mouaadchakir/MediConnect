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
        <li><a href="{{ route('doctor.meassagelist') }}"><i class="fas fa-envelope"></i><span>Messages</span><span class="active-indicator"></span></a></li>
        <li><a href="{{ route('doctor.profile') }}"><i class="fas fa-user"></i><span>Paramètres du profil</span><span class="active-indicator"></span></a></li>
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
      <section class="stats-cards">
        <div class="card">
          <div class="card-icon">
            <i class="fas fa-user"></i>
          </div>
          <div class="card-content">
            <h3>Votre nombre de patients</h3>
            <p class="stat-number">0</p>
            <span class="trend-up"><i class="fas fa-arrow-up"></i> +0.0%</span>
          </div>
        </div>
        <div class="card">
          <div class="card-icon">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="card-content">
            <h3>Votre message</h3>
            <p class="stat-number">0</p>
            <span class="trend-up"><i class="fas fa-arrow-up"></i> +0.0%</span>
          </div>
        </div>
        <div class="card">
          <div class="card-icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <div class="card-content">
            <h3>Date de rendez-vous</h3>
            <p class="stat-number">{{ date('d-m-Y', strtotime($datauser['created_at'])) }}</p>
            <span class="trend-up"><i class="fas fa-arrow-up"></i> +{{ date('Y') - date('Y', strtotime($datauser['created_at'])) }} ans</span>
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
    </main>
  </div>
  <script>
    let MIDSINE_COUNT = {
      {
        $doctorsCount[2]
      }
    };
    let USER_COUNT = {
      {
        $doctorsCount[3]
      }
    };

  </script>
  <script src="{{ asset('js/user/dashboard.js') }}"></script>
</body>
</html>
