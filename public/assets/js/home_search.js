const searchWrapper = document.querySelector("#home-search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector("#autocomplete-box");
const icon = searchWrapper.querySelector("#home-search-icon");
let linkTag = searchWrapper.querySelector("#home-search-lnk");
let webLink;

inputBox.addEventListener('keyup', e => {
    let userData = e.target.value; // usuario ingresó datos
    let emptyArray = [];
    if (userData) {
        icon.onclick = () => {
            webLink = `https://www.google.com/search?q=${userData}`;
            linkTag.setAttribute("href", webLink);
            linkTag.click();
        };
        emptyArray = suggestions.filter((data) => {
            // filtrar valores del array y caracteres del usuario a minúsculas y devolver solo aquellas palabras que comiencen con los caracteres ingresados por el usuario
            return data.toLowerCase().startsWith(userData.toLowerCase());
        });
        emptyArray = emptyArray.map((data) => {
            // pasando los datos devueltos dentro de la etiqueta li
            return `<li>${data}</li>`;
        });
        searchWrapper.classList.add("active"); // mostrar cuadro de autocompletado
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            // agregar atributo onclick en todas las etiquetas li
            allList[i].setAttribute("onclick", "select(this)");
        }
    } else {
        searchWrapper.classList.remove("active"); // ocultar cuadro de autocompletado
    }
});

function select(element) {
    let selectData = element.textContent;
    inputBox.value = selectData;
    icon.onclick = () => {
        webLink = `https://www.google.com/search?q=${selectData}`;
        linkTag.setAttribute("href", webLink);
        linkTag.click();
    };
    searchWrapper.classList.remove("active");
}

function showSuggestions(list) {
    let listData;
    if (!list.length) {
        let userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;
    } else {
        listData = list.join('');
    }
    suggBox.innerHTML = listData;
}

// Detectar clic fuera del cuadro de autocompletado
document.addEventListener('click', function(event) {
    const isClickInside = searchWrapper.contains(event.target);
    if (!isClickInside) {
        searchWrapper.classList.remove('active');
    }
});

