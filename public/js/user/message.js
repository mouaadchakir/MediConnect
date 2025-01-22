const modelcartmessage = (image, name, date, message, coundtmessages, status, id_) => {
  let __id__ = curenturl.toString().replace("9999", id_);
  return `
    <div class="message-item ${status === "unread" ? "" : "read-dega"}">
      <div class="message-header">
        <div class="sender-info">
          <img src="${image}" alt="Dr" class="sender-avatar">
          <span class="message-sender">Dr. ${name}</span>
        </div>
        <span class="message-date">${date}</span>
      </div>
      <div class="message-body">
        <p>
          <strong>Message: </strong> 
          ${message}
        </p>
      </div>
      <div class="message-footer">
        <span class="message-number">N° ${coundtmessages}</span>
        <a href="${__id__}"
         class="message-action">
          <i class="fas fa-eye"></i> Voir le message
        </a>
      </div>
    </div>
  `
}
const convertDate = (date) => dateFns.formatDistanceToNow(new Date(date.toString().split('.')[0].replace(' ', 'T').concat('Z')), { addSuffix: true });
document.addEventListener("DOMContentLoaded", () => {
  let includ_app = document.getElementById("messageListDatas");
  JSON.parse(datamessage).unread.forEach((element) => {
    includ_app.innerHTML += modelcartmessage(element.image, element.name, convertDate(element.date), element.message, element.coundtmessages, element.status, element.id);
  });
  JSON.parse(datamessage).read.forEach((element) => {
    includ_app.innerHTML += modelcartmessage(element.image, element.name, convertDate(element.date), element.message, element.coundtmessages, element.status, element.id);
  });
});