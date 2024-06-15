document.addEventListener("DOMContentLoaded", () => {
  const viewEventBtn = document.querySelector("#view-modal-event");
  const eventPopup = document.querySelector("#event-popup");
  const eventClose = document.querySelector("#event-close");
  const formEvent = document.querySelector(".event_popup form");
  const submitBtn = formEvent.querySelector(".event_popup .field.button input");

  function openPubEvent() {
    console.log("Publicación de eventos - abierto");
    eventPopup.classList.add("show");
  }

  function closePubEvent() {
    console.log("Publicación de eventos - cerrado");
    eventPopup.classList.remove("show");
  }

  viewEventBtn.addEventListener("click", openPubEvent);
  eventClose.addEventListener("click", closePubEvent);

  console.log("Proceso publicación de eventos iniciado");

  // Evitar el envío del formulario al hacer submit
  formEvent.onsubmit = (e) => {
    e.preventDefault();
  };

  submitBtn.onclick = () => {
    // Crear una nueva solicitud XMLHttpRequest
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `${PROCESS_URL}events.php`, true);
    console.log("Url correcto: http://127.0.0.1/maewi_dev/src/func/events.php");

    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        formEvent.reset();
        if (xhr.status === 200) {
          let data = xhr.responseText; // Utilizar responseText en lugar de response
          if (data === "success") {
            formEvent.reset(); // Reiniciar el formulario
            console.log("Evento Publicado");
            Toastify({
              text: "Evento Publicado.",
              duration: 3000,
              close: true,
              gravity: "top",
              position: "right",
              backgroundColor: "#4CAF50",
            }).showToast();
            setTimeout(() => {
              location.href = BASE_CLI_URL;
            }, 1000);
          } else {
            console.log("Bueno, bueno, bueno... no se pudo subir el evento");
            Toastify({
              text: "Bueno, bueno, bueno... no se pudo subir el evento",
              duration: 3000,
              close: true,
              gravity: "top",
              position: "right",
              backgroundColor: "#FF0000",
            }).showToast();
            setTimeout(() => {
              location.href = BASE_CLI_URL;
            }, 1000);
          }
        } else {
          console.log("Error en la subida de eventos");
          Toastify({
            text: "Error en la solicitud. Por favor, intenta de nuevo.",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#FF0000",
          }).showToast();
        }
        // Cerrar el popup independientemente del resultado de la solicitud
        closePubEvent();
      }
    };

    // Obtener los datos del formulario y enviarlos
    let formData4 = new FormData(formEvent);
    xhr.send(formData4);
  };
});
