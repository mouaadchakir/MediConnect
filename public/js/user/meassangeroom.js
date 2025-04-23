document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('messageInput').focus();
  const messagesContainer = document.getElementById('messagesContainer');
  const sampleMessages = JSON.parse(meassangeroomall)['messages'];
  function scrollToBottom() { messagesContainer.scrollTop = messagesContainer.scrollHeight; }
  function createMessageFromNow(All_messages) {
    let new_html_content = '';
    All_messages.forEach((msg, _) => {
      new_html_content += `
              <div class="message ${msg.type}">
                  <div class="message-content">
                      ${msg.text}
                      <span style="padding: 0 0 0 8px;" class="timestamp">${msg.time.split(' ')[1].split('.')[0].slice(0, 5)}</span>
                  </div>
              </div>
          `;
    });
    messagesContainer.innerHTML = new_html_content;
    scrollToBottom();
    console.log('createMessageFromNow');
  }
  createMessageFromNow(JSON.parse(meassangeroomall)['messages']);
  function clearAllMessages() { messagesContainer.innerHTML = ''; }
  const FetcheMessages = async () => {
    let id_from = JSON.parse(meassangeroomall)['id_user'];
    let id_to = JSON.parse(meassangeroomall)['id_doctor'];
    let url = GlobalUrl + '/api/allmesagges/' + id_from + '/' + id_to;
    let response = await axios.get(url);
    let data = response.data.messages;
    createMessageFromNow(data);
    console.log('FetcheMessages');
  };
  setInterval(FetcheMessages, 10000);
  const SendMessageToServer = async () => {
    let id_from = JSON.parse(meassangeroomall)['id_user'];
    let id_to = JSON.parse(meassangeroomall)['id_doctor'];
    let message = document.getElementById('messageInput').value;
    if (message === '') return;
    let url = GlobalUrl + '/api/sendmessage';
    let data = { id_from, id_to, message };
    let response = await axios.post(url, data);
    FetcheMessages();
    document.getElementById('messageInput').value = '';
    document.getElementById('messageInput').focus();
    console.log(response);
  };
  document.getElementById('sendButton').addEventListener('click', SendMessageToServer);
});

