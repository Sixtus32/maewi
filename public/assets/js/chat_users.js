document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".typing-area"),
    incoming_id = form.querySelector(".incoming_id").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector("#chat-box");

  form.onsubmit = (e) => {
    e.preventDefault();
  };

  inputField.focus();
  inputField.onkeyup = () => {
    if (inputField.value !== "") {
      sendBtn.classList.add("active");
    } else {
      sendBtn.classList.remove("active");
    }
  };

  sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `${PROCESS_URL}insert-chat.php`, true);
    xhr.onload = () => {
      if (xhr.status === 200) {
        inputField.value = "";
        scrollToBottom();
      }
    };
    let formData = new FormData(form);
    xhr.send(formData);
  };

  chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
  };

  chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
  };

  setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `${PROCESS_URL}get-chat.php`, true);
    xhr.onload = () => {
      if (xhr.status === 200) {
        console.log("GET CHAT");
        let data = xhr.responseText;
        chatBox.classList.remove("incoming");
        chatBox.classList.add("outgoing");
        chatBox.innerHTML = data;
        console.log("DE FUERA");
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
          console.log("scrolliing");
        }
        chatBox.classList.remove("outgoing");
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id=" + incoming_id);
  }, 500);

  function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
  }
});
