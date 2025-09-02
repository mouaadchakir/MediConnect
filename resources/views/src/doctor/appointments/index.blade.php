<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes Rendez-vous</title>
  <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/appointments.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        <li><a href="{{ route('doctor.meassagelist') }}"><i class="fas fa-envelope"></i><span>Messages</span><span class="active-indicator"></span></a></li>
        <li><a class="active" href="{{ route('doctor.appointments.index') }}"><i class="fas fa-calendar-check"></i><span>Mes rendez-vous</span><span class="active-indicator"></span></a></li>
        <li><a href="{{ route('doctor.profile') }}"><i class="fas fa-user"></i><span>Paramètres du profil</span><span class="active-indicator"></span></a></li>
      </ul>
      <div class="nav-footer">
        <span class="current-time" id="currentTime">(Médecin)</span>
      </div>
    </nav>

    <main class="main-content">
      <div class="table-header">
        <h1>Mes Rendez-vous ({{ count($appointments) }})</h1>
      </div>
      <div class="table-container">
        <table class="doctors-table">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Date du RDV</th>
              <th>Raison</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($appointments as $appointment)
              <tr>
                <td>
                  <div class="doctor-info">
                    <img src="{{ $appointment->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($appointment->user->name) . '&background=random' }}" alt="Patient" class="doctor-image">
                    <span>{{ $appointment->user->name }}</span>
                  </div>
                </td>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}</td>
                <td>{{ Str::limit($appointment->reason, 30) }}</td>
                <td><span class="status {{ strtolower($appointment->status) }}">{{ $appointment->status }}</span></td>
                <td class="action-buttons">
                  <a href="#" class="action-btn edit">Confirmer</a>
                  <a href="#" class="action-btn book">Annuler</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="empty-state">Aucun rendez-vous pour le moment.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>