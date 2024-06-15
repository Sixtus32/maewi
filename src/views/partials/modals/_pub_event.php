<section class="event_popup form event" id="event-popup">
    <header>
        <span>Crear un nuevo evento</span>
        <div class="close" id="event-close">
            <i class="ri-close-circle-line"></i>
        </div>
    </header>
    <form action="http://127.0.0.1/maewi_dev/src/func/events.php" method="POST" enctype="multipart/form-data" autocomplete="off">

        <div class="field image">
            <div class="w-[400px] relative border-2 border-gray-300 border-dashed rounded-lg p-6" id="dropzone">
                <input type="file" name="event_image_url" class="absolute inset-0 w-full h-full opacity-0 z-50" />
                <div class="text-center">
                    <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                        <label for="file-upload" class="relative cursor-pointer">
                            <span>Arrastra y suelta</span>
                            <span class="text-indigo-600"> o busca</span>
                            <span>para subir</span>
                        </label>
                    </h3>
                    <p class="mt-1 text-xs text-gray-500">
                        PNG, JPG, GIF hasta 10MB
                    </p>
                </div>
                <img src="" class="hidden" id="preview">
            </div>
        </div>

        <div class="other">
            <div class="field text">
                <div class="event_title">
                    <label for="event-title">Nombre del evento</label>
                    <input type="text" name="event_title" id="event-title" required>
                </div>
                <hr>
                <div class="event_title">
                    <label for="event-location">Ubicación del evento</label>
                    <input type="text" name="event_location" id="event-location" required>
                </div>
                <hr>
                <div class="event_description">
                    <textarea name="event_description" id="event-description" cols="50" rows="4" placeholder="Descripción del evento" required></textarea>
                </div>
                <!-- <div class="event_conditions">
                    <textarea name="event_conditions" id="event-conditions" cols="50" rows="4" placeholder="Condiciones del evento"></textarea>
                </div> -->
                <hr>
                <div class="event_passes">
                    <label for="event-passes">Número de pases</label>
                    <input type="number" name="number_passes" id="event-passes" required>
                </div>
            </div>
            <hr>
            <div class="field date">
                <div class="event_date_started">
                    <label for="date_started">Fecha de inicio</label>
                    <input type="datetime-local" name="date_started" id="date_started" required>
                </div>
                <div class="event_date_ended">
                    <label for="date_ended">Fecha de fin</label>
                    <input type="datetime-local" name="date_ended" id="date_ended" required>
                </div>
            </div>
            <hr>
            <div class="field check">
                <div class="event_check">
                    <label for="event_privacy">Privacidad</label>
                    <input type="checkbox" name="privacy" id="event_privacy" value="1">
                </div>
                <div class="event_check">
                    <label for="event_paid">De Pago</label>
                    <input type="checkbox" name="payment" id="event_paid" value="1">
                </div>
            </div>
            <div class="field button">
                <input type="submit" value="Compartir">
            </div>
        </div>
    </form>
</section>
<style>
    /* Contenedor Principal del Popup */
    .event_popup {
        position: absolute;
        left: 55%;
        bottom: -20%;
        background: #fff;
        padding: 15px;
        border-radius: 15px;
        width: 750px;
        height: 620px;
        opacity: 0;
        pointer-events: none;
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
        transform: translate(-50%, -50%) scale(1.2);
        transition: top 0s 0.2s ease-in-out, opacity 0.2s 0s ease-in-out, transform 0.2s 0s ease-in-out;
        z-index: 1000;
        margin: auto 0;
        padding: 10px;
        background: url("<?= PUBLIC_URL ?>assets/img/other/scattered-forcefields.png");
        background-repeat: repeat;
        background-position: center;
    }

    .event_popup.show {
        position: fixed;
        top: 42%;
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, -50%) scale(1);
        transition: top 0s 0s ease-in-out, opacity 0.2s 0s ease-in-out, transform 0.2s 0s ease-in-out;
    }

    @media screen and (min-width: 1164px) {
        .event_popup {
            left: 59.5%;
        }
    }

    /* Estilos para el Encabezado */
    .event_popup header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 25px;
        font-weight: 600;
        padding-bottom: 10px;
        border-bottom: 1px solid #e6e6e6;
        margin-bottom: 1rem;
    }

    .event_popup header .close {
        cursor: pointer;
        font-size: 20px;
    }

    /* Estilos del Formulario */
    .event_popup form {
        width: 100%;
        height: 90%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }

    /* Contenedor de la Imagen */
    .field.image {
        background: transparent;
        width: 50%;
        height: 100%;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
    }

    #dropzone {
        width: 400px;
        position: relative;
        border: 2px dashed #d1d5db;
        border-radius: 0.5rem;
        padding: 1.5rem;
        background-color: #fff;
        transition: border-color 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    #dropzone:hover {
        border-color: #a1a1aa;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
    }

    #dropzone input[type="file"] {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        z-index: 50;
        cursor: pointer;
    }

    #dropzone .text-center {
        text-align: center;
    }

    #dropzone img.mx-auto {
        display: block;
        margin: 0 auto;
    }

    #dropzone h3 {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #1f2937;
    }

    #dropzone h3 label {
        cursor: pointer;
    }

    #dropzone h3 label span.text-indigo-600 {
        color: #0ea5e9;
    }

    #dropzone p {
        margin-top: 0.25rem;
        font-size: 0.75rem;
        color: #6b7280;
    }

    #dropzone #preview {
        margin-top: 1rem;
        display: none;
        max-height: 10rem;
        margin-left: auto;
        margin-right: auto;
    }

    #dropzone.dragover {
        border-color: #0ea5e9;
    }

    /* Contenedor de Otros Campos */
    .other {
        display: flex;
        flex-direction: column;
        row-gap: .5rem;
        padding: .75rem;
        width: 50%;
    }

    /* Estilos de Campos de Texto */
    .field.text {
        display: flex;
        flex-direction: column;
        width: 100%;
        column-gap: 1.75rem;
        row-gap: 0.12rem;
    }

    .field.text label {
        font-weight: 500;
        color: #333;
    }

    .field.text input[type="text"],
    .field.text input[type="number"],
    .field.text textarea {
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .field.text input[type="text"]:focus,
    .field.text input[type="number"]:focus,
    .field.text textarea:focus {
        border-color: #0ea5e9;
        outline: none;
    }

    /* Estilos para Campos de Fecha */
    .field.date {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .field.date div {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1;
    }

    .field.date input[type="date"] {
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .field.date input[type="date"]:focus {
        border-color: #0ea5e9;
        outline: none;
    }

    .field input {
        width: 100%;
    }

    /* Estilos para Checkboxes */
    .field.check {
        display: flex;
        flex-direction: row;
        gap: 1rem;
    }

    .field.check div {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .field.check label {
        font-weight: 500;
        color: #333;
    }

    .field.check input[type="checkbox"] {
        width: 20px;
        height: 20px;
        border-radius: 0.25rem;
        border: 2px solid #0ea5e9;
        transition: background-color 0.3s ease;
    }

    .field.check input[type="checkbox"]:checked {
        background-color: #0ea5e9;
    }

    /* Estilos para Botón */
    .field.button {
        display: flex;
        justify-content: flex-end;
    }

    .field.button input[type="submit"] {
        background: #232232;
        color: #fff;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.375rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .field.button input[type="submit"]:hover {
        background-color: linear-gradient(90deg, #3f4458, transparent);
    }

    .field.text input[type="text"],
    .field.text input[type="number"],
    .field.text textarea {
        width: 100%;
        border: none;
        border-radius: 8px;
        /* border-bottom: 1px solid #232323; */
    }

    .field.button input[type="submit"]:disabled {
        background-color: #ccc;
        /* Cambia el color de fondo cuando está deshabilitado */
        color: #999;
        /* Cambia el color del texto cuando está deshabilitado */
        cursor: not-allowed;
        /* Cambia el cursor cuando está deshabilitado */
        /* Otros estilos que desees aplicar cuando el botón esté deshabilitado */
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Selecciona todos los campos de texto y textarea excepto el de la imagen
        const campos = document.querySelectorAll('.other input[type="text"], .other input[type="number"], .other textarea');
        // Selecciona el botón de compartir
        const botonCompartir = document.querySelector('.field.button input[type="submit"]');

        // Función para verificar si todos los campos están llenos
        function verificarCamposLlenos() {
            let todosLlenos = true;
            campos.forEach(function(campo) {
                if (campo.value.trim() === '') {
                    todosLlenos = false;
                }
            });
            // Habilita o deshabilita el botón de compartir según si todos los campos están llenos
            botonCompartir.disabled = !todosLlenos;
        }

        // Agrega un event listener a cada campo para escuchar los eventos de cambio
        campos.forEach(function(campo) {
            campo.addEventListener('change', verificarCamposLlenos);
        });

        // Verifica el estado de los campos al cargar la página
        verificarCamposLlenos();
    });
</script>
<!-- <script>
    // Seleccionar el elemento input de tipo file
    const inputFile = document.querySelector('input[name="event_image_url"]');

    // Seleccionar el elemento img donde se mostrará la vista previa de la imagen
    const previewImage = document.querySelector('#preview');

    // Añadir un evento de cambio al input file
    inputFile.addEventListener('change', function(event) {
        // Obtener el archivo seleccionado
        const file = event.target.files[0];
        console.log("🚀 ~ inputFile.addEventListener ~ Obtener el archivo seleccionado:", file);

        // Crear un objeto FileReader para leer el contenido del archivo como una URL de datos
        const reader = new FileReader();

        // Definir una función de devolución de llamada que se ejecutará cuando la lectura del archivo esté completa
        reader.onload = function(event) {
            // Asignar la URL de datos del archivo como el valor del atributo src del elemento img
            previewImage.src = event.target.result;
            console.log("🚀 ~ inputFile.addEventListener ~ Objetivo:", previewImage.src);

            // Mostrar la vista previa de la imagen cambiando la clase para hacerla visible
            previewImage.classList.remove('hidden');
        };

        // Leer el contenido del archivo como una URL de datos
        reader.readAsDataURL(file);
    });
</script> -->