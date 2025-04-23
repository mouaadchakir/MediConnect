<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern Chat Application</title>
  <link rel="stylesheet" href="{{ asset('css/user/meassangeroom.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="chat-container">
    <div class="chat-header">
      <div class="user-info">
        <div class="avatar">
          <img src="{{ $datadoctor['image'] }}" alt="User Image">
        </div>
        <div class="user-details">
          <h1>{{ ucwords(strtolower($datadoctor['name'])) }} <span style="font-size: 14px;color: #aaa;">(Utilisateur)</span></h1>
          <span class="status">
            <div style="width: 10px;height: 10px;border-radius: 50%;background-color: #2ed573;display: inline-block;"
            ></div> Online
          </span>
        </div>
      </div>
      <div class="header-actions">
        <a href="{{ route('doctor.meassagelist') }}" 
         class="action-btn"><i class="fas fa-arrow-left"></i></a>
      </div>
    </div>
    <div class="messages-container" id="messagesContainer">
    </div>
    <div class="input-container">
      <div class="input-wrapper">
        <input type="text" id="messageInput" placeholder="Type your message...">
      </div>
      <button id="sendButton">
        <i class="fas fa-paper-plane"></i>
      </button>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    let meassangeroomall = @json($datamessage);
    let GlobalUrl = "{{ url('/') }}";
  </script>
  <script src="{{ asset('js/doc/meassangeroom.js') }}"></script>
</body>
</html>
