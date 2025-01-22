<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord</title>
  <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/messagelist.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/date-fns@latest"></script>
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
        <li><a class="active" href="{{ route('doctor.meassagelist') }}"><i class="fas fa-envelope"></i><span>Messages</span><span class="active-indicator"></span></a></li>
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
      <div class="profile-container">
        <div class="message-list" id="messageListDatas">
        </div>
      </div>
    </main>

  </div>
  <script>
    setTimeout(() => {
      window.location.reload();
    }, 10000);
    let datamessage = @json($datamessage);
    let curenturl = "{{ route('doctor.meassangeroom', ['id' => 9999]) }}";

  </script>
  <script src="{{ asset('js/user/message.js') }}"></script>
</body>

</html>
