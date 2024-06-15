const viewChatBtn = document.querySelector("#view-modal-chat");
const chatPopup = document.querySelector("#chats-popup");
const chatClose = document.querySelector("#chats-close");

function openChat() {
  console.log("Chat - abierto");
  viewChatBtn.addEventListener("click", () => {
    chatPopup.classList.add("show");
  });
}

function closeChat() {
  console.log("Chat - cerrado");
  chatClose.addEventListener("click", () => {
    chatPopup.classList.remove("show");
  });
}

openChat();
closeChat();

// inputField.focus();
// inputField.onkeyup = () => {
//   if (inputField.value != "") {
//     sendBtn.classList.add("active");
//   } else {
//     sendBtn.classList.remove("active");
//   }
// };

// sendBtn.onclick = () => {
//   let xhr = new XMLHttpRequest();
//   xhr.open("POST", "php/insert-chat.php", true);
//   xhr.onload = () => {
//     if (xhr.readyState === XMLHttpRequest.DONE) {
//       if (xhr.status === 200) {
//         inputField.value = "";
//         scrollToBottom();
//       }
//     }
//   };
//   let formData = new FormData(form);
//   xhr.send(formData);
// };
// chatBox.onmouseenter = () => {
//   chatBox.classList.add("active");
// };

// chatBox.onmouseleave = () => {
//   chatBox.classList.remove("active");
// };

// setInterval(() => {
//   let xhr = new XMLHttpRequest();
//   xhr.open("POST", "php/get-chat.php", true);
//   xhr.onload = () => {
//     if (xhr.readyState === XMLHttpRequest.DONE) {
//       if (xhr.status === 200) {
//         let data = xhr.response;
//         chatBox.innerHTML = data;
//         if (!chatBox.classList.contains("active")) {
//           scrollToBottom();
//         }
//       }
//     }
//   };
//   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xhr.send("incoming_id=" + incoming_id);
// }, 500);

// function scrollToBottom() {
//   chatBox.scrollTop = chatBox.scrollHeight;
// }
