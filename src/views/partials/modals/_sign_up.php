<!-- Modal -->
<section class="sign_popup form signup" id="sign-popup">
    <header>
        <span>Iniciar Sessión</span>
        <div class="close" id="sign-close">
            <i class="ri-close-circle-line"></i>
        </div>
    </header>
    <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error_text" id="error-text"></div>
        <div class="field input">
            <label for="user_email">Correo Electronico</label>
            <input type="text" name="user_email" id="user_email" placeholder="Introduzca su email" required>
        </div>
        <div class="field input">
            <label for="user_password">Contraseña</label>
            <input type="password" name="user_password" placeholder="Introduzca su contraseña" required>
            <i class="ri-eye-line"></i>
        </div>
        <div class="field button">
            <input type="submit" value="Continue con la diversión">
        </div>
    </form>
    <!-- <div class="link">¿Aún no estas registrado?
        <button id="sign-to-login">Registrate Ya</button>
    </div> -->
</section>

<style>
    .link button {
        background: transparent;
        color: #333;
        cursor: pointer;
    }

    .sign_popup {
        position: fixed;
        /* position: absolute; */
        left: 50%;
    }

    .sign_popup {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        top: -150%;
        width: 525px;
        height: 32.5%;
        opacity: 0;
        pointer-events: none;
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
        transform: translate(-50%, -50%) scale(1.2);
        transition: top 0s 0.2s ease-in-out,
            opacity 0.2s 0s ease-in-out,
            transform 0.2s 0s ease-in-out;
        z-index: 1000;
    }

    .sign_popup.show {
        top: 50%;
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, -50%) scale(1);
        transition: top 0s 0s ease-in-out,
            opacity 0.2s 0s ease-in-out,
            transform 0.2s 0s ease-in-out;
    }

    .form header {
        display: flex;
        font-size: 25px;
        font-weight: 600;
        padding-bottom: 10px;
        border-bottom: 1px solid #e6e6e6;
        justify-content: space-between;
    }

    .form form {
        margin: 20px 0;
    }

    .form .close i {
        cursor: pointer;
    }

    .form form .error_text {
        color: #721c24;
        padding: 8px 10px;
        text-align: center;
        border-radius: 5px;
        background: #f8d7da;
        margin-bottom: 10px;
        display: none;
    }

    .form form .name_details {
        display: flex;
    }

    .form .name_details .field:first-child {
        margin-right: 10px;
    }

    .form .name_details .field:last-child {
        margin-right: 10px;
    }

    .form form .field {
        display: flex;
        margin-bottom: 10px;
        flex-direction: column;
        position: relative;
    }

    .form form .field label {
        margin-bottom: 2px;
    }

    .form form .field input {
        height: 40px;
        width: 100%;
        font-size: 16px;
        padding: 0 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form form .field input {
        outline: none;
    }

    .form form .image input {
        font-size: 17px;
    }

    .form form .button input {
        height: 45px;
        border: none;
        color: #fff;
        font-size: 17px;
        background: #333;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 13px;
    }

    .form form .field i {
        position: absolute;
        right: 15px;
        top: 70%;
        color: #ccc;
        cursor: pointer;
        transform: translateY(-50%);
    }


    .form form .field i.active::before {
        color: #333;
        content: "\f070";
    }

    .form .link {
        text-align: center;
        margin: 10px 0;
        font-size: 17px;
    }

    .form .link a {
        color: #333;
    }

    .form .link a:hover {
        text-decoration: underline;
    }
</style>