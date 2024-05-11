const viewLoginBtn = document.querySelector("#view-modal-login");
const loginPopup = document.querySelector("#login-popup");
const loginClose = document.querySelector("#login-close");

const viewSignBtn = document.querySelector("#view-modal-sign-up");
const signPopup = document.querySelector("#sign-popup");
const signClose = document.querySelector("#sign-close");

function openLogin() {
  console.log("Inicio de sesión - abierto");
  viewLoginBtn.addEventListener("click", () => {
    loginPopup.classList.toggle("show");
  });
}

function closeLogin() {
  console.log("Inicio de sesión - cerrado");
  loginClose.addEventListener("click", () => {
    loginPopup.classList.remove("show");
  });
}

function openSign() {
  console.log("Registro - abierto");
  viewSignBtn.addEventListener("click", () => {
    signPopup.classList.toggle("show");
  });
}

function closeSign() {
  console.log("Registro - cerrado");
  signClose.addEventListener("click", () => {
    signPopup.classList.remove("show");
  });
}

closeLogin();
openLogin();
openSign();
closeSign();
