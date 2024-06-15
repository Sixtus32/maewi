document.addEventListener("DOMContentLoaded", () => {
  const form2 = document.querySelector(".sign_popup form"),
    continueBtn2 = form2.querySelector(".button input");

  // Evitar el envío del formulario al hacer submit
  form2.onsubmit = (e2) => {
    e2.preventDefault();
  };

  continueBtn2.onclick = () => {
    // Crear una nueva solicitud XMLHttpRequest
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `${PROCESS_URL}log_in.php`, true);

    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        form2.reset();
        if (xhr.status === 200) {
          let data = xhr.responseText; // Utilizar responseText en lugar de response
          if (data === "success") {
            Toastify({
              text: "¡Inicio de sesión exitoso!",
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
            Toastify({
              text: data,
              duration: 3000,
              close: true,
              gravity: "top",
              position: "right",
              backgroundColor: "#FF0000",
            }).showToast();
          }
        } else {
          Toastify({
            text: "Error en la solicitud. Por favor, intenta de nuevo.",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#FF0000",
          }).showToast();
        }
      }
    };

    // Obtener los datos del formulario y enviarlos
    let formData = new FormData(form2);
    xhr.send(formData);
  };
});
